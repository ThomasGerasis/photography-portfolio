<?php /* Modal body for [target_audience] shortcode */ ?>
<input type="hidden" data-shortcode-tag="target_audience">

<div class="form-group">
    <label>Heading <small class="text-muted">(h2)</small></label>
    <input type="text" class="form-control" data-att="heading" value="Who this is for">
</div>

<div class="form-group">
    <label>Subheading <small class="text-muted">(h3)</small></label>
    <input type="text" class="form-control" data-att="subheading" placeholder="e.g. Perfect for couples at any stage">
</div>

<div class="form-group">
    <label>Intro text</label>
    <input type="text" class="form-control" data-att="intro" placeholder="e.g. My photography in Edinburgh is ideal for:">
</div>

<div class="form-group">
    <label>List items <small class="text-muted">(comma-separated)</small></label>
    <textarea class="form-control" rows="5" data-att="items" placeholder="Couples wanting romantic photos, Engagement photoshoots, Anniversary celebrations"></textarea>
</div>

<div class="form-group">
    <label>Icon style</label>
    <select class="form-control" data-att="icon">
        <option value="check">✓ Check</option>
        <option value="arrow">› Arrow</option>
        <option value="dot">• Dot</option>
    </select>
</div>

<div class="form-group">
    <label>Side image <small class="text-muted">(optional — shows polaroid on the right)</small></label>
    <div class="input-group">
        <input type="text" class="form-control" id="vsc-ta-image" data-att="image" placeholder="https://...">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary vasakos-media-btn" type="button" data-target="vsc-ta-image">
                Choose Image
            </button>
        </div>
    </div>
    <img id="vsc-ta-image-preview" src="" alt="" class="mt-2 img-fluid" style="display:none;max-height:120px;">
</div>
