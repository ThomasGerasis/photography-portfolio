<section class="wow fadeIn animated bg-dark" style="visibility: visible; animation-name: fadeIn;">
    <div class="container">
        <div class="row">
            <?php $counters = get_post_meta($post->ID, 'counter_meta', true); ?>
            <?php foreach ($counters as $counter) { ?>
                <div class="col-md-3 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated" data-wow-duration="900ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeInUp;">
                    <?php if (isset($counter['icon'])) { ?>
                        <img src="<?= $counter['icon'] ?>" loading="lazy" height="32" width="32" alt="<?= $counter['title'] ?? '' ?>">
                    <?php } ?>
                    <span id="anim-number-pizza" class="counter-number"></span>
                    <span class="timer counter alt-font appear" data-to="<?= $counter['number'] ?? '' ?>" data-speed="7000"><?= $counter['number'] ?? '' ?></span>
                    <p class="counter-title"><?= $counter['title'] ?? '' ?></p>
                </div>
            <?php } ?>
            <!-- end counter -->
        </div>
    </div>
</section>