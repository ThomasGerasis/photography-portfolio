jQuery(document).ready(function ($) {

    $('#upload-photo-button').on('click', function (e) {
        e.preventDefault();

        const frame = wp.media({
            title: 'Select Photos',
            library: { type: 'image' },
            button: { text: 'Add selected photos' },
            multiple: 'add'   // 🔥 THIS is the key for library multi-select
        });

        frame.on('open', function(){
            // Optional: open in GRID mode
            frame.content.mode('browse');
        });

        frame.on('select', function(){
            let selection = frame.state().get('selection');
            let ids = [];
            let preview = $('#photo-preview');

            preview.empty();

            selection.each(function (attachment) {
                attachment = attachment.toJSON();
                ids.push(attachment.id);

                const thumb =
                    attachment?.sizes?.thumbnail?.url ||
                    attachment?.sizes?.medium?.url ||
                    attachment.url;

                preview.append(
                    `<img src="${thumb}" class="img-thumbnail mr-2 mb-2" style="max-width:80px;">`
                );
            });

            $('#photo_attachment_ids').val(ids.join(','));

            $('#add-photo-button').prop('disabled', ids.length === 0);
        });

        frame.open();
    });
    /*
    |--------------------------------------------------------------------------
    | CONNECTED SORTABLE LISTS
    |--------------------------------------------------------------------------
    */
    if ($("#sortable1").length) {

        const sortable_list2 = $('#sortable2');
        let hiddenpatent = $("#hiddenpatent");  // FIX: Should exist in form
        let mVal = sortable_list2.data("front") || "";

        $("#sortable1, #sortable2").sortable({
            connectWith: ".connectedSortable",

            sort: function (event, ui) {
                // FIXED: correct parent() check
                if (ui.item.parent().attr("id") === "sortable2") {
                    // alert(ui.item.data("id"));
                }
            },

            receive: function (event, ui) {
                const movedID = ui.item.data("id");

                if (ui.sender.attr("id") === "sortable1") {
                    mVal += "," + movedID;
                }

                if (ui.sender.attr("id") === "sortable2") {
                    mVal = mVal.replace("," + movedID, "");
                    sortable_list2.attr("data-front", mVal);
                    hiddenpatent.val(mVal);
                }
            },

            update: function (event, ui) {
                if (ui.item.parent().attr("id") === "sortable2") {

                    let mVal = "";
                    sortable_list2.find("li").each(function () {
                        mVal += "," + $(this).data("id");
                    });

                    sortable_list2.attr("data-front", mVal);
                    hiddenpatent.val(mVal);
                }
            }

        }).disableSelection();
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPLE SORTABLE
    |--------------------------------------------------------------------------
    */
    $(".repeater-rows-links").sortable({
        placeholder: "sortable-placeholder",
        update: function () {
            sortableIn = 1;
        }
    });


    /*
    |--------------------------------------------------------------------------
    | WORDPRESS MEDIA UPLOADER (GLOBAL HANDLER)
    |--------------------------------------------------------------------------
    */
    function openMediaUploader(targetKey) {
        let frame = wp.media({
            title: "Select Image",
            button: { text: "Use this image" },
            multiple: false
        });

        frame.on("select", function () {
            let attachment = frame.state().get("selection").first().toJSON();

            $(`.media_image_${targetKey}`).val(attachment.url);
            $(`.custom_media_image_${targetKey}`)
                .attr("src", attachment.url)
                .css("display", "block");
        });

        frame.open();
    }


    /*
    |--------------------------------------------------------------------------
    | REPEATER WITH ADD / REMOVE AND MEDIA UPLOADER
    |--------------------------------------------------------------------------
    */
    if ($(".repeater-content-links").length) {

        $(".repeater-content-links").each(function () {

            const container = this;
            const rows = $(container).find(".repeater-rows-links");
            const group = $(container).data("group");

            let count =
                parseInt(rows.children().last().data("id") ?? 0) + 1;

            // CLICK HANDLER inside this repeater
            container.addEventListener("click", function (e) {

                /*
                -------------------------------------------------------------
                ADD NEW ROW
                -------------------------------------------------------------
                */
                if (e.target.classList.contains("repeater-add-btn")) {
                    e.preventDefault();

                    // UNIQUE KEY
                    let key = count++;

                    const html = `
                        <div class="items d-flex mb-1" data-id="${key}">
                            
                            <button type="button"
                                class="button button-primary custom-media-btn"
                                data-key="${key}">
                                Upload Icon
                            </button>

                            <img class="custom_media_image_${key}"
                                src=""
                                style="display:none;max-width:100px;margin-left:10px;">

                            <input type="text"
                                class="media_image_${key} form-control form-control-sm col-3 ml-2"
                                name="${group}[${key}][image]"
                                placeholder="Image">

                            <textarea class="form-control form-control-sm col-2 ml-2"
                                name="${group}[${key}][title]"
                                placeholder="Title"></textarea>

                            <textarea class="form-control form-control-sm col-2 ml-2"
                                name="${group}[${key}][text]"
                                placeholder="Text"></textarea>

                            <button class="remove-btn btn btn-danger ml-3">
                                Remove
                            </button>
                        </div>
                    `;

                    rows.append(html);
                }


                /*
                -------------------------------------------------------------
                REMOVE ROW
                -------------------------------------------------------------
                */
                if (e.target.classList.contains("remove-btn")) {
                    e.preventDefault();
                    e.target.closest(".items").remove();
                }


                /*
                -------------------------------------------------------------
                MEDIA BUTTON CLICK
                -------------------------------------------------------------
                */
                if (e.target.classList.contains("custom-media-btn")) {
                    e.preventDefault();
                    const key = e.target.dataset.key;
                    openMediaUploader(key);
                }
            });
        });
    }

});
