<?php get_header(); ?>

<div id="preloader">
    <div class="loader"></div>
</div>

<div class="container mt-20p mb-20p mx-auto">
    <?php get_template_part('templates/breadcrumb'); ?>

    <?php if (category_description()) : ?>
        <div class="category-content-section mb-20p">
            <div class="category-content text-dark text-justify">
                <?= category_description(); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="alime-blog-area">
        <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <?php get_template_part('templates/partials/post-card'); ?>
                </div>
            <?php endwhile; else : ?>
                <div class="col-12">
                    <p class="text-center text-muted"><?php esc_html_e('No posts found in this category.'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
    $pagination_links = paginate_links([
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'type'      => 'array',
    ]);
    if ($pagination_links) :
    ?>
        <nav class="d-flex justify-content-center mt-20p" aria-label="<?php esc_attr_e('Posts navigation'); ?>">
            <ul class="pagination">
                <?php foreach ($pagination_links as $link) :
                    $is_current = strpos($link, 'current') !== false;
                    echo '<li class="page-item' . ($is_current ? ' active' : '') . '">';
                    echo str_replace(
                        ['<a ',     '</a>', '<span ',     '</span>'],
                        ['<a class="page-link" ', '</a>', '<span class="page-link" ', '</span>'],
                        $link
                    );
                    echo '</li>';
                endforeach; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php get_footer();
