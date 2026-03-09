<?php
get_header();
?>

<div id="preloader">
    <div class="loader"></div>
</div>

<?php
$category = get_queried_object();
$orderBy = $category->term_id === 4 ? 'DESC' : 'ASC';
$postsPerPage = get_option('posts_per_page');

// Get ACF custom fields
$category_content = get_field('category_content', 'category_' . $category->term_id);
?>


<div class="container mb-20p d-block mx-auto align-items-center p-10p">
    <?php get_template_part('templates/breadcrumb'); ?>
    <?php if (!empty($category_content)) : ?>
        <div class="category-content-section d-slock mx-auto">
            <div class="category-content text-dark text-justify">
                <?= do_shortcode($category_content); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
