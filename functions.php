<?php
/**
 * Starkers functions and definitions
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
/* Required external files
  ================================================== */

require_once( 'external/starkers-utilities.php' );

/* Theme specific settings
  ================================================== */

add_theme_support('post-thumbnails');

register_nav_menus(array('primary' => 'Primary Navigation'));

/* Actions and Filters
  ================================================== */

add_action('wp_enqueue_scripts', 'starkers_script_enqueuer');

add_filter('body_class', array('Starkers_Utilities', 'add_slug_to_body_class'));

/* Enqueue Styles & Scripts
  ================================================== */

function starkers_script_enqueuer() {
    wp_register_script('site', get_template_directory_uri() . '/js/site.js', array('jquery'));
    wp_enqueue_script('site');

    wp_register_style('reset', get_stylesheet_directory_uri() . '/css/reset.css', '', '', 'screen');
    wp_enqueue_style('reset');
    wp_register_style('common', get_stylesheet_directory_uri() . '/css/common.css', '', '', 'screen');
    wp_enqueue_style('common');
    wp_register_style('fonts', get_stylesheet_directory_uri() . '/css/fonts.css', '', '', 'screen');
    wp_enqueue_style('fonts');
    wp_register_style('layout', get_stylesheet_directory_uri() . '/css/layout.css', '', '', 'screen');
    wp_enqueue_style('layout');
    wp_register_style('pre-header', get_stylesheet_directory_uri() . '/css/pre-header.css', '', '', 'screen');
    wp_enqueue_style('pre-header');
    wp_register_style('modules', get_stylesheet_directory_uri() . '/css/modules.css', '', '', 'screen');
    wp_enqueue_style('modules');
}

/* Comments
  ================================================== */

