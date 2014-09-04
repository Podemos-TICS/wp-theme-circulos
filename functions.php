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

    function create_events_cpt() {
        register_post_type('events', array(
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5, // places menu item directly below Posts
            'menu_icon' => 'dashicons-calendar',
            'labels' => array(
                'name' => __('Eventos'),
                'singular_name' => __('Evento'),
                'add_new' => __('Añadir Evento'),
                'add_new_item' => __('Añadir nuevo Evento'),
                'edit' => __('Editar'),
                'edit_item' => __('Editar Evento'),
                'new_item' => __('Nuevo Evento'),
                'view' => __('Ver Evento'),
                'view_item' => __('Ver Evento'),
                'search_items' => __('Buscar Eventos'),
                'not_found' => __('No se han encontrado Eventos'),
                'not_found_in_trash' => __('No se han encotrado eventos en la papelera'),
                'parent' => __('Parent Event'),
            ),
                )
        );
    }

    add_action('init', 'create_events_cpt');

    function create_persons_cpt() {
        register_post_type('persons', array(
            'public' => true,
            'has_archive' => true,
            'menu_position' => 6, // places menu item directly below Posts
            'menu_icon' => 'dashicons-businessman',
            'labels' => array(
                'name' => __('Personas'),
                'singular_name' => __('Persona'),
                'add_new' => __('Añadir Persona'),
                'add_new_item' => __('Añadir nuevo Persona'),
                'edit' => __('Editar'),
                'edit_item' => __('Editar Persona'),
                'new_item' => __('Nuevo Persona'),
                'view' => __('Ver Persona'),
                'view_item' => __('Ver Persona'),
                'search_items' => __('Buscar Personas'),
                'not_found' => __('No se han encontrado Personas'),
                'not_found_in_trash' => __('No se han encotrado personas en la papelera'),
                'parent' => __('Parent Person'),
            ),
                )
        );
    }

    add_action('init', 'create_persons_cpt');

    function create_comisions_cpt() {
        register_post_type('comisions', array(
            'public' => true,
            'has_archive' => true,
            'menu_position' => 7, // places menu item directly below Posts
            'menu_icon' => 'dashicons-groups',
            'labels' => array(
                'name' => __('Comisiones'),
                'singular_name' => __('Comisión'),
                'add_new' => __('Añadir Comisión'),
                'add_new_item' => __('Añadir nuevo Comisión'),
                'edit' => __('Editar'),
                'edit_item' => __('Editar Comisión'),
                'new_item' => __('Nuevo Comisión'),
                'view' => __('Ver Comisión'),
                'view_item' => __('Ver Comisión'),
                'search_items' => __('Buscar Comisiones'),
                'not_found' => __('No se han encontrado Comisiones'),
                'not_found_in_trash' => __('No se han encotrado comisiones en la papelera'),
                'parent' => __('Parent Comision'),
            ),
                )
        );
    }

    add_action('init', 'create_comisions_cpt');

    /**
     * Adds a box to the main column on the Post and Page edit screens.
     */
    function customtypes_add_meta_box() {

        $screens = array('events');

        foreach ($screens as $screen) {

            add_meta_box(
                    'customtypes_sectionid', __('Datos temporales del evento', 'customtypes_textdomain'), 'customtypes_meta_box_callback', $screen
            );
        }
        
        $screens = array('events' , 'persons' , 'comisions');

        foreach ($screens as $screen) {

            add_meta_box(
                    'customtypes_sectionid1', __('Datos genéricos', 'customtypes_textdomain1'), 'customtypes_meta_box_callback1', $screen
            );
        }
        $screens = array( 'persons', 'comisions');

        foreach ($screens as $screen) {

            add_meta_box(
                    'customtypes_sectionid2', __('Datos de la comisión', 'customtypes_textdomain2'), 'customtypes_meta_box_callback2', $screen
            );
        }
        $screens = array('persons');

        foreach ($screens as $screen) {

            add_meta_box(
                    'customtypes_sectionid3', __('Datos personales', 'customtypes_textdomain3'), 'customtypes_meta_box_callback3', $screen
            );
        }
    }

    add_action('add_meta_boxes', 'customtypes_add_meta_box');

    /**
     * Prints the box content.
     * 
     * @param WP_Post $post The object for the current post/page.
     */
    function customtypes_meta_box_callback($post) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('customtypes_meta_box', 'customtypes_meta_box_nonce');

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        // Los siguiente customtypes son exclusivos para eventos
          //las fechas se pueden validar en jquery con dateITA dd/mm/yyyy, como si fuese un dateESP
        $value = get_post_meta($post->ID, 'finicio', true);
        echo '<label for="customtypes_fechainicio">';
        _e('Fecha de Inicio del Evento:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="date" id="customtypes_fechainicio" name="customtypes_fechainicio" value="' . esc_attr($value) . '"  />';
        // En jquery tenemos un validate que permite validar horas en formato hh:mm, nos permite ahorrar input fields de minutos inicio y final.
        $value = get_post_meta($post->ID, 'hinicio', true);
        echo '<label for="customtypes_horainicio">';
        _e('Hora de Inicio del Evento:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="time" id="customtypes_horainicio" name="customtypes_horainicio" value="' . esc_attr($value) . '"  />';
        echo '<br>';
                      
        $value = get_post_meta($post->ID, 'ffinal', true);
        echo '<label for="customtypes_fechafinal">';
        _e('Fecha del Final del Evento:  ', 'customtypes_textdomain1');
        echo '</label> ';
        echo '<input class="required" type="date" id="customtypes_fechafinal" name="customtypes_fechafinal" value="' . esc_attr($value) . '"  />';
        
        $value = get_post_meta($post->ID, 'hfinal', true);
        echo '<label for="customtypes_horafinal">';
        _e('Hora del Final del Evento:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="time" id="customtypes_horafinal" name="customtypes_horafinal" value="' . esc_attr($value) . '"  />';
        echo '<br>';        
    }
    function customtypes_meta_box_callback1($post) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('customtypes_meta_box1', 'customtypes_meta_box_nonce1');

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        
        /*
         * Datos Comunes par Eventos, Comisiones y Personas
         */
        $value = get_post_meta($post->ID, 'email', true); //Nombre atributo
        echo '<label for="customtypes_email">';
        _e('E-mail:  ', 'customtypes_textdomain'); //Primer campo es lo que aparece en la pantalla
        echo '</label> ';
        echo '<input class="required" type="email" id="customtypes_email" name="customtypes_email" value="' . esc_attr($value) . '"  />';
        //en type="tipo de atributo" http://www.w3schools.com/html/html5_form_input_types.asp mirar aquí los tipos, required es para saber si es necesario
        echo '<br>';
        //Hasta aquí es el primer atributo email
        //Hay que bajar hasta la función customtypes_save_meta_box_data1 que es donde guardamos los atributos en bd para añadir más código
        
        //No he encontrado en la ayuda Jquery nada para validar telefonos españoles :(, habrá que hacerlo a mano?
        $value = get_post_meta($post->ID, 'tlf', true);
        echo '<label for="customtypes_telefono">';
        _e('Teléfono:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="tel" id="customtypes_telefono" name="customtypes_telefono" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'FB', true);
        echo '<label for="customtypes_FB">';
        _e('Facebook:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="url" id="customtypes_FB" name="customtypes_FB" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'web', true);
        echo '<label for="customtypes_web">';
        _e('Página Web:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="url" id="customtypes_web" name="customtypes_web" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'direccion', true);
        echo '<label for="customtypes_direccion">';
        _e('Dirección:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="text" id="customtypes_direccion" name="customtypes_direccion" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'localidad', true);
        echo '<label for="customtypes_localidad">';
        _e('Localidad:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="text" id="customtypes_localidad" name="customtypes_localidad" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'CP', true);
        echo '<label for="customtypes_CP">';
        _e('Código Postal:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="number" id="customtypes_CP" name="customtypes_CP" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'provincia', true);
        echo '<label for="customtypes_provincia">';
        _e('Provincia:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="text" id="customtypes_provincia" name="customtypes_provincia" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'pais', true);
        echo '<label for="customtypes_pais">';
        _e('País:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="text" id="customtypes_pais" name="customtypes_pais" value="España"' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'mapa', true);
        echo '<label for="customtypes_mapa">';
        _e('URL Google Maps:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="url" id="customtypes_mapa" name="customtypes_mapa" value="' . esc_attr($value) . '"  />';
        echo '<br>';
    }
    
    function customtypes_meta_box_callback2($post) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('customtypes_meta_box2', 'customtypes_meta_box_nonce2');

        
        
     // Los dos próximos customtypes son comunes para Comisiones y Personas
         $value = get_post_meta($post->ID, 'twitter', true);
        echo '<label for="customtypes_twitter">';
        _e('Cuenta de Twitter:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="url" id="customtypes_twitter" name="customtypes_twitter" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'googleplus', true);
        echo '<label for="customtypes_googleplus">';
        _e('Cuenta Google+:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="url" id="customtypes_googleplus" name="customtypes_googleplus" value="' . esc_attr($value) . '"  />';
        echo '<br>';
     // Hasta aquí customtypes comunes de Comisiones y Personas
     
      
    }
    
    function customtypes_meta_box_callback3($post) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field('customtypes_meta_box3', 'customtypes_meta_box_nonce3');
        
     // Los dos próximos customtypes son exclusivos de Personas
        $value = get_post_meta($post->ID, 'nombre', true);
        echo '<label for="customtypes_nombre">';
        _e('Nombre:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="text" id="customtypes_nombre" name="customtypes_nombre" value="' . esc_attr($value) . '"  />';
        echo '<br>';
        
        $value = get_post_meta($post->ID, 'apellidos', true);
        echo '<label for="customtypes_apellidos">';
        _e('Apellidos:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input type="text" id="customtypes_apellidos" name="customtypes_apellidos" value="' . esc_attr($value) . '"  />';
        echo '<br>';
      
    }

    /**
     * When the post is saved, saves our custom data.
     *
     * @param int $post_id The ID of the post being saved.
     */
    function customtypes_save_meta_box_data($post_id) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['customtypes_meta_box_nonce'])) {
            return;
        }

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['customtypes_meta_box_nonce'], 'customtypes_meta_box')) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check the user's permissions.
        if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {

            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }

        /* OK, it's safe for us to save the data now. */

        // Make sure that it is set.
        if (!isset($_POST['customtypes_fechainicio'])) {
            return;
        }

        // Sanitize user input.
        $my_data = sanitize_text_field($_POST['customtypes_fechainicio']);
        update_post_meta($post_id, 'finicio', $my_data);
		
        if (!isset($_POST['customtypes_fechafinal'])) {
            return;
        }		
        $my_data = sanitize_text_field($_POST['customtypes_fechafinal']);
        update_post_meta($post_id, 'ffinal', $my_data);
        
        if (!isset($_POST['customtypes_horainicio'])) {
            return;
        }		
        $my_data = sanitize_text_field($_POST['customtypes_horainicio']);
        update_post_meta($post_id, 'hinicio', $my_data);
        
        if (!isset($_POST['customtypes_horafinal'])) {
            return;
        }		
        $my_data = sanitize_text_field($_POST['customtypes_horafinal']);
        update_post_meta($post_id, 'hfinal', $my_data);
    }

    add_action('save_post', 'customtypes_save_meta_box_data');
    
    function customtypes_save_meta_box_data1($post_id) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['customtypes_meta_box_nonce1'])) {
            return;
        }

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['customtypes_meta_box_nonce1'], 'customtypes_meta_box1')) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check the user's permissions.
        if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {

            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }

        /* OK, it's safe for us to save the data now. */

        //Cogemos el dato lo preparamos para meter en base de datos y lo guardamos
        $my_data = sanitize_text_field($_POST['customtypes_email']);
        update_post_meta($post_id, 'email', $my_data);
		
        //Otro dato
        $my_data = sanitize_text_field($_POST['customtypes_telefono']);
        update_post_meta($post_id, 'tlf', $my_data);
        
        
    }

    add_action('save_post', 'customtypes_save_meta_box_data1');
    
    function customtypes_save_meta_box_data2($post_id) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['customtypes_meta_box_nonce2'])) {
            return;
        }

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['customtypes_meta_box_nonce2'], 'customtypes_meta_box2')) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check the user's permissions.
        if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {

            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }

        /* OK, it's safe for us to save the data now. */

        //Cogemos el dato lo preparamos para meter en base de datos y lo guardamos
        $my_data = sanitize_text_field($_POST['customtypes_twitter']);
        update_post_meta($post_id, 'twitter', $my_data);
		
        //Otro dato
        $my_data = sanitize_text_field($_POST['customtypes_googleplus']);
        update_post_meta($post_id, 'googleplus', $my_data);
        
        
    }

    add_action('save_post', 'customtypes_save_meta_box_data2');
    function customtypes_save_meta_box_data3($post_id) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['customtypes_meta_box_nonce1'])) {
            return;
        }

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['customtypes_meta_box_nonce1'], 'customtypes_meta_box1')) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check the user's permissions.
        if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {

            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }

        /* OK, it's safe for us to save the data now. */

        //Cogemos el dato lo preparamos para meter en base de datos y lo guardamos
        $my_data = sanitize_text_field($_POST['customtypes_nombre']);
        update_post_meta($post_id, 'nombre', $my_data);
		
        //Otro dato
        $my_data = sanitize_text_field($_POST['customtypes_apellidos']);
        update_post_meta($post_id, 'apellidos', $my_data);
        
        
    }

    add_action('save_post', 'customtypes_save_meta_box_data3');

    add_action('admin_enqueue_scripts', 'add_my_js');

    function add_my_js() {
        wp_enqueue_script('my_validate', get_bloginfo('template_url') . '/js/jquery.validate.min.js', array('jquery'));
        wp_enqueue_script('my_script_js', get_bloginfo('template_url') . '/js/my_script.js');
    }
    