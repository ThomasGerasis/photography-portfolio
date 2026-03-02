<?php /* Modal body for [why_choose_me] shortcode */ ?>
<input type="hidden" data-shortcode-tag="why_choose_me">

<div class="form-group">
    <label>Section Title</label>
    <input type="text" class="form-control" data-att="title">
</div>

<div class="form-group">
    <label>Background Image</label>
    <div class="input-group">
        <input type="text" class="form-control" id="vsc-why-bg" data-att="background" placeholder="https://...">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary vasakos-media-btn" type="button" data-target="vsc-why-bg">
                Choose Image
            </button>
        </div>
    </div>
    <img id="vsc-why-bg-preview" src="" alt="" class="mt-2 img-fluid" style="display:none;max-height:120px;">
</div>
