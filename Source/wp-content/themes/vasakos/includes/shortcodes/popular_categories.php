<?php

function popular_categories_callback($atts, $content = null)
{
    $atts = shortcode_atts(
        array(
            '' => '',
        ), $atts, 'popular_categories');

    ob_start();

    $categories = get_categories([
        'taxonomy'  => 'category',
        'orderby'   => 'count',
        'order'     => 'DESC',
        'hide_empty'=> true,
        'number'    => 4
    ]);
    ?>
    <div class="top__categories d-flex flex-wrap justify-content-center <?= $GLOBALS['is_mobile'] ? 'mt-40p mb-20p' : 'mt-40p mb-40p'?> ">
    <?php
    foreach ($categories as $category){
          $catID =  $category->term_id;
          $image =  get_field('category_image','category_'.$catID);
        ?>

        <style>
           .single-portfolio-content.lazy-background.<?=$category->slug?>.visible{
                background-image: url('<?php echo $image;?>');
           }
        </style>
        <a href="<?php echo get_term_link($category->slug, 'category');?>" class="mt-10p mb-10p single_gallery_item category_item b-30 wow fadeInUp" data-wow-delay="100ms">
            <div class="single-portfolio-content lazy-background <?=$category->slug?>">
                <div class="image-overlay"></div>
                <span class="font-weight-bold d-block category_name text-white text-35 text-center"><?php echo $category->name; ?>
            </div>
        </a>
        <?php
    }
    ?>
    </div>
        <?php

    return ob_get_clean();
}
add_shortcode('popular_categories', 'popular_categories_callback');