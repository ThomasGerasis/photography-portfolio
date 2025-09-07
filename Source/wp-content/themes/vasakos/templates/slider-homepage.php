<?php
$sliders = get_option('slider_home_settings');

$width = $GLOBALS['is_mobile'] ? '660' : '1920';
$height = $GLOBALS['is_mobile'] ? '480' : '1280';

$totalSliders = count($sliders);
?>
<div class="position-relative homepage-slider aheto-banner-slider--snapster-modern">
    <section class="aheto-banner-slider__container snapster-full-min-height-js swiper" data-loop="1" data-autoplay="1" data-autoplay-speed="8">
        <div class="slice-overlay"></div>
        <div class="aheto-banner-slider__bgimg">
            <?php for ($i = 1; $i <= $totalSliders; $i++) {
            ?>
                <div class="slider-piece">
                    <?php
                    $slides = 0;
                    foreach ($sliders as $slider) {
                        $class = $slides == 0 ? 'active' : '';
                        $classLazy = $slides !== 0 ? 'lazy-background' : '';
                    ?>
                        <div class="slice-item <?= $class; ?>">
                            <div class="<?= $classLazy; ?>" style="background-image: url('<?= $slider['image']; ?>;')"></div>
                        </div>
                    <?php
                        $slides++;
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="aheto-banner-slider__content">
            <?php
            $a = 0;
            foreach ($sliders as $slider) {
                $class = $a == 0 ? 'active' : '';
            ?>
                <div class="aheto-banner-slider__text <?= $class; ?>">
                    <p class="subtitle"><?= $slider['title']; ?></p>
                    <div class="title "><?= $slider['text']; ?></div>
                </div>
            <?php
                $a++;
            }
            ?>
        </div>

        <div class="aheto-banner-slider__pagination swiper-pagination">
            <div class="aheto-banner-slider__pagination--counters">
                <?php
                $counterPagination = 1;
                foreach ($sliders as $slider) {
                ?>
                    <input id="aheto-bs--snapster-modern-28-img-<?= $counterPagination; ?>" name="aheto-bs--snapster-modern-28" type="radio" checked="" data-count="<?= $counterPagination; ?>">
                    <label for="aheto-bs--snapster-modern-28-img-<?= $counterPagination; ?>" class="aheto-banner-slider__label-img-<?= $counterPagination; ?> <?= $counterPagination === 1 ? 'active' : ''; ?>"></label>
                <?php
                    $counterPagination++;
                }
                ?>
            </div>
        </div>

        <?php if (!$GLOBALS['is_mobile']) {
        ?>
            <div class="aheto-banner-slider__buttons">
                <div class="aheto-banner-slider__buttons-prev swiper-button-prev">
                    <span data-text="PREV PROJECT"></span>
                </div>
                <div class="aheto-banner-slider__buttons-next swiper-button-next">
                    <span data-text="NEXT PROJECT"></span>
                </div>
            </div>
        <?php
        }
        ?>

    </section>

</div>