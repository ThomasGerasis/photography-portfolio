<?php /* Modal body for [photo_gallery] shortcode */

$terms = get_terms([
    'taxonomy'   => 'photoshoots',
    'hide_empty' => false,
    'orderby'    => 'name',
]);
?>
<input type="hidden" data-shortcode-tag="photo_gallery">

<div class="form-group">
    <label>Category</label>
    <select class="form-control" data-att="category">
        <option value="">— All Categories —</option>
        <?php if (!is_wp_error($terms)) : foreach ($terms as $term) : ?>
            <option value="<?= esc_attr($term->slug); ?>"><?= esc_html($term->name); ?></option>
        <?php endforeach; endif; ?>
    </select>
</div>

<div class="form-group">
    <label>Title <small class="text-muted">(optional)</small></label>
    <input type="text" class="form-control" data-att="title" placeholder="e.g. Wedding Gallery">
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

<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="vsc-load-more" data-att="load_more" value="yes">
    <label class="form-check-label" for="vsc-load-more">Enable infinite scroll (load more)</label>
</div>

<div class="form-group">
    <label>Photos per page</label>
    <input type="number" class="form-control" data-att="limit" value="<?= esc_attr(get_option('posts_per_page')); ?>" min="1">
</div>
