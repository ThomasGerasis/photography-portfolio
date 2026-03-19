<?php get_header(); ?>

<div id="preloader">
    <div class="loader"></div>
</div>

<div class="container mt-20p mb-20p mx-auto">
    <?php get_template_part('templates/breadcrumb'); ?>

    <?php
    $blog_categories = get_categories(['hide_empty' => true, 'orderby' => 'name', 'order' => 'ASC']);
    $has_categories  = !empty($blog_categories);
    ?>

    <?php if ($has_categories) : ?>

        <!-- Category filter pills -->
        <ul class="blog-filter__tabs nav" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                    class="blog-filter__btn active"
                    data-bs-toggle="tab"
                    data-bs-target="#blog-tab-all"
                    type="button" role="tab"
                    aria-controls="blog-tab-all"
                    aria-selected="true"
                ><?php esc_html_e('All'); ?></button>
            </li>
            <?php foreach ($blog_categories as $cat) : ?>
                <li class="nav-item" role="presentation">
                    <button
                        class="blog-filter__btn"
                        data-bs-toggle="tab"
                        data-bs-target="#blog-tab-<?= $cat->term_id; ?>"
                        type="button" role="tab"
                        aria-controls="blog-tab-<?= $cat->term_id; ?>"
                        aria-selected="false"
                    >
                        <?= esc_html($cat->name); ?>
                        <span class="blog-filter__count"><?= absint($cat->count); ?></span>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content">

            <!-- All posts pane (main WP query + pagination) -->
            <div class="tab-pane fade show active" id="blog-tab-all" role="tabpanel">
                <div class="alime-blog-area">
                    <div class="row">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <?php get_template_part('templates/partials/post-card'); ?>
                            </div>
                        <?php endwhile; else : ?>
                            <div class="col-12">
                                <p class="text-center text-muted"><?php esc_html_e('No posts found.'); ?></p>
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

            <!-- Per-category panes -->
            <?php foreach ($blog_categories as $cat) :
                $cat_query = new WP_Query([
                    'cat'            => $cat->term_id,
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                    'no_found_rows'  => true,
                ]);
            ?>
                <div class="tab-pane fade" id="blog-tab-<?= $cat->term_id; ?>" role="tabpanel">
                    <div class="alime-blog-area">
                        <div class="row">
                            <?php if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <?php get_template_part('templates/partials/post-card'); ?>
                                </div>
                            <?php endwhile; wp_reset_postdata(); else : ?>
                                <div class="col-12">
                                    <p class="text-center text-muted"><?php esc_html_e('No posts in this category yet.'); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($cat->count > 6) : ?>
                        <div class="blog-filter__view-all">
                            <a href="<?= esc_url(get_category_link($cat->term_id)); ?>" class="button-glow">
                                <?php printf(esc_html__('View all %s articles'), esc_html($cat->name)); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>

    <?php else : ?>

        <!-- No categories — plain grid with pagination -->
        <div class="alime-blog-area">
            <div class="row">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <?php get_template_part('templates/partials/post-card'); ?>
                    </div>
                <?php endwhile; else : ?>
                    <div class="col-12">
                        <p class="text-center text-muted"><?php esc_html_e('No posts found.'); ?></p>
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

    <?php endif; ?>
</div>

<?php get_footer(); ?>