function starkers_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <?php if ($comment->comment_approved == '1'): ?>	
        <li>
            <article id="comment-<?php comment_ID() ?>">
        <?php echo get_avatar($comment); ?>
                <h4><?php comment_author_link() ?></h4>
                <time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
        <?php comment_text() ?>
            </article>
            <?php
            endif;
        }

        /* Excerpt Class
          ================================================== */

        function add_excerpt_class($excerpt) {
            $excerpt = str_replace("<p", "<p itemprop=\"alternativeHeadline\" class=\"excerpt\"", $excerpt);
            return $excerpt;
        }

        add_filter("the_excerpt", "add_excerpt_class");


        /* Excerpt Count
          ================================================== */

        function get_excerpt($excerpt_count) {
            $permalink = get_permalink($post->ID);
            $excerpt = get_the_excerpt();
            if (empty($excerpt)) {
                $excerpt = get_the_content();
            };
            $excerpt = strip_tags($excerpt);
            $excerpt = substr($excerpt, 0, $excerpt_count);
            $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
            $excerpt = $excerpt . '...';
            $excerpt_count = 0;
            return $excerpt;
        }

        /* Title Count
          ================================================== */

        function max_title($title_count) {
            $permalink = get_permalink($post->ID);
            $the_title = get_the_title();
            $the_title = strip_tags($the_title);
            $the_title = substr($the_title, 0, $title_count);
            $the_title = substr($the_title, 0, strripos($the_title, " "));
            $the_title = $the_title . '...';
            $title_count = 0;
            return $the_title;
        }

        /* Get THUMB URL
          ================================================== */

        function get_image_url() {
            global $post;
            $imagen = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            $ruta_imagen = $imagen[0];
            echo $ruta_imagen;
        }

        /* Custom Search Form
          ================================================== */

        function custom_search_form($form) {
            $form = '<form role="search" method="get" id="searchform" action="' . home_url('/') . '" >
	    <input type="text" class="field" value="' . get_search_query() . '" name="s" id="s" placeholder="Buscar"/>
	    <input type="submit" class="submit" id="searchsubmit" value="' . esc_attr__('S') . '"/>
	    </form>';

            return $form;
        }

        add_filter('get_search_form', 'custom_search_form');

        /* Custom Image Size
          ================================================== */

        add_image_size('last_post', 466, 254, true); // HOME LAST POST
        add_image_size('post', 629, 343, true); // POST DETAIL
        add_image_size('organization', 240, 240, true); // ORGANIZATION DEAIL
        add_image_size('even_list', 300, 164, true); // Hard Crop Mode

        /* Sidebar
          ================================================== */

        function yourblog_widgets_init() {
            register_sidebar(array(
                'name' => __('Primary Widget Area', 'r12themes'),
                'id' => 'primary-widget-area',
                'description' => __('The primary widget area', 'r12themes'),
                'before_widget' => '<aside class="widget">
		',
                'after_widget' => '</aside>
		',
                'before_title' => '<h3 class="widget_title">
		',
                'after_title' => '</h3>
		',
            ));
        }

        add_action('widgets_init', 'yourblog_widgets_init');

        /* Add Category Class to Body in Single Post
          ================================================== */

        add_filter('body_class', 'add_category_to_single');

        function add_category_to_single($classes, $class) {
            if (is_single()) {
                global $post;
                foreach ((get_the_category($post->ID)) as $category) {
                    // add category slug to the $classes array
                    $classes[] = $category->category_nicename;
                }
            }
            // return the $classes array
            return $classes;
        }

        /* Campos personalizados para usuarios
          ================================================== */

        function fb_add_custom_user_profile_fields($user) {
            ?>
        <h3><?php _e('Información extra', 'your_textdomain'); ?></h3>

        <table class="form-table">
            <tr>
                <th>
                    <label for="twitter"><?php _e('Twitter', 'your_textdomain'); ?>
                    </label></th>
                <td>
                    <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text" placeholder="@usuario" /><br />
                    <span class="description"><?php _e('Introduce tu usuario de twitter.', 'your_textdomain'); ?></span>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="google_plus"><?php _e('Google Plus', 'your_textdomain'); ?>
                    </label></th>
                <td>
                    <input type="text" name="google_plus" id="google_plus" value="<?php echo esc_attr(get_the_author_meta('google_plus', $user->ID)); ?>" class="regular-text" placeholder="" /><br />
                    <span class="description"><?php _e('Introduce tu url de autor de Google Plus.', 'your_textdomain'); ?></span>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="direccion_postal"><?php _e('Dirección Postal', 'your_textdomain'); ?>
                    </label></th>
                <td>
                    <input type="text" name="direccion_postal" id="direccion_postal" value="<?php echo esc_attr(get_the_author_meta('direccion_postal', $user->ID)); ?>" class="regular-text" placeholder="Calle Zurita, 17, 28012 Madrid" /><br />
                    <span class="description"><?php _e('Introduce la dirección postal.', 'your_textdomain'); ?></span>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="telefono"><?php _e('Teléfono', 'your_textdomain'); ?>
                    </label></th>
                <td>
                    <input type="text" name="telefono" id="telefono" value="<?php echo esc_attr(get_the_author_meta('telefono', $user->ID)); ?>" class="regular-text" placeholder="678 12 34 56" /><br />
                    <span class="description"><?php _e('Teléfono de contacto.', 'your_textdomain'); ?></span>
                </td>
            </tr>
        </table>
    <?php
    }

    function fb_save_custom_user_profile_fields($user_id) {

        if (!current_user_can('edit_user', $user_id))
            return FALSE;

        update_usermeta($user_id, 'twitter', $_POST['twitter']);
        update_usermeta($user_id, 'google_plus', $_POST['google_plus']);
        update_usermeta($user_id, 'direccion_postal', $_POST['direccion_postal']);
        update_usermeta($user_id, 'telefono', $_POST['telefono']);
    }

    add_action('show_user_profile', 'fb_add_custom_user_profile_fields');
    add_action('edit_user_profile', 'fb_add_custom_user_profile_fields');

    add_action('personal_options_update', 'fb_save_custom_user_profile_fields');
    add_action('edit_user_profile_update', 'fb_save_custom_user_profile_fields');

    /* Campos personalizados administrador
      ================================================== */
    add_filter('admin_init', 'extra_fields_general_settings');

    function extra_fields_general_settings() {
        register_setting('general', 'direccion', 'esc_attr');
        register_setting('general', 'telefono', 'esc_attr');
        register_setting('general', 'codigo_postal', 'esc_attr');
        register_setting('general', 'localidad', 'esc_attr');
        register_setting('general', 'provincia', 'esc_attr');
        register_setting('general', 'pais', 'esc_attr');
        add_settings_field('direccion', '<label for="direccion">' . __('Dirección postal', 'direccion') . '</label>', 'field_direccion', 'general');
        add_settings_field('telefono', '<label for="telefono">' . __('Teléfono', 'telefono') . '</label>', 'field_telefono', 'general');
        add_settings_field('codigo_postal', '<label for="codigo_postal">' . __('Código Postal', 'codigo_postal') . '</label>', 'field_codigo_postal', 'general');
        add_settings_field('localidad', '<label for="localidad">' . __('Localidad', 'localidad') . '</label>', 'field_localidad', 'general');
        add_settings_field('provincia', '<label for="provincia">' . __('Provincia', 'provincia') . '</label>', 'field_provincia', 'general');
        add_settings_field('pais', '<label for="pais">' . __('País', 'pais') . '</label>', 'field_pais', 'general');
    }

    function field_direccion() {
        $value = get_option('direccion', '');
        echo '<input type="text" id="direccion" name="direccion" value="' . $value . '" class="regular-text" placeholder="Calle Zurita, 17, 28012 Madrid"/>';
    }

    function field_telefono() {
        $value = get_option('telefono', '');
        echo '<input type="text" id="telefono" name="telefono" value="' . $value . '" class="regular-text" placeholder="000 00 00 00"/>';
    }

    function field_codigo_postal() {
        $value = get_option('telefono', '');
        echo '<input type="text" id="codigo_postal" name="codigo_postal" value="' . $value . '" class="regular-text" placeholder="03590"/>';
    }

    function field_localidad() {
        $value = get_option('localidad', '');
        echo '<input type="text" id="localidad" name="localidad" value="' . $value . '" class="regular-text" placeholder="Altea"/>';
    }

    function field_provincia() {
        $value = get_option('provincia', '');
        echo '<input type="text" id="provincia" name="provincia" value="' . $value . '" class="regular-text" placeholder="Alicante"/>';
    }

    function field_pais() {
        $value = get_option('pais', '');
        echo '<input type="text" id="pais" name="pais" value="' . $value . '" class="regular-text" placeholder="España"/>';
    }
	include 'customtypes.php';
	include 'taxonomias.php'; 
