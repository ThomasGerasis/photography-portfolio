<?php /* Template Name: Contact Page */ ?>

<?php
get_header();

$settings = get_option('basic_settings');

?>

<div id="preloader">
    <div class="loader"></div>
</div>

<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID)?>')">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h1 class="page-title">Contact</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo home_url();?>"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<div class="container container_pages mt-20p mb-20p d-block mx-auto align-items-center">
    <div class="contact_wrap container position-relative mb-50p mt-40p">
        <?php
        if (!$GLOBALS['is_mobile']){
            ?>
            <div class="position-absolute" style="right: -6%; top: -2%;">
                <img alt="lens" src="<?php echo get_stylesheet_directory_uri().'/assets/images/lensdivider.svg'?>" width="355" height="460" class="d-block img-fluid" loading="lazy">
            </div>
            <?php
        }
        ?>
        <div class="wrapper img">
            <div class="row container__main m-auto position-relative">
                <div class="col-12 col-md-6 p-md-5 p-4">
                    <p class="w-100 d-block heading_title">Contact</p>
                    <h3 class="mb-10p">Got Some Questions ? More than happy to help you !</h3>
                    <a class="mt-10p mb-10p" href=mailto:“<?=$settings['email'] ?? '';?>”><?=$settings['email'] ?? '';?></a>
                    <ul class="social mt-20p">
                        <li>
                            <a href="<?=$settings['facebook'] ?? '';?>" target="_blank" title="">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?=$settings['instagram'] ?? '';?>" target="_blank" title="">
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

                            <div id="recaptcha" class="g-recaptcha col-12" data-sitekey="6LeDDeoUAAAAABqGSHZboQs6FAug60g_k-waqo0D"></div>
                            <input type="hidden" id="g-recaptcha-response">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="SUBMIT MESSAGE" class="btn w-100  submit-btn mt-15">
                                    <div class="submitting"></div>
                                </div>
                            </div>
                            <div id="form-message-success" class="mb-4 w-100 d-block text-center text-success"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
get_footer();
?>


