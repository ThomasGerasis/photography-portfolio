<?php

// WordPress skips lazy-loading for the first content image (LCP heuristic).
// Single posts have a banner above the content, so lazy-load every content image.
add_filter('wp_get_loading_optimization_attributes', function ($attributes, $tag_name, $attr, $context) {
    if ($tag_name === 'img' && $context === 'the_content' && is_singular('post')) {
        $attributes['loading'] = 'lazy';
        unset($attributes['fetchpriority']);
    }
    return $attributes;
}, 10, 4);
