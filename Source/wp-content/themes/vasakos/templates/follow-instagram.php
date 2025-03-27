<?php
$settings = get_option('basic_settings');
?>
<section class="follow-area clearfix mb-10p <?= $GLOBALS['is_mobile'] ? 'p-10p' : ''?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Follow my work on Instagram</h2>
                    <span class="heading_title">@vasakos_3vh</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Feed Area -->
    <div class="instragram-feed-area owl-carousel">
        <!-- Single Instagram Item -->
        <?php
        $sliders = get_option('slider_settings');
        foreach ($sliders as $slider){
            if ($slider['image']){
            ?>
            <div class="single-instagram-item">
                <img src="<?php echo $slider['image'] ;?>" loading="lazy" alt="<?php echo $slider['text'] ;?>">
                <a href="<?php echo $settings['instagram'] ?? '' ;?>" target="_blank" class="instagram-hover-content text-white text-center
                d-flex flex-column align-items-center justify-content-center">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                        <span>Vasakos_3vh</span>
                </a>
            </div>
            <?php
            }
        }
        ?>
    </div>
</section>
<!-- Follow Area End -->
