<?php

/**
 * Adds multiple category selection support to the theme customizer via checkboxes
 *
 * The category IDs are saved in the database as a comma separated string.
 */
class rlmdev90_Category_Checkboxes_Control extends WP_Customize_Control
{
    public $type = 'category-checkboxes';

    public function render_content()
    {

        //if you need jquery
        //echo '<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>';

        // Loads theme-customizer.js javascript file.
        echo '<script src="' . get_template_directory_uri() . '/js/theme-customizer.js"></script>';

        // Displays checkbox heading
        echo '<span class="customize-control-title">' . esc_html($this->label) . '</span>';


        $category_list = get_terms([
            'taxonomy' => 'category',
            'orderby' => 'id',
            'order' => 'ASC',
            'posts_per_page' => -1,
            'hide_empty' => false,
            'include_children' => 0
        ]);

        //Style
        echo '<style>.customize-control-title{font-size:18px;line-height:1.2;font-weight:bold;margin:30px 0 15px 0;border-bottom:1px solid;}</style>';

        echo '<div style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;">';
        $i = 0;
        $margin_top = '';
        foreach ($category_list as $category) {

            if ($category->parent  == 0) {
                if ($i > 1) {
                    $margin_top = 'style="margin-top:15px"';
                }
                echo '<div class="col-6" style="-ms-flex: 0 0 50%;flex: 0 0 50%;max-width: 50%;">';
                $id = $category->term_id;
                echo '<div class="' . $category->term_id . '" ' . $margin_top . '>';
                echo '<div style="font-weight:bold;text-transform:uppercase;line-height:1;font-size:14px;margin-bottom:5px;"><label><input type="checkbox" name="category-' . $category->term_id . '" id="category-' . $category->term_id . '" class="rlmdev90-category-checkbox"> ' . $category->name . '</label></div>';
                foreach ($category_list as $category) {
                    if ($category->parent == $id) {
                        echo '<div><label><input type="checkbox" name="category-' . $category->term_id . '" id="category-' . $category->term_id . '" class="rlmdev90-category-checkbox"> ' . $category->name . '</label></div>';
                    }
                }
                echo '</div>';
                echo '</div>';
                $i++;
            }
        }
        echo '</div>';

        /* Displays category checkboxes.
        foreach ($category_list as $category) {
            echo '<label><input type="checkbox" name="category-' . $category->term_id . '" id="category-' . $category->term_id . '" class="rlmdev90-category-checkbox"> ' . $category->name . '</label><br>';
        }*/

        // Loads the hidden input field that stores the saved category list.
?>
        <input type="hidden" id="<?php echo $this->id; ?>" class="rlmdev90-hidden-categories" <?php $this->link(); ?> value="<?php echo sanitize_text_field($this->value()); ?>">
<?php
    }
}
