<?php /* Modal body for [popular_categories] shortcode */ ?>
<input type="hidden" data-shortcode-tag="popular_categories">

<div class="form-group">
    <label>Number of Categories</label>
    <input type="number" class="form-control" data-att="limit" value="4" min="1">
</div>

<div class="form-group">
    <label>Order By</label>
    <select class="form-control" data-att="orderby">
        <option value="count">Post Count</option>
        <option value="name">Name</option>
        <option value="slug">Slug</option>
    </select>
</div>
