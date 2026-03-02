(function() {
    'use strict';

    tinymce.PluginManager.add('vasakos_shortcodes', function(editor) {

        var shortcodes = [
            { label: 'Button',              slug: 'button',             tag: 'button' },
            { label: 'Banner Image',        slug: 'banner-image',       tag: 'banner_image' },
            { label: 'Photo Gallery',       slug: 'photo-gallery',      tag: 'photo_gallery' },
            { label: 'Popular Categories',  slug: 'popular-categories', tag: 'popular_categories' },
            { label: 'Pricing Packages',    slug: 'pricing-packages',   tag: 'pricing_packages' },
            { label: 'FAQ',                 slug: 'faq',                tag: 'faq' },
            { label: 'Why Choose Me',       slug: 'why-choose-me',      tag: 'why_choose_me' },
            { label: 'Contact Form',        slug: 'contact-form',       tag: 'contact_form' },
        ];

        // Build a tag→sc lookup for the dblclick handler
        var scByTag = {};
        shortcodes.forEach(function(sc) { scByTag[sc.tag] = sc; });

        editor.addButton('vasakos_shortcodes', {
            text: 'Shortcodes',
            type: 'menubutton',
            menu: shortcodes.map(function(sc) {
                return {
                    text: sc.label,
                    onclick: function() { openModal(editor, sc, null, null); }
                };
            })
        });

        // ── Double-click: detect shortcode under cursor and open for editing ──
        editor.on('dblclick', function() {
            var rng  = editor.selection.getRng();
            var node = rng.startContainer;

            // Walk up to the text node
            if (node.nodeType !== 3) {
                node = node.firstChild || node;
            }

            var text   = node.textContent || '';
            var offset = rng.startOffset;

            // Find every shortcode in this text node
            var re = /\[([\w_]+)((?:\s+[\w_]+=(?:"[^"]*"|'[^']*'|[^\s\]]+))*)\s*\]/g;
            var match;

            while ((match = re.exec(text)) !== null) {
                var start = match.index;
                var end   = start + match[0].length;

                // Is the cursor inside this shortcode?
                if (offset >= start && offset <= end) {
                    var tag = match[1];
                    var sc  = scByTag[tag];
                    if (!sc) return;

                    var existingAtts = parseShortcodeAtts(match[2]);

                    // Select the shortcode text so we can replace it on save
                    var selRng = editor.dom.createRng();
                    selRng.setStart(node, start);
                    selRng.setEnd(node, end);
                    editor.selection.setRng(selRng);

                    openModal(editor, sc, existingAtts, true);
                    return;
                }
            }
        });

        // Parse att="value" pairs from a raw attribute string
        function parseShortcodeAtts(attsStr) {
            var atts = {};
            var re   = /([\w_]+)="([^"]*)"/g;
            var m;
            while ((m = re.exec(attsStr)) !== null) {
                atts[m[1]] = m[2];
            }
            return atts;
        }

        // Populate modal fields from an existing atts object
        function populateFields($modal, atts) {
            if (!atts) return;

            $modal.find('[data-att]').each(function() {
                var $el  = jQuery(this);
                var att  = $el.data('att');

                if (!(att in atts)) return;

                if ($el.is(':checkbox')) {
                    $el.prop('checked', atts[att] === 'yes' || atts[att] === '1');
                    $el.trigger('change'); // fire any conditional show/hide listeners
                } else {
                    $el.val(atts[att]);
                    // Refresh image preview if there's one
                    var id = $el.attr('id');
                    if (id) {
                        var $preview = jQuery('#' + id + '-preview');
                        if ($preview.length && atts[att]) {
                            $preview.attr('src', atts[att]).show();
                        }
                    }
                }
            });
        }

        function openModal(editor, sc, existingAtts, isEdit) {

            var modalId    = 'vasakos-sc-modal';
            var insertText = isEdit ? 'Update Shortcode' : 'Insert Shortcode';
            jQuery('#' + modalId).remove();

            var modalHtml =
                '<div class="modal fade" id="' + modalId + '" tabindex="-1" role="dialog">' +
                    '<div class="modal-dialog" role="document">' +
                        '<div class="modal-content">' +
                            '<div class="modal-header">' +
                                '<h5 class="modal-title">' + sc.label + '</h5>' +
                                '<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>' +
                            '</div>' +
                            '<div class="modal-body"><div class="vasakos-sc-loading text-center py-4"><div class="spinner-border" role="status"></div></div></div>' +
                            '<div class="modal-footer">' +
                                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>' +
                                '<button type="button" class="btn btn-primary" id="' + modalId + '-insert">' + insertText + '</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';

            jQuery('body').append(modalHtml);
            var $modal = jQuery('#' + modalId);

            // Fetch modal body via AJAX
            jQuery.get(VasakosTinyMCE.ajaxUrl, {
                action:    'vasakos_shortcode_modal',
                shortcode: sc.slug,
                nonce:     VasakosTinyMCE.nonce
            })
            .done(function(html) {
                $modal.find('.modal-body').html(html);

                // Pre-populate fields when editing existing shortcode
                populateFields($modal, existingAtts);

                // Init media uploaders
                $modal.find('.vasakos-media-btn').each(function() {
                    var $btn   = jQuery(this);
                    var target = $btn.data('target');
                    var $input = jQuery('#' + target);

                    $btn.on('click', function(e) {
                        e.preventDefault();
                        var frame = wp.media({
                            title:    'Select Image',
                            button:   { text: 'Use this image' },
                            multiple: false
                        });
                        frame.on('select', function() {
                            var attachment = frame.state().get('selection').first().toJSON();
                            $input.val(attachment.url);
                            var $preview = jQuery('#' + target + '-preview');
                            if ($preview.length) {
                                $preview.attr('src', attachment.url).show();
                            }
                        });
                        frame.open();
                    });
                });
            })
            .fail(function() {
                $modal.find('.modal-body').html('<p class="text-danger">Failed to load shortcode options.</p>');
            });

            // Collect fields and build shortcode string on insert/update
            $modal.on('click', '#' + modalId + '-insert', function() {

                var tag = $modal.find('[data-shortcode-tag]').data('shortcode-tag');
                if (!tag) return;

                var shortcode = '[' + tag;

                $modal.find('[data-att]').each(function() {
                    var $el = jQuery(this);
                    var att = $el.data('att');
                    var val;

                    if ($el.is(':checkbox')) {
                        val = $el.is(':checked') ? ($el.val() || 'yes') : '';
                    } else {
                        val = $el.val();
                    }

                    if (val !== '' && val !== undefined) {
                        shortcode += ' ' + att + '="' + val + '"';
                    }
                });

                shortcode += ']';

                // isEdit: replace the selected text; otherwise insert at cursor
                if (isEdit) {
                    editor.selection.setContent(shortcode);
                } else {
                    editor.insertContent(shortcode);
                }

                $modal.modal('hide');
            });

            $modal.on('hidden.bs.modal', function() { $modal.remove(); });
            $modal.modal('show');
        }

    });
})();