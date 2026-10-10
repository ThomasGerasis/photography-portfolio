<?php /* Modal body for [location_card] shortcode */ ?>
<input type="hidden" data-shortcode-tag="location_card">

<div class="form-group">
    <label>Location name</label>
    <input type="text" class="form-control" data-att="name" placeholder="e.g. Calton Hill">
</div>

<div class="form-group">
    <label>Description <small class="text-muted">(optional)</small></label>
    <textarea class="form-control" rows="3" data-content placeholder="Short description of the spot"></textarea>
</div>

<div class="form-group">
    <label>Best time <small class="text-muted">(optional)</small></label>
    <input type="text" class="form-control" data-att="best_time" placeholder="e.g. Sunset">
</div>

<div class="form-group">
    <label>Duration <small class="text-muted">(optional)</small></label>
    <input type="text" class="form-control" data-att="duration" placeholder="e.g. 1 hour">
</div>

<div class="form-group">
    <label>Map link <small class="text-muted">(optional)</small></label>
    <input type="text" class="form-control" data-att="map" placeholder="https://maps.google.com/...">
</div>

<div class="form-group">
    <label>Image <small class="text-muted">(optional)</small></label>
    <input type="text" class="form-control" id="vsc-location-image" data-att="image" placeholder="https://...">
    <img id="vsc-location-image-preview" src="" alt="" style="display:none;max-width:100%;max-height:120px;margin-top:8px;">
    <button class="btn btn-outline-secondary vasakos-media-btn w-100 mt-1" type="button" data-target="vsc-location-image">
        Choose Image
    </button>
</div>
