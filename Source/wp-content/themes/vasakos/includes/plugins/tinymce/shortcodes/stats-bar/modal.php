<?php /* Modal body for [stats_bar] shortcode */ ?>
<input type="hidden" data-shortcode-tag="stats_bar">

<div class="form-group">
    <label>Stats <small class="text-muted">(comma-separated — use <strong>Value:Label</strong> for each stat)</small></label>
    <textarea class="form-control" rows="4" data-att="items"
        placeholder="200+:Weddings, 8:Years experience, 5★:Average rating"></textarea>
</div>

<div class="form-group">
    <label>Background</label>
    <select class="form-control" data-att="background">
        <option value="light" selected>Light</option>
        <option value="dark">Dark</option>
        <option value="transparent">Transparent</option>
    </select>
</div>
