<?php /* Modal body for [video_embed] shortcode */ ?>
<input type="hidden" data-shortcode-tag="video_embed">

<div class="form-group">
    <label>Video URL <small class="text-muted">(YouTube or Vimeo)</small></label>
    <input type="text" class="form-control" data-att="url" placeholder="https://youtu.be/... or https://vimeo.com/...">
</div>

<div class="form-group">
    <label>Title <small class="text-muted">(optional)</small></label>
    <input type="text" class="form-control" data-att="title" placeholder="e.g. Behind the scenes">
</div>

<div class="form-group">
    <label>Title tag</label>
    <select class="form-control" data-att="title_tag">
        <option value="h2">H2</option>
        <option value="h3" selected>H3</option>
        <option value="h4">H4</option>
        <option value="p">Paragraph</option>
        <option value="none">None (hide title)</option>
    </select>
</div>

<div class="form-group">
    <label>Aspect ratio</label>
    <select class="form-control" data-att="ratio">
        <option value="16x9" selected>16:9 (widescreen)</option>
        <option value="4x3">4:3 (classic)</option>
        <option value="1x1">1:1 (square)</option>
    </select>
</div>

<div class="form-group">
    <label>Caption <small class="text-muted">(optional)</small></label>
    <input type="text" class="form-control" data-att="caption" placeholder="e.g. Filmed at Holyrood Park, Edinburgh">
</div>
