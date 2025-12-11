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
    }

    /**
     * Enqueue admin scripts and styles
     */
    public function assets($hook): void
    {
        // Only load on Photo Albums admin pages
        if (!str_contains($hook, 'photo-albums')) return;

        // Bootstrap 4
        wp_enqueue_style('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', ['jquery']);

        // WordPress Media uploader
        wp_enqueue_media();

        wp_register_script('settingsScripts', get_template_directory_uri() . '/includes/settings-page/assets/settings-scripts.js', [], false, false);
        wp_register_style('adminStyles', get_template_directory_uri() . '/includes/settings-page/assets/adminStyles.css', [], false, 'all');
    }

    /**
     * Register admin menu
     */
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

    /**
     * Main page dispatcher: either category selection or photo grid
     */
    public function renderPage(): void
    {
        if (!current_user_can('manage_options')) return;

        wp_enqueue_script('settingsScripts');
        wp_enqueue_style('adminStyles');

        // Determine if a category is selected
        $category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

        echo '<div class="wrap bootstrap-wrapper">';

        // Dynamic page title
        if ($category_id) {
            $category = get_term($category_id, 'category');
            $title = $category && !is_wp_error($category) ? $category->name : __('Photo Albums', 'textdomain');
        } else {
            $title = __('Choose Category', 'textdomain');
        }

        echo '<h1 class="mb-2">' . esc_html($title) . '</h1>';
        // Check if category parameter exists
        $category_id = isset($_GET['category']) ? intval($_GET['category']) : 0;

        if ($category_id) {
            $this->renderPhotosPage($category_id);
        } else {
            $this->renderCategoriesPage();
        }

        echo '</div>';
    }

    /**
     * Render Category Selection Page
     */
    private function renderCategoriesPage(): void
    {
        $categories = get_terms(['taxonomy' => 'category', 'hide_empty' => false]);

        if (empty($categories)) {
            echo '<p>' . __('No categories found.', 'textdomain') . '</p>';
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

    /**
     * Render Photos Page for a specific category
     */
    private function renderPhotosPage(int $category_id): void
    {
        $category = get_term($category_id, 'category');

        if (!$category || is_wp_error($category)) {
            echo '<p>' . __('Invalid category.', 'textdomain') . '</p>';
            return;
        }

        if (isset($_GET['deleted'])) {
            echo '<div class="notice notice-success"><p>Photo deleted successfully.</p></div>';
        }

        // Handle photo submission
        $this->handleFormSubmission();

        // Back to categories link
        echo '<a class="btn btn-secondary mb-1" href="' . admin_url('admin.php?page=photo-albums') . '">&larr; ' . __('Back to Categories', 'textdomain') . '</a>';

        // Add photo form 
        $this->renderAddPhotoForm([$category]); // single category

        // Photo grid
        $photos = get_posts([
            'post_type' => 'photos',
            'posts_per_page' => -1,
            'tax_query' => [
                ['taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category_id]
            ]
        ]);

        if (!$photos) {
            echo '<p class="text-muted">' . __('No photos in this category.', 'textdomain') . '</p>';
            return;
        }

        echo '<div class="row">';
        foreach ($photos as $photo) {
            $thumb = get_the_post_thumbnail($photo->ID, 'thumbnail', ['class' => 'img-fluid rounded']);
            $edit_link = get_edit_post_link($photo->ID);
            echo '<div class="col-md-2 col-sm-4 col-6 mb-4 text-center">';
            echo '<a href="' . esc_url($edit_link) . '">' . $thumb . '</a>';
            echo '<div class="mt-2">' . esc_html($photo->post_title) . '</div>';
            echo '<a href="' . esc_url(
                wp_nonce_url(
                    admin_url("admin-post.php?action=delete_photo_item&photo_id={$photo->ID}"),
                    "delete_photo_{$photo->ID}"
                )
            ) . '" class="btn btn-sm btn-danger mt-2" onclick="return confirm(\'Are you sure you want to delete this photo?\');">Delete</a>';
            echo '</div>';
        }
        echo '</div>';
    }

    /**
     * Render "Add New Photo" form
     */
    private function renderAddPhotoForm(array $categories): void
    {
?>
        <div class="card col-12 mb-2" id="add-photo-form">
            <form method="post">

                <div class="form-group">
                    <label><?php echo __('Add a new Photo', 'textdomain'); ?></label><br>
                    <button type="button" class="btn btn-info mb-2" id="upload-photo-button">
                        <?php echo __('Select Photo', 'textdomain'); ?>
                    </button>
                    <input type="hidden" id="photo_attachment_id" name="photo_attachment_id">
                    <div id="photo-preview" class="mt-2"></div>
                </div>

                <div class="form-group d-none">
                    <label><?php echo __('Category', 'textdomain'); ?></label>
                    <select name="photo_category" class="form-control">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo esc_attr($cat->term_id); ?>">
                                <?php echo esc_html($cat->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="add_photo" id="add-photo-button" class="btn btn-primary" disabled>
                    <?php echo __('Add Photo', 'textdomain'); ?>
                </button>
            </form>
        </div>
<?php
    }

    /**
     * Handle photo addition
     */
    private function handleFormSubmission(): void
    {
        if (!isset($_POST['add_photo'])) return;
        if (empty($_POST['photo_attachment_id'])) {
            echo '<div class="notice notice-error"><p>Please select a photo.</p></div>';
            return;
        }

        $attachment_id = intval($_POST['photo_attachment_id']);
        $new_post = [
            'post_type' => 'photos',
            'post_status' => 'publish',
            'tax_input' => ['category' => [intval($_POST['photo_category'])]]
        ];

        $post_id = wp_insert_post($new_post);

        if ($post_id) {
            set_post_thumbnail($post_id, $attachment_id);
            echo '<div class="notice notice-success"><p>Photo added successfully!</p></div>';
        }
    }
    /**
     * Delete a photo
     */
    public function deletePhoto(): void
    {
        if (!current_user_can('delete_posts')) {
            wp_die(__('You do not have permission.', 'textdomain'));
        }

        if (!isset($_GET['photo_id'], $_GET['_wpnonce'])) {
            wp_die(__('Invalid request.', 'textdomain'));
        }

        $photo_id = intval($_GET['photo_id']);

        if (!wp_verify_nonce($_GET['_wpnonce'], 'delete_photo_' . $photo_id)) {
            wp_die(__('Security check failed.', 'textdomain'));
        }

        // Get the category ID of the photo before deletion
        $categories = wp_get_post_terms($photo_id, 'category', ['fields' => 'ids']);
        $category_id = $categories[0] ?? 0;

        // Delete the photo
        wp_delete_post($photo_id, true);

        // Redirect back to the category page
        $redirect_url = admin_url('admin.php?page=photo-albums');
        if ($category_id) {
            $redirect_url = add_query_arg('category', $category_id, $redirect_url);
        }
        $redirect_url = add_query_arg('deleted', 1, $redirect_url);

        wp_redirect($redirect_url);
        exit;
    }
}
