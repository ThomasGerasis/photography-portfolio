<?php /* Modal body for [timeline] shortcode */ ?>
<input type="hidden" data-shortcode-tag="timeline">

<div class="form-group">
    <label>Section title <small class="text-muted">(optional)</small></label>
    <input type="text" class="form-control" data-att="title" placeholder="e.g. Your Session Journey">
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
    <label>Steps <small class="text-muted">(comma-separated — use <strong>Title:Description</strong> for each step)</small></label>
    <textarea class="form-control" rows="6" data-att="items"
        placeholder="Meet &amp; Chat:We'll have a relaxed call to discuss your vision, The Session:Your session in beautiful Edinburgh, Gallery Delivery:Your edited gallery delivered within 3 weeks"></textarea>
</div>
