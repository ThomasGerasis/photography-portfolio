<?php
get_header();
$settings = get_option('basic_settings');
?>

<div id="preloader">
    <div class="loader"></div>
</div>

<?php get_template_part('templates/slider-homepage'); ?>

<div class="container container_pages mb-20p d-block mx-auto align-items-center p-0">

<div class="section_categories d-flex flex-wrap mt-50p w-100">
        <img alt="camera lens" src="<?php echo get_stylesheet_directory_uri().'/assets/images/lensdivider.svg'?>" width="150" height="70" class="d-block img-fluid m-auto" loading="lazy">
        <h1 class="w-100 d-block text-dark text-center heading_title ">Vasileios  Vasakos</h1>
        <h2 class="w-100 d-block text-dark text-center"><?=get_the_title($post->ID) ?? '';?></h2>
        <div class="w-100 d-block text-dark text-center p-10p"><?=get_the_content($post->ID) ?? '';?></div>

     <div class="position-relative w-100">
        <?php if (!$GLOBALS['is_mobile']){ ?>
            <div class="position-absolute divider w-100 text-center" style="background: #E1E1E1;height: 220px;top:120px;"></div>
        <?php } ?>
          <div style="z-index: 2">
              <?php echo do_shortcode('[popular_categories]') ?>
          </div>
    </div>
</div>

<div class="w-70 w-sm-100 d-block mx-auto text-dark text-center p-10p">
    <?= get_post_meta($post->ID,'homepage_mini_bio_more',true) ?? '';?>
</div>

<?php get_template_part('templates/testimonials'); ?>

</div>

<style>
    [class="bg-fixed w-100 lazy-background <?= $GLOBALS['is_mobile'] ? 'mt-50p mb-20p' : 'mt-70p mb-50p'?> visible"] {
        background: url('<?php echo get_post_meta($post->ID,'parralax_image',true);?>') no-repeat center center;
        background-attachment:  <?= $GLOBALS['is_mobile'] ? 'scroll' : 'fixed' ?>;
        <?= $GLOBALS['is_mobile'] ? 'background-size:cover;' : '' ?>
    }
</style>
<div class="bg-fixed w-100 lazy-background <?= $GLOBALS['is_mobile'] ? 'mt-50p mb-20p' : 'mt-70p mb-50p'?>" style="<?= $GLOBALS['is_mobile'] ? 'min-height: 250px' : 'min-height: 300px' ?>;">
    <div class="d-flex flex-wrap w-100  justify-content-center slider-title bg-trans" style="<?= $GLOBALS['is_mobile'] ? 'min-height: 250px' : 'min-height: 300px' ?>;">
        <div class="d-flex flex-wrap container__main m-auto">
            <span class="text-white ml-20p w-100 text-center pt-2 pt-lg-0 align-self-center parallax-text">Need a <span class="banner_italic text-secondary">Photographer</span> ? Someone With Experience to <span class="banner_italic text-secondary">Collaborate</span> With?</span>
            <div class="btn_container_borders ml-20p ml-sm-0 w-100">
                <a href="/contact-us/" class="border-btn text-white" target="_self" aria-label="LET'S WORK TOGETHER!">LET'S WORK TOGETHER!</a>
            </div>
        </div>

    </div>
</div>


<div class="contact_wrap container position-relative mb-50p mt-40p">
    <?php if (!$GLOBALS['is_mobile']){ ?>
        <div class="position-absolute camera-lens" style="right: -6%; top: -2%;">
            <img alt="lens" src="<?php echo get_stylesheet_directory_uri().'/assets/images/lensdivider.svg'?>" width="355" height="460" class="d-block img-fluid" loading="lazy">
        </div>
        <?php } ?>
    <div class="wrapper img">
        <div class="row container__main m-auto position-relative">
            <div class="col-12 col-md-6 p-md-5 p-4">
                <p class="w-100 d-block heading_title">Contact</p>
                <h3 class="mb-10p">Got Some Questions ? More than happy to help you !</h3>
                <a class="mt-10p mb-10p" href=mailto:“<?=$settings['email'] ?? '';?>”><?=$settings['email'] ?? '';?></a>
                <ul class="social mt-20p">
                    <li>
                        <a href="<?=$settings['facebook'] ?? '';?>" aria-label="Facebook" target="_blank" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=$settings['instagram'] ?? '';?>" aria-label="Instagram" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="contact-wrap col-12 col-md-6 p-md-5 p-4">
                <form method="POST" id="contactForm" name="contactForm" class="contactForm color-dark" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Your Name*">
                                <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email*">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="loader" style="display: none;margin-bottom: 25px;margin-left: auto;margin-right: auto;"></div>

                        <div id="recaptcha" class="g-recaptcha col-12" data-sitekey="6LfORqslAAAAAO_VAaiMqqHSSV_Mi22qaNt7D1w7"></div>
                        <input type="hidden" id="g-recaptcha-response">

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" value="SUBMIT MESSAGE" class="btn w-100  submit-btn mt-15">
                                <div class="submitting"></div>
                            </div>
                        </div>
                        <div  id="form-message-success" class="mb-4 w-100 d-block text-center text-success"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('templates/follow-instagram'); ?>

<?php get_footer(); ?>
