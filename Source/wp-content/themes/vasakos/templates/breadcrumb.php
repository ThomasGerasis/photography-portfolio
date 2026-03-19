<?php

/**
 * Breadcrumb partial
 * Usage: get_template_part('templates/partials/breadcrumb');
 *
 * Automatically builds the correct trail for:
 *   - Taxonomy archive pages  → Home > Taxonomy label > Term name
 *   - Category archive pages  → Home > Category name
 *   - Single posts            → Home > Category > Post title
 *   - Pages                   → Home > Page title
 */

$crumbs = [];

// Always start with Home
$crumbs[] = ['label' => __('Home'), 'url' => home_url('/')];

if (is_home() && !is_front_page()) {
    $blog_page = get_option('page_for_posts');
    $crumbs[]  = ['label' => get_the_title($blog_page), 'url' => ''];
} elseif (is_tax()) {
    $term     = get_queried_object();
    $taxonomy = get_taxonomy($term->taxonomy);

    // Link to a "photoshoots" root page if one exists with the taxonomy slug
    $root_page = get_page_by_path($term->taxonomy);
    if ($root_page) {
        $crumbs[] = ['label' => $taxonomy->labels->name, 'url' => get_permalink($root_page)];
    } else {
        $crumbs[] = ['label' => $taxonomy->labels->name, 'url' => ''];
    }

    $crumbs[] = ['label' => $term->name, 'url' => ''];
} elseif (is_category()) {
    $category = get_queried_object();

    // Walk up parent categories
    $ancestors = array_reverse(get_ancestors($category->term_id, 'category'));
    foreach ($ancestors as $ancestor_id) {
        $ancestor = get_category($ancestor_id);
        $crumbs[] = ['label' => $ancestor->name, 'url' => get_category_link($ancestor_id)];
    }

    $crumbs[] = ['label' => $category->name, 'url' => ''];
} elseif (is_single()) {
    $categories = get_the_category();
    if (!empty($categories)) {
        $crumbs[] = ['label' => $categories[0]->name, 'url' => get_category_link($categories[0]->term_id)];
    }
    $crumbs[] = ['label' => get_the_title(), 'url' => ''];
} elseif (is_page()) {
    // Walk up parent pages
    $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
    foreach ($ancestors as $ancestor_id) {
        $crumbs[] = ['label' => get_the_title($ancestor_id), 'url' => get_permalink($ancestor_id)];
    }
    $crumbs[] = ['label' => get_the_title(), 'url' => ''];
}
?>

<nav class="vasakos-breadcrumb mb-10p" aria-label="<?php esc_attr_e('Breadcrumb'); ?>">
    <ol class="breadcrumb">
        <?php foreach ($crumbs as $i => $crumb) :
            $is_last = ($i === count($crumbs) - 1);
        ?>
            <li class="breadcrumb-item<?php echo $is_last ? ' active' : ''; ?>"
                <?php if ($is_last) : ?>aria-current="page" <?php endif; ?>>
                <?php if (!$is_last && !empty($crumb['url'])) : ?>
                    <a href="<?php echo esc_url($crumb['url']); ?>">
                        <?php if ($i === 0) : ?><i class="fas fa-home" aria-hidden="true"></i> <?php endif; ?>
                        <?php echo esc_html($crumb['label']); ?>
                    </a>
                <?php else : ?>
                    <?php if ($i === 0) : ?><i class="fas fa-home" aria-hidden="true"></i> <?php endif; ?>
                    <?php echo esc_html($crumb['label']); ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>