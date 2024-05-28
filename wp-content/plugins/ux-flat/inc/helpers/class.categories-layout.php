<?php
if (!class_exists('UXF_TAX_LAYOUT')) {

    class UXF_TAX_LAYOUT {

        public function __construct() {
            add_action('category_add_form_fields', [$this, 'add_layout_field']);
            add_action('category_edit_form_fields', [$this, 'update_layout_field']);
            add_action('created_category', [$this, 'save_layout']);
            add_action('edited_category', [$this, 'save_layout']);
            add_filter('category_template', [$this, 'category_layout']);
        }

        public function add_layout_field($taxonomy) {
            ?>
            <div class="form-field term-group">
                <label for="layout"><?php _e('Layout'); ?></label>
                <select name="layout" id="layout">
                    <option value=""><?php _e('Normal'); ?></option>
                    <option value="list"><?php _e('List'); ?></option>
                    <option value="inline"><?php _e('Inline'); ?></option>
                    <option value="2-col"><?php _e('2 Col'); ?></option>
                    <option value="3-col"><?php _e('3 Col'); ?></option>
                </select>
            </div>
            <?php
        }

        public function save_layout($term_id) {
            if (isset($_POST['layout'])) {
                $layout = sanitize_text_field($_POST['layout']);
                update_term_meta($term_id, 'layout', $layout);
            }
        }

        public function update_layout_field($term) {
            $layout = get_term_meta($term->term_id, 'layout', true);
            ?>
            <tr class="form-field term-group-wrap">
                <th scope="row">
                    <label for="layout"><?php _e('Layout'); ?></label>
                </th>
                <td>
                    <select name="layout" id="layout">
                        <option value=""><?php _e('Normal'); ?></option>
                        <option value="list" <?php selected($layout, 'list'); ?>><?php _e('List'); ?></option>
                        <option value="inline" <?php selected($layout, 'inline'); ?>><?php _e('Inline'); ?></option>
                        <option value="2-col" <?php selected($layout, '2-col'); ?>><?php _e('2 Col'); ?></option>
                        <option value="3-col" <?php selected($layout, '3-col'); ?>><?php _e('3 Col'); ?></option>
                    </select>
                </td>
            </tr>
            <?php
        }

        public function category_layout($template) {
            if (is_category()) {
                $category = get_queried_object();
                $layout = get_term_meta($category->term_id, 'layout', true);
                if ($layout) {
                    $template = UXF_PATH . 'template-parts/posts/archive-layout.php';
                }
            }
            return $template;
        }
        
    }
    $UXF_TAX_LAYOUT = new UXF_TAX_LAYOUT();
}
?>
