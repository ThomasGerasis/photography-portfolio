<div class="position-relative w-100 testimonial_wrapper container__main d-block mx-auto <?= $GLOBALS['is_mobile'] ? 'mt-20p' : 'mt-50p' ?> p-10p">
    <?php if (!$GLOBALS['is_mobile']) {
    ?>
        <div class="position-absolute camera-lens" style="right: -10%;top: -2%;">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/lensdivider.svg' ?>" alt="camera lens" width="200" height="350" class="d-block img-fluid" loading="lazy">
        </div>
    <?php
    }
    ?>

    <div class="d-flex flex-wrap justify-content-start pl-lg-5 pl-0 mt-20p">
        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/lensdivider.svg' ?>" alt="camera lens" width="80" height="90" class="d-block img-fluid" loading="lazy">
        <h3 class="w-100">TESTIMONIALS</h3>
    </div>

    <div class="testimonials__area owl-carousel d-flex flex-wrap w-100">
        <?php
        $query_args = array(
            'post_type' => 'testimonials',
            'post_status' => 'publish',
            'fields' => 'ids',
            'posts_per_page' => 6,
            'order' => 'ASC',
        );
        $testimonials = get_posts($query_args);
        if ($testimonials) {
            $i = 0;
            $len = count($testimonials);
            foreach ($testimonials as $testimonial) {
                $author = get_post_meta($testimonial, 'author', true);
        ?>
                <div class="testimonial-box position-relative <?php echo !$GLOBALS['is_mobile']  ? 'border-testimonial ' : ''; ?>">
                    <span class="quote-testi">“</span>
                    <p class="testimonial-text">
                        <?php echo wp_strip_all_tags(get_post_field('post_content', $testimonial)); ?>
                    </p>
                    <span class="blockquote-footer">
                        <cite title="Source Title"><?php echo $author; ?></cite>
                    </span>
                </div>
        <?php
                $i++;
            }
            wp_reset_postdata();
        }
        ?>
    </div>

</div>