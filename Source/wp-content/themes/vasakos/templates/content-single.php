<?php
$words        = str_word_count(wp_strip_all_tags(strip_shortcodes(get_the_content())));
$reading_time = max(1, (int) ceil($words / 200));
$share_url    = rawurlencode(get_permalink());
$share_title  = rawurlencode(get_the_title());
$svg          = 'class="post-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"';
$fill         = 'class="post-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"';
?>
<div class="post-meta-row">
    <div class="post-meta-row__info">
        <span>
            <svg <?= $svg; ?>><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            <?= esc_html(get_the_date()); ?>
        </span>
        <span>
            <svg <?= $svg; ?>><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <?= esc_html(sprintf(__('%d min read', 'vasakos'), $reading_time)); ?>
        </span>
    </div>
    <div class="post-share">
        <button type="button" class="post-share__btn post-share__native" hidden aria-label="<?= esc_attr__('Share', 'vasakos'); ?>" data-share-title="<?= esc_attr(get_the_title()); ?>" data-share-url="<?= esc_url(get_permalink()); ?>">
            <svg <?= $svg; ?>><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.600 13.500l6.800 4M15.400 6.500l-6.800 4"/></svg>
        </button>
        <a class="post-share__btn" aria-label="WhatsApp" href="https://wa.me/?text=<?= $share_title . '%20' . $share_url; ?>" target="_blank" rel="noopener">
            <svg <?= $fill; ?>><path d="M12 2a10 10 0 0 0-8.5 15.2L2 22l4.9-1.4A10 10 0 1 0 12 2zm5.2 14.2c-.2.6-1.300 1.200-1.800 1.200-.5.1-1 .2-3.300-.7-2.800-1.100-4.600-4-4.700-4.200-.1-.2-1.100-1.500-1.100-2.800s.7-2 1-2.300c.2-.3.500-.3.700-.3h.5c.2 0 .4 0 .6.500l.8 2c.1.200.1.300 0 .5l-.4.600c-.1.100-.3.300-.1.600.2.300.8 1.300 1.700 2.100 1.200 1 2.100 1.300 2.400 1.500.3.100.5.100.6-.1l.9-1.100c.2-.3.400-.2.600-.1l1.900.9c.3.100.5.200.5.300.1.100.1.600-.1 1.100z"/></svg>
        </a>
        <a class="post-share__btn" aria-label="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= $share_url; ?>" target="_blank" rel="noopener">
            <svg <?= $fill; ?>><path d="M14 8V6.500c0-.7.200-1 1.200-1H17V2h-2.800C11.300 2 10 3.700 10 6v2H7.500v3.500H10V22h4V11.500h2.800L17.300 8z"/></svg>
        </a>
        <a class="post-share__btn" aria-label="Pinterest" href="https://pinterest.com/pin/create/button/?url=<?= $share_url; ?>&description=<?= $share_title; ?>" target="_blank" rel="noopener">
            <svg <?= $fill; ?>><path d="M12 2a10 10 0 0 0-3.600 19.300c-.1-.8-.2-2 0-2.900l1.200-5s-.3-.6-.3-1.500c0-1.400.8-2.400 1.800-2.400.9 0 1.300.6 1.300 1.400 0 .9-.5 2.100-.8 3.300-.2 1 .5 1.800 1.500 1.800 1.800 0 3.200-1.900 3.200-4.600 0-2.400-1.700-4.100-4.200-4.100-2.900 0-4.600 2.200-4.600 4.400 0 .9.300 1.800.8 2.300.1.100.1.200.1.300l-.3 1.200c0 .2-.2.200-.4.100-1.300-.6-2.100-2.500-2.100-4 0-3.300 2.400-6.300 6.900-6.300 3.600 0 6.400 2.600 6.400 6 0 3.600-2.300 6.500-5.400 6.500-1.100 0-2.100-.6-2.400-1.200l-.7 2.500c-.2.900-.9 2-1.300 2.700A10 10 0 1 0 12 2z"/></svg>
        </a>
        <button type="button" class="post-share__btn" aria-label="<?= esc_attr__('Copy link', 'vasakos'); ?>" data-copy-link="<?= esc_url(get_permalink()); ?>">
            <svg <?= $svg; ?>><path d="M10 13a5 5 0 0 0 7.100 0l3-3a5 5 0 0 0-7.100-7.100l-1.700 1.700"/><path d="M14 11a5 5 0 0 0-7.100 0l-3 3a5 5 0 0 0 7.100 7.100l1.700-1.700"/></svg>
        </button>
    </div>
</div>
<div class="entry-content">
    <?php
    the_content(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'zakra'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        )
    );

    wp_link_pages(
        array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'zakra'),
            'after'  => '</div>',
        )
    );
    ?>
</div><!-- .entry-content -->
<script>
(function () {
    var nativeBtn = document.querySelector('.post-share__native');
    if (!nativeBtn || !navigator.share || !window.matchMedia('(pointer: coarse)').matches) return;
    nativeBtn.hidden = false;
    document.querySelectorAll('.post-share__btn:not(.post-share__native)').forEach(function (el) { el.hidden = true; });
    nativeBtn.addEventListener('click', function () {
        navigator.share({ title: nativeBtn.dataset.shareTitle, url: nativeBtn.dataset.shareUrl }).catch(function () {});
    });
})();
document.querySelectorAll('[data-copy-link]').forEach(function (btn) {
    btn.addEventListener('click', function () {
        navigator.clipboard.writeText(btn.dataset.copyLink).then(function () {
            btn.classList.add('is-copied');
            setTimeout(function () { btn.classList.remove('is-copied'); }, 1500);
        });
    });
});
</script>
