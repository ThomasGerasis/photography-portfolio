<?php
get_header();
?>
<div id="preloader">
    <div class="loader"></div>
</div>
<div class="container mt-20p mb-20p d-block mx-auto align-items-center">

<?php
echo  apply_filters( 'the_content', get_the_content() );
?>

</div>
<?php
get_footer();
?>
