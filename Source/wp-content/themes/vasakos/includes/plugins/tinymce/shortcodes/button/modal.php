<?php /* Modal body for [button] shortcode */ ?>
<input type="hidden" data-shortcode-tag="button">

<div class="form-group">
    <label>Button Text</label>
    <input type="text" class="form-control" data-att="text" value="Click Here">
</div>

<div class="form-group">
    <label>Link URL</label>
    <input type="text" class="form-control" data-att="link" value="#">
</div>

<div class="form-group">
    <label>Style</label>
    <select class="form-control" data-att="style">
        <option value="primary">Primary</option>
        <option value="secondary">Secondary</option>
        <option value="outline-primary">Outline Primary</option>
        <option value="outline-secondary">Outline Secondary</option>
    </select>
</div>

<div class="form-group">
    <label>Alignment</label>
    <select class="form-control" data-att="align">
        <option value="left">Left</option>
        <option value="center">Center</option>
        <option value="right">Right</option>
    </select>
</div>

<div class="form-group">
    <label>Open in</label>
    <select class="form-control" data-att="target">
        <option value="_self">Same tab</option>
        <option value="_blank">New tab</option>
    </select>
</div>
