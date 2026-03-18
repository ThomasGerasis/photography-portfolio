<?php
function breadcrumbSchema()
{
    $crumbs = [];

    $crumbs[] = ['label' => __('Home'), 'url' => home_url('/')];

    if (is_home() && !is_front_page()) {
        $blog_page = get_option('page_for_posts');
        $crumbs[]  = ['label' => get_the_title($blog_page), 'url' => get_permalink($blog_page)];
    } elseif (is_tax()) {
        $term     = get_queried_object();
        $taxonomy = get_taxonomy($term->taxonomy);
        $root_page = get_page_by_path($term->taxonomy);
        $crumbs[]  = [
            'label' => $taxonomy->labels->name,
            'url'   => $root_page ? get_permalink($root_page) : home_url('/')
        ];
        $crumbs[] = ['label' => $term->name, 'url' => get_term_link($term)];
    } elseif (is_category()) {
        $category  = get_queried_object();
        $ancestors = array_reverse(get_ancestors($category->term_id, 'category'));
        foreach ($ancestors as $ancestor_id) {
            $ancestor = get_category($ancestor_id);
            $crumbs[] = ['label' => $ancestor->name, 'url' => get_category_link($ancestor_id)];
        }
        $crumbs[] = ['label' => $category->name, 'url' => get_category_link($category->term_id)];
    } elseif (is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            $crumbs[] = ['label' => $categories[0]->name, 'url' => get_category_link($categories[0]->term_id)];
        }
        $crumbs[] = ['label' => get_the_title(), 'url' => get_permalink()];
    } elseif (is_page()) {
        $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
        foreach ($ancestors as $ancestor_id) {
            $crumbs[] = ['label' => get_the_title($ancestor_id), 'url' => get_permalink($ancestor_id)];
        }
        $crumbs[] = ['label' => get_the_title(), 'url' => get_permalink()];
    }

    // Only output schema when there is more than just the home crumb
    if (count($crumbs) < 2) {
        return '';
    }

    $listItems = [];
    foreach ($crumbs as $position => $crumb) {
        $listItems[] = [
            "@type"    => "ListItem",
            "position" => $position + 1,
            "name"     => strip_tags($crumb['label']),
            "item"     => esc_url($crumb['url'])
        ];
    }

    $schema = [
        "@context"        => "https://schema.org",
        "@type"           => "BreadcrumbList",
        "itemListElement" => $listItems
    ];

    return '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
