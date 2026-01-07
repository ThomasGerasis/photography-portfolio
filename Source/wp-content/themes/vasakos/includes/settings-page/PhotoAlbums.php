<?php

namespace SettingsPages;

if (!defined('ABSPATH')) exit;

class PhotoAlbumsAdminGrid
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'addMenu']);
        add_action('admin_enqueue_scripts', [$this, 'assets']);

        add_action('admin_post_delete_photo_item', [$this, 'deletePhoto']);
        add_action('admin_post_bulk_delete_photos', [$this, 'bulkDeletePhotos']);
    }

    public function assets($hook): void
    {
        if (!str_contains($hook, 'photo-albums')) return;

        wp_enqueue_style('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', ['jquery']);

        wp_enqueue_media();

        wp_register_script(
            'settingsScripts',
            get_template_directory_uri() . '/includes/settings-page/assets/settings-scripts.js',
            ['jquery'],
            false,
            true
        );

        wp_register_style(
            'adminStyles',
            get_template_directory_uri() . '/includes/settings-page/assets/adminStyles.css',
            [],
            false,
            'all'
        );
    }

    public function addMenu(): void
    {
        add_menu_page(
            __('Photo Albums', 'textdomain'),
            __('Photo Albums', 'textdomain'),
            'manage_options',
            'photo-albums',
            [$this, 'renderPage'],
            get_template_directory_uri() . '/assets/images/camera.png',
            20
        );
    }

    public function renderPage(): void
    {
        if (!current_user_can('manage_options')) return;

        wp_enqueue_script('settingsScripts');
        wp_enqueue_style('adminStyles');

        $category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

        echo '<div class="wrap bootstrap-wrapper">';

        if ($category_id) {
            $category = get_term($category_id, 'category');
            $title = $category && !is_wp_error($category) ? $category->name : __('Photo Albums', 'textdomain');
        } else {
            $title = __('Choose Category', 'textdomain');
        }

        echo '<h1 class="mb-2">' . esc_html($title) . '</h1>';

        if ($category_id) {
            $this->renderPhotosPage($category_id);
        } else {
            $this->renderCategoriesPage();
        }

        echo '</div>';
    }

    private function renderCategoriesPage(): void
    {
        $categories = get_terms(['taxonomy' => 'category', 'hide_empty' => false]);

        if (empty($categories)) {
            echo '<p>No categories found.</p>';
            return;
        }

        echo '<div class="row">';
        foreach ($categories as $cat) {
            $link = admin_url('admin.php?page=photo-albums&category=' . $cat->term_id);
            echo '<div class="col-md-3 mb-3">';
            echo '<div class="card p-3 text-center">';
            echo '<h5>' . esc_html($cat->name) . '</h5>';
            echo '<a class="btn btn-primary btn-sm mt-2" href="' . esc_url($link) . '">View Photos</a>';
            echo '</div></div>';
        }
        echo '</div>';
    }

    private function renderPhotosPage(int $category_id): void
    {
        $category = get_term($category_id, 'category');

        if (!$category || is_wp_error($category)) {
            echo '<p>Invalid category.</p>';
            return;
        }

        if (isset($_GET['deleted'])) {
            echo '<div class="notice notice-success"><p>Photo(s) deleted successfully.</p></div>';
        }

        $this->handleFormSubmission();

        echo '<a class="btn btn-secondary mb-1" href="' . admin_url('admin.php?page=photo-albums') . '">&larr; Back to Categories</a>';

        $this->renderAddPhotoForm([$category]);

        $photos = get_posts([
            'post_type' => 'photos',
            'posts_per_page' => -1,
            'tax_query' => [
                ['taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category_id]
            ]
        ]);

        if (!$photos) {
            echo '<p class="text-muted">No photos in this category.</p>';
            return;
        }

?>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
            <?php wp_nonce_field('bulk_delete_photos', 'bulk_delete_nonce'); ?>
            <input type="hidden" name="action" value="bulk_delete_photos">

            <div class="d-flex justify-content-end mb-3">
                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Delete selected photos?');">
                    Delete Selected
                </button>
            </div>

            <div class="row">
                <?php foreach ($photos as $photo): ?>
                    <div class="col-md-2 col-sm-4 col-6 mb-4 text-center">

                        <label style="display:block">
                            <input type="checkbox" name="photo_ids[]" value="<?php echo esc_attr($photo->ID); ?>">
                        </label>

                        <?php echo get_the_post_thumbnail($photo->ID, 'thumbnail', ['class' => 'img-fluid rounded']); ?>

                        <div class="mt-2"><?php echo esc_html($photo->post_title); ?></div>


                    </div>
                <?php endforeach; ?>
            </div>
        </form>
    <?php
    }

    private function renderAddPhotoForm(array $categories): void
    {
    ?>
        <div class="card col-12 mb-2" id="add-photo-form">
            <form method="post">
                <?php wp_nonce_field('add_multiple_photos', 'add_photos_nonce'); ?>

                <div class="form-group">
                    <label>Add new photos</label><br>

                    <button type="button" class="btn btn-info mb-2" id="upload-photo-button">
                        Select Photos
                    </button>

                    <input type="hidden" id="photo_attachment_ids" name="photo_attachment_ids">

                    <div id="photo-preview" class="mt-2"></div>
                </div>

                <div class="form-group d-none">
                    <select name="photo_category" class="form-control">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo esc_attr($cat->term_id); ?>">
                                <?php echo esc_html($cat->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="add_multiple_photos" id="add-photo-button" class="btn btn-primary" disabled>
                    Add Photos
                </button>
            </form>
        </div>
<?php
    }

    private function handleFormSubmission(): void
    {
        if (!isset($_POST['add_multiple_photos'])) return;

        if (
            !isset($_POST['add_photos_nonce']) ||
            !wp_verify_nonce($_POST['add_photos_nonce'], 'add_multiple_photos')
        ) {
            echo '<div class="notice notice-error"><p>Security check failed.</p></div>';
            return;
        }

        if (empty($_POST['photo_attachment_ids'])) {
            echo '<div class="notice notice-error"><p>Please select at least one photo.</p></div>';
            return;
        }

        $ids = array_map('intval', explode(',', $_POST['photo_attachment_ids']));
        $category = intval($_POST['photo_category']);

        foreach ($ids as $attachment_id) {

            $post_id = wp_insert_post([
                'post_type' => 'photos',
                'post_status' => 'publish',
                'tax_input' => ['category' => [$category]],
                'post_title' => get_the_title($attachment_id)
            ]);

            if ($post_id) {
                set_post_thumbnail($post_id, $attachment_id);
            }
        }

        echo '<div class="notice notice-success"><p>Photos added successfully!</p></div>';
    }

    public function deletePhoto(): void
    {
        if (!current_user_can('delete_posts')) wp_die('No permission');

        if (!isset($_GET['photo_id'], $_GET['_wpnonce'])) wp_die('Invalid request');

        $photo_id = intval($_GET['photo_id']);

        if (!wp_verify_nonce($_GET['_wpnonce'], 'delete_photo_' . $photo_id)) wp_die('Security check failed');

        $categories = wp_get_post_terms($photo_id, 'category', ['fields' => 'ids']);
        $category_id = $categories[0] ?? 0;

        wp_delete_post($photo_id, true);

        $redirect = admin_url('admin.php?page=photo-albums');
        if ($category_id) $redirect = add_query_arg('category', $category_id, $redirect);
        $redirect = add_query_arg('deleted', 1, $redirect);

        wp_redirect($redirect);
        exit;
    }

    public function bulkDeletePhotos(): void
    {
        if (!current_user_can('delete_posts')) wp_die('No permission');

        if (
            !isset($_POST['bulk_delete_nonce']) ||
            !wp_verify_nonce($_POST['bulk_delete_nonce'], 'bulk_delete_photos')
        ) {
            wp_die('Security check failed');
        }

        if (empty($_POST['photo_ids'])) {
            wp_redirect(wp_get_referer());
            exit;
        }

        $ids = array_map('intval', $_POST['photo_ids']);

        foreach ($ids as $id) {
            wp_delete_post($id, true);
        }

        $redirect = add_query_arg('deleted', 1, wp_get_referer());
        wp_redirect($redirect);
        exit;
    }
}
