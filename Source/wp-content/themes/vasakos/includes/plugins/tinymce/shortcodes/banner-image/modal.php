<?php /* Modal body for [banner_image] shortcode */ ?>
<input type="hidden" data-shortcode-tag="banner_image">

<div class="form-group">
    <label>Image</label>
    <div class="input-group">
        <input type="text" class="form-control" id="vsc-banner-image" data-att="image" placeholder="https://...">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary vasakos-media-btn" type="button" data-target="vsc-banner-image">
                Choose Image
            </button>
        </div>
    </div>
    <img id="vsc-banner-image-preview" src="" alt="" class="mt-2 img-fluid" style="display:none;max-height:120px;">
</div>

<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" data-att="title">
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
    <label>Subtitle</label>
    <input type="text" class="form-control" data-att="subtitle">
</div>

<div class="form-group">
    <label>Minimum Height</label>
    <input type="text" class="form-control" data-att="min_height" value="400px">
</div>

<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="vsc-overlay" data-att="overlay" value="yes" checked>
    <label class="form-check-label" for="vsc-overlay">Dark Overlay</label>
</div>

<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="vsc-show-button" data-att="show_button" value="yes">
    <label class="form-check-label" for="vsc-show-button">Show Button</label>
</div>

<div id="vsc-banner-button-fields" style="display:none;">
    <div class="form-group">
        <label>Button Text</label>
        <input type="text" class="form-control" data-att="button_text" value="Learn More">
    </div>
    <div class="form-group">
        <label>Button Link</label>
        <input type="text" class="form-control" data-att="button_link" value="#">
    </div>
    <div class="form-group">
        <label>Button Style</label>
        <select class="form-control" data-att="button_style">
            <option value="primary">Primary</option>
            <option value="secondary">Secondary</option>
            <option value="outline-primary">Outline Primary</option>
            <option value="outline-secondary">Outline Secondary</option>
            <option value="light">Light</option>
        </select>
    </div>
</div>

<script>
(function($) {
    $('#vsc-show-button').on('change', function() {
        $('#vsc-banner-button-fields').toggle(this.checked);
    });
})(jQuery);
</script>
