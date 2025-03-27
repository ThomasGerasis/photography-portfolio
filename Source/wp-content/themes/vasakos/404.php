<?php
get_header();
?>
<div id="preloader">
    <div class="loader"></div>
</div>
<div class="container mt-20p mb-20p d-block mx-auto align-items-center">

    <div class="col-12 d-flex justify-content-center" id="404_wrapper">
        <div class="notfound justify-content-center">
            <div class="notfound-404">
                <h1 class="d-flex">
                    4
                    <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/lensdivider.svg'?>" width="140" height="125" class="d-block img-fluid">
                    4
                </h1>
                <h2>Oops! Page Not Be Found</h2>
                <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
                <a href="/" class="border-btn text-dark border-btn-dark">Back to homepage</a>
            </div>
        </div>
    </div>

</div>
<?php
get_footer();
?>
