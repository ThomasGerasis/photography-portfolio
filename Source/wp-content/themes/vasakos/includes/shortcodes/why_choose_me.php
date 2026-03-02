<?php
/**
 * Why Choose Me Shortcode
 * Usage: [why_choose_me title="Why Choose Me"]
 *        [why_choose_me page_id="123"]
 *        [why_choose_me category_id="4"]
 */

function why_choose_me_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'title' => 'Why Choose Me',
            'page_id' => '',
            'category_id' => '',
        ),
        $atts,
        'why_choose_me'
    );

    $source_id = null;
    $is_term = false;

    // Determine where to get the data from
    if (!empty($atts['category_id'])) {
        $source_id = $atts['category_id'];
        $is_term = true;
    }
    elseif (is_category() && empty($atts['page_id'])) {
        $category = get_queried_object();
        if ($category && isset($category->term_id)) {
            $source_id = $category->term_id;
            $is_term = true;
        }
    }
    else {
        $source_id = !empty($atts['page_id']) ? $atts['page_id'] : get_the_ID();
    }

    // Get reasons from meta
    if ($is_term) {
        $reasons = get_term_meta($source_id, 'why_choose_reasons', true);
    } else {
        $reasons = get_post_meta($source_id, 'why_choose_reasons', true);
    }

    // Fallback to default reasons if none are set
    if (empty($reasons) || !is_array($reasons)) {
        $reasons = array(
            array(
                'icon' => 'fas fa-camera-retro',
                'title' => 'Professional Quality',
                'description' => 'Years of experience capturing stunning moments with top-tier equipment and expertise.'
            ),
            array(
                'icon' => 'fas fa-heart',
                'title' => 'Personalized Service',
                'description' => 'Every shoot is tailored to your unique vision and style, ensuring authentic results.'
            ),
            array(
                'icon' => 'fas fa-clock',
                'title' => 'Fast Turnaround',
                'description' => 'Receive your professionally edited photos quickly without compromising on quality.'
            ),
            array(
                'icon' => 'fas fa-trophy',
                'title' => 'Award-Winning',
                'description' => 'Recognized excellence in photography with a portfolio of satisfied clients.'
            ),
        );
    }

    ob_start();
    
    $item_count = count($reasons);
    $section_class = ($item_count === 5) ? 'why-choose-section has-5-items' : 'why-choose-section';
?>
    <!-- Why Choose Me Section Start -->
    <section class="<?php echo $section_class; ?> mt-50p mb-50p">
        <div class="container text-center">
            <?php if (!empty($atts['title'])) : ?>
                <h2 class="section-title mb-40p"><?php echo esc_html($atts['title']); ?></h2>
            <?php endif; ?>
            <div class="row justify-content-center">
                <?php foreach ($reasons as $reason) : ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                        <div class="choose-card p-20p">
                            <div class="icon-wrapper mb-20p">
                                <i class="<?php echo esc_attr($reason['icon']); ?> fa-3x"></i>
                            </div>
                            <h3 class="card-title mb-15p"><?php echo esc_html($reason['title']); ?></h3>
                            <p class="card-description"><?php echo esc_html($reason['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Why Choose Me Section End -->
<?php

    return ob_get_clean();
}
add_shortcode('why_choose_me', 'why_choose_me_shortcode');
