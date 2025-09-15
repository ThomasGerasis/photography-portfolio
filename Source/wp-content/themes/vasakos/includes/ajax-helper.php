<?php
add_action('wp_ajax_nopriv_send_email', 'send_email');
add_action('wp_ajax_send_email', 'send_email');

function send_email()
{
    // Retrieve and sanitize POST data
    $name = sanitize_text_field($_POST['name'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $userEmail = sanitize_email($_POST['userEmail'] ?? '');
    $service = sanitize_text_field($_POST['service'] ?? '');

    // Validate essential fields
    if (empty($name) || empty($userEmail) || !is_email($userEmail)) {
        echo 'Invalid input. Please provide a valid name and email.';
        wp_die();
    }

    $settings = get_option('basic_settings');

    $headers = [
        'Content-type: text/html; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $userEmail . '>'
    ];

    ob_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Website Contact Form</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f6f8f8;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 640px;
                margin: 0 auto;
                background: #fff;
                padding: 20px;
            }

            .header {
                background-color: #0974BA;
                color: #fff;
                text-align: center;
                padding: 15px 0;
            }

            .section {
                margin-bottom: 20px;
            }

            .label {
                font-weight: bold;
                color: #0974BA;
            }

            .message {
                background-color: #f1f1f1;
                padding: 10px;
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h2>Website Contact Form</h2>
            </div>

            <div class="section">
                <p class="label">Message:</p>
                <p class="message"><?= nl2br(esc_html($message)) ?></p>
            </div>

            <?php if (!empty($service)) : ?>
                <div class="section">
                    <p class="label">Service Selected:</p>
                    <p class="message"><?= esc_html($service) ?></p>
                </div>
            <?php endif; ?>

            <div class="section">
                <p class="label">Contact Details:</p>
                <p class="message"><?= esc_html($name) ?> - <?= esc_html($userEmail) ?></p>
            </div>
        </div>
    </body>

    </html>
    <?php

    $body = ob_get_clean();

    // Send the email
    $mailSent = wp_mail(
        $settings['email'] ?? 'vasakos3vh@gmail.com',
        "Website Contact Message from " . $name,
        $body,
        $headers
    );

    echo $mailSent ? "Thank you for leaving us a message!" : "Mail failed. Please try again.";
    wp_die();
}

function load_more_gallery()
{

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $categoryId = isset($_POST['category']) ? intval($_POST['category']) : 0;

    $args = array(
        'post_type'      => 'photos',
        'posts_per_page' => get_option('posts_per_page'), // You can tweak this
        'paged'          => $paged,
        'orderby'        => 'publish_date',
        'order'          => 'DESC',
    );

    if ($categoryId) {
        $args['cat'] = $categoryId;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            if (!has_post_thumbnail()) continue;
    ?>
            <div class="magnific-img single_gallery_item media-slice nature mb-30">
                <a class="image-popup-vertical-fit" href="<?php echo get_the_post_thumbnail_url(); ?>">
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                </a>
            </div>
<?php
        endwhile;
    endif;

    wp_reset_postdata();

    wp_die();
}

add_action('wp_ajax_load_more_gallery', 'load_more_gallery');
add_action('wp_ajax_nopriv_load_more_gallery', 'load_more_gallery');
