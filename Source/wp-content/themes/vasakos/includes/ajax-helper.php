<?php
add_action('wp_ajax_nopriv_send_email', 'send_email');
add_action('wp_ajax_send_email', 'send_email');
function send_email()
{
    $settings = get_option('basic_settings');

    $name = $_POST['name'];
    $message = $_POST['message'];
    $userEmail = $_POST['userEmail'];
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[]   = 'Reply-To: ' . $name . ' <' . $userEmail . '>';
    ob_start();
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

    <head>
        <title><?php echo "Website Contact Form email"; ?></title>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
        <meta name="viewport" content="initial-scale=1.0">
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 0;
            }

            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: inherit !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
            }

            p {
                line-height: inherit
            }

            .desktop_hide,
            .desktop_hide table {
                mso-hide: all;
                display: none;
                max-height: 0;
                overflow: hidden;
            }

            @media (max-width:660px) {
                .desktop_hide table.icons-inner {
                    display: inline-block !important;
                }

                .icons-inner {
                    text-align: center;
                }

                .icons-inner td {
                    margin: 0 auto;
                }

                .fullMobileWidth,
                .row-content {
                    width: 100% !important;
                }

                .mobile_hide {
                    display: none;
                }

                .stack .column {
                    width: 100%;
                    display: block;
                }

                .mobile_hide {
                    min-height: 0;
                    max-height: 0;
                    max-width: 0;
                    overflow: hidden;
                    font-size: 0;
                }

                .desktop_hide,
                .desktop_hide table {
                    display: table !important;
                    max-height: none !important;
                }
            }
        </style>
    </head>

    <body style="background-color: #f6f8f8; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
        <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; background-color: #f6f8f8;" width="100%">
            <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; background-color: #0974BA;" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; color: #000000; width: 640px;" width="640">
                                            <tbody>
                                                <tr>
                                                    <td class="column column-1" style="mso-table-lspace: 0; mso-table-rspace: 0; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0; padding-bottom: 0; border-top: 0; border-right: 0; border-bottom: 0; border-left: 0;" width="100%">
                                                        <table border="0" cellpadding="0" cellspacing="0" class="divider_block block-1" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
                                                            <tr>
                                                                <td class="pad" style="padding-left:20px;padding-right:20px;">
                                                                    <div align="center" class="alignment">
                                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
                                                                            <tr>
                                                                                <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #404D53;"><span> </span></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; background-color: #0974BA;" width="100%">
                            <tbody>
                                <tr>
                                    <td class="column column" style="mso-table-lspace: 0; mso-table-rspace: 0; font-weight: 400; text-align: left; vertical-align: top; border-top: 0; border-right: 0; border-bottom: 0; border-left: 0;" width="50%">
                                        <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
                                            <tr>
                                                <td class="pad" style="padding-bottom:20px;padding-right:20px;padding-top:18px;">
                                                    <div style="font-family: sans-serif">
                                                        <div class="" style="font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
                                                            <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;"><strong><span style="font-size:13px;color:#ffffff;">Website Contact Form</span></strong></p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
            <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; color: #000000; width: 640px;" width="640">
                            <tbody>
                                <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0; mso-table-rspace: 0; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0; padding-bottom: 0; border-top: 0; border-right: 0; border-bottom: 0; border-left: 0;" width="100%">
                                        <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
                                            <tr>
                                                <td class="pad" style="padding-bottom:45px;padding-left:20px;padding-right:20px;padding-top:60px;">
                                                    <div style="font-family: sans-serif">
                                                        <div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #555555; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
                                                            <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">
                                                                <span style="font-size:20px;color:#0974BA;">
                                                                    <strong><span style=""> <?= $message; ?><br></span></strong>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0;" width="100%">
            <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; color: #000000; width: 640px;" width="640">
                            <tbody>
                                <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0; mso-table-rspace: 0; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0; padding-bottom: 0; border-top: 0; border-right: 0; border-bottom: 0; border-left: 0;" width="100%">
                                        <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0; mso-table-rspace: 0; word-break: break-word;" width="100%">
                                            <tr>
                                                <td class="pad" style="padding-bottom:45px;padding-left:20px;padding-right:20px;padding-top:60px;">
                                                    <div style="font-family: sans-serif">
                                                        <div class="" style="font-size: 14px; mso-line-height-alt: 16.8px; color: #555555; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
                                                            <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">
                                                                Contact Details : <?= $name ?> - <?= $userEmail ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>

    </html>
    <?php
    $body = ob_get_clean();
    $mailSent = wp_mail([$settings['email'] ?? 'vasakos3vh@gmail.com'], "Website Contact message by " . $userEmail, $body, $headers);
    echo $mailSent ? "Thank you for leaving us a message!" : "Mail failed";
    die();
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
