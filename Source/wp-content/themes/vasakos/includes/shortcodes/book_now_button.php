<?php
/**
 * Book Now Button Shortcode
 * Usage: [book_now_button package_id="0" text="Book This Package" class="btn-primary" target="#contactForm"]
 * For dropdown: [book_now_button type="dropdown" text="Book Now" page_id="123"]
 */

function book_now_button_shortcode($atts)
{
    $atts = shortcode_atts(
        array(
            'type' => 'single', // 'single' or 'dropdown'
            'package_id' => '', // For single type: the package index
            'text' => 'Book Now',
            'class' => 'alime-btn bg-secondary',
            'target' => '#contactForm',
            'page_id' => '', // Page containing pricing packages
            'align' => 'left', // 'left', 'center', 'right'
        ),
        $atts,
        'book_now_button'
    );

    // Sanitize alignment
    $align = in_array($atts['align'], array('left', 'center', 'right')) ? $atts['align'] : 'left';
    $align_class = '';
    $align_style = '';
    
    switch($align) {
        case 'center':
            $align_class = 'text-center';
            $align_style = 'text-align: center;';
            break;
        case 'right':
            $align_class = 'text-right';
            $align_style = 'text-align: right;';
            break;
        default:
            $align_class = 'text-left';
            $align_style = 'text-align: left;';
    }

    ob_start();

    if ($atts['type'] === 'dropdown') {
        // Get packages for dropdown
        $packages = array();
        if (!empty($atts['page_id'])) {
            $packages = get_post_meta($atts['page_id'], 'pricing', true);
        } else {
            // Try to find pricing page
            $pricing_pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'pricing-page.php'
            ));
            if (!empty($pricing_pages)) {
                $packages = get_post_meta($pricing_pages[0]->ID, 'pricing', true);
            }
        }

        if (empty($packages)) {
            echo '<p>No packages available</p>';
        } else {
?>
            <div class="book-now-dropdown <?= esc_attr($align_class); ?>" style="<?= esc_attr($align_style); ?>">
                <select id="package-selector" class="form-select form-select-lg mb-3" style="max-width: 400px;">
                    <option value="" selected>Select a package...</option>
                    <?php foreach ($packages as $id => $package) { ?>
                        <option value="<?= esc_attr($id); ?>">
                            <?= esc_html($package['title']); ?>
                            <?php if (!empty($package['price'])) { ?>
                                - £<?= esc_html($package['price']); ?>
                            <?php } ?>
                        </option>
                    <?php } ?>
                </select>
                <a href="<?= esc_attr($atts['target']); ?>" class="book-now-btn <?= esc_attr($atts['class']); ?>" id="book-now-link">
                    <?= esc_html($atts['text']); ?>
                </a>
            </div>
            <script>
                (function() {
                    const selector = document.getElementById('package-selector');
                    const bookBtn = document.getElementById('book-now-link');
                    const originalHref = bookBtn.getAttribute('href');

                    selector.addEventListener('change', function() {
                        const packageId = this.value;
                        if (packageId) {
                            bookBtn.classList.remove('disabled');
                            bookBtn.setAttribute('data-service', packageId);

                            // Scroll to contact form and pre-select package
                            bookBtn.addEventListener('click', function(e) {
                                const serviceSelect = document.getElementById('service');
                                if (serviceSelect) {
                                    setTimeout(() => {
                                        serviceSelect.value = packageId;
                                    }, 300);
                                }
                            });
                        } else {
                            bookBtn.classList.add('disabled');
                            bookBtn.removeAttribute('data-service');
                        }
                    });
                })();
            </script>
            <?php
        }
    } else {
        // Single button with optional pre-selected package
            ?>
        <div class="book-now-wrapper <?= esc_attr($align_class); ?>" style="<?= esc_attr($align_style); ?>">
            <a href="<?= esc_attr($atts['target']); ?>" class="package-btn <?= esc_attr($atts['class']); ?>" <?php if (!empty($atts['package_id'])) { ?> data-service="<?= esc_attr($atts['package_id']); ?>" <?php } ?>>
                <?= esc_html($atts['text']); ?>
            </a>
        </div>
        <?php if (!empty($atts['package_id'])) { ?>
            <script>
                (function() {
                    document.addEventListener('DOMContentLoaded', function() {
                        const bookBtns = document.querySelectorAll('.package-btn[data-service]');
                        bookBtns.forEach(btn => {
                            btn.addEventListener('click', function(e) {
                                const serviceId = this.getAttribute('data-service');
                                const serviceSelect = document.getElementById('service');
                                if (serviceSelect) {
                                    setTimeout(() => {
                                        serviceSelect.value = serviceId;
                                    }, 300);
                                }
                            });
                        });
                    });
                })();
            </script>
<?php
        }
    }

    return ob_get_clean();
}
add_shortcode('book_now_button', 'book_now_button_shortcode');
