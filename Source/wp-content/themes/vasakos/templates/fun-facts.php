<?php $funFacts = get_post_meta(get_the_ID(), 'fun_facts_meta', true); ?>
<div class="container-fluid w-100 mb-20 mt-5 bg-dark">
    <div class="fun-facts container d-flex flex-wrap w-100">
        <h2 class="w-100 d-block text-center text-white mb-2">Fun Facts</h3>
            <p class="w-100 d-block text-center text-white heading_title mb-5">Things to know about me</p>
            <?php foreach ($funFacts as $funFact) { ?>
                <div class="column">
                    <div class="card <?php echo str_replace(' ', '-', strtolower($funFact['heading'])) . '_card'; ?>">
                        <style>
                            .<?php echo str_replace(' ', '-', strtolower($funFact['heading'])) . '_card'; ?> {
                                background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                                    url('<?= $funFact['bg_image'] ?? '' ?>') ! important;
                            }
                        </style>
                        <div class="icon-wrapper">
                            <?php if (isset($funFact['round_image'])) { ?>
                                <img src="<?= $funFact['round_image'] ?>" height="25" width="25" loading="lazy" alt="<?= $funFact['heading'] ?? '' ?>">
                            <?php } ?>
                        </div>
                        <h3><?= $funFact['heading'] ?? '' ?></h3>
                        <p>
                            <?= $funFact['description'] ?? '' ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
    </div>
</div>