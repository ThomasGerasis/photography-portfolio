<?php /* Modal body for [pricing_packages] shortcode */ ?>
<input type="hidden" data-shortcode-tag="pricing_packages">

<div class="form-group">
    <label>Packages <small class="text-muted">(hold Ctrl / Cmd to select multiple; leave blank for all)</small></label>
    <select class="form-control" multiple size="6" data-att="ids">
        <?php
        $all_packages = get_posts(array(
            'post_type'      => 'pricing_package',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ));
        foreach ($all_packages as $pkg) :
            $price    = get_post_meta($pkg->ID, '_pkg_price', true);
            $location = get_post_meta($pkg->ID, '_pkg_location', true);
            $label    = $pkg->post_title;
            if ($price)    $label .= ' — ' . $price;
            if ($location) $label .= ' (' . $location . ')';
        ?>
            <option value="<?= esc_attr($pkg->ID) ?>"><?= esc_html($label) ?></option>
        <?php endforeach; ?>
    </select>
</div>

<hr>

<div class="form-group">
    <label>Section Title</label>
    <input type="text" class="form-control" data-att="title" value="Pricing - Packages">
</div>

<div class="form-group">
    <label>Title tag</label>
    <select class="form-control" data-att="title_tag">
        <option value="h1">H1</option>
        <option value="h2" selected>H2</option>
        <option value="h3">H3</option>
        <option value="h4">H4</option>
        <option value="p">Paragraph</option>
        <option value="none">None (hide title)</option>
    </select>
</div>

<div class="form-group">
    <label>Section Subtitle</label>
    <input type="text" class="form-control" data-att="subtitle" value="Choose the perfect package for you">
</div>

<div class="form-check">
    <input type="checkbox" class="form-check-input" id="vsc-show-book-button" data-att="show_book_button" value="yes" checked>
    <label class="form-check-label" for="vsc-show-book-button">Show Book Buttons</label>
</div>

<script>
// When editing an existing shortcode, the ids att is a comma string — split into array for multi-select.
// populateFields in tinymce-shortcodes.js handles select[multiple] natively via the split we added.
</script>
