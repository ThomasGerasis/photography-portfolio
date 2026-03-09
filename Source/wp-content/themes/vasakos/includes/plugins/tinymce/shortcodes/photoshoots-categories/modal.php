<?php /* Modal body for [photoshoots_categories] shortcode */ ?>
<input type="hidden" data-shortcode-tag="photoshoots_categories">

<div class="form-group">
    <label>Mode</label>
    <select class="form-control" id="photoshoots-cat-mode" data-att="mode" data-ui-only="true">
        <option value="all">All (default – use limit &amp; order)</option>
        <option value="specific">Specific categories</option>
    </select>
</div>

<div id="photoshoots-cat-all-opts">
    <div class="form-group">
        <label>Number of Categories</label>
        <input type="number" class="form-control" data-att="limit" value="4" min="1">
    </div>

    <div class="form-group">
        <label>Order By</label>
        <select class="form-control" data-att="orderby">
            <option value="count">Post Count</option>
            <option value="name">Name</option>
            <option value="slug">Slug</option>
        </select>
    </div>
</div>

<div id="photoshoots-cat-specific-opts" style="display:none;">
    <div class="form-group">
        <label>Categories <small class="text-muted">(hold Ctrl / Cmd to select multiple)</small></label>
        <select class="form-control" multiple size="6" data-att="categories">
            <?php
            $all_cats = get_categories(['taxonomy' => 'photoshoots', 'hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC']);
            foreach ($all_cats as $cat) :
            ?>
                <option value="<?= esc_attr($cat->slug) ?>"><?= esc_html($cat->name) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<script>
(function($) {
    var $mode     = $('#photoshoots-cat-mode');
    var $allOpts  = $('#photoshoots-cat-all-opts');
    var $specOpts = $('#photoshoots-cat-specific-opts');

    function toggleMode() {
        var isSpecific = $mode.val() === 'specific';
        $allOpts.toggle(!isSpecific);
        $specOpts.toggle(isSpecific);
    }

    $mode.on('change', toggleMode);

    // If editing an existing shortcode with categories set, switch to specific mode.
    // populateFields runs before this script executes, so the multi-select is already set.
    setTimeout(function() {
        var selected = $('[data-att="categories"]').val();
        if (selected && selected.length > 0) {
            $mode.val('specific');
        }
        toggleMode();
    }, 50);
}(jQuery));
</script>
