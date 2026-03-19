<?php /* Modal body for [cta_section] shortcode */ ?>
<input type="hidden" data-shortcode-tag="cta_section">

<div class="form-group">
    <label>Heading</label>
    <input type="text" class="form-control" data-att="heading" placeholder="e.g. Ready to capture your story?">
</div>

<div class="form-group">
    <label>Heading tag</label>
    <select class="form-control" data-att="heading_tag">
        <option value="h1">H1</option>
        <option value="h2" selected>H2</option>
        <option value="h3">H3</option>
        <option value="h4">H4</option>
        <option value="p">Paragraph</option>
        <option value="none">None (hide heading)</option>
    </select>
</div>

<div class="form-group">
    <label>Supporting text</label>
    <input type="text" class="form-control" data-att="text" placeholder="e.g. Let's chat about your perfect shoot.">
</div>

<div class="form-group">
    <label>Button text</label>
    <input type="text" class="form-control" data-att="button_text" value="Get in Touch">
</div>

<div class="form-group">
    <label>Button link</label>
    <input type="text" class="form-control" data-att="button_link" value="#contact">
</div>

<div class="form-group">
    <label>Background</label>
    <select class="form-control" data-att="background">
        <option value="dark" selected>Dark</option>
        <option value="light">Light</option>
    </select>
    <small class="text-muted mt-1 d-block">Or paste an image URL below to use a photo background.</small>
    <input type="text" class="form-control mt-1" id="vsc-cta-bg-img" data-att="background" placeholder="https://... (overrides selection above)">
    <div class="input-group-append mt-1">
        <button class="btn btn-outline-secondary vasakos-media-btn w-100" type="button" data-target="vsc-cta-bg-img">
            Choose Image
        </button>
    </div>
</div>

<div class="form-group">
    <label>Button style</label>
    <select class="form-control" data-att="button_style">
        <option value="light" selected>Light (white)</option>
        <option value="dark">Dark</option>
        <option value="outline-light">Outline light</option>
        <option value="outline-dark">Outline dark</option>
    </select>
</div>

<div class="form-group">
    <label>Alignment</label>
    <select class="form-control" data-att="align">
        <option value="center" selected>Center</option>
        <option value="left">Left</option>
    </select>
</div>
