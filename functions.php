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

      register_nav_menus(
        array(
          'primary' => 'Primary Navigation',
          'select-menu' => 'Select Menu',
        )
      );


      /* Selected menu
        ================================================== */

      function wp_nav_menu_select( $args = array() ) {

          $defaults = array(
              'theme_location' => '',
              'menu_class' => 'select-menu',
          );

          $args = wp_parse_args( $args, $defaults );

          if ( ( $menu_locations = get_nav_menu_locations() ) && isset( $menu_locations[ $args['theme_location'] ] ) ) {
              $menu = wp_get_nav_menu_object( $menu_locations[ $args['theme_location'] ] );

              $menu_items = wp_get_nav_menu_items( $menu->term_id );
              ?>
                  <select id="menu-<?php echo $args['theme_location'] ?>" class="<?php echo $args['menu_class'] ?>">
                      <option value=""><?php _e( 'Navigation' ); ?></option>
                      <?php foreach( (array) $menu_items as $key => $menu_item ) : ?>
                          <option value="<?php echo $menu_item->url ?>"><?php echo $menu_item->title ?></option>
                      <?php endforeach; ?>
                  </select>
              <?php
          }

          else {
              ?>
                  <select class="menu-not-found">
                      <option value=""><?php _e( 'Menu Not Found' ); ?></option>
                  </option>
              <?php
          }

      }



      /* Sidebar
      ================================================== */

      function theme_widgets_init() {
        register_sidebar(array(
        'name' => __('Primary Widget Area', 'r12themes'),
        'id' => 'primary-widget-area',
        'description' => __('Primary widget area', 'r12themes'),
        'before_widget' => '<aside class="widget">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
        ));
      }

      add_action('widgets_init', 'theme_widgets_init');

	/* Actions and Filters
	  ================================================== */

  add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );
	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );


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
          wp_register_style('responsive', get_stylesheet_directory_uri() . '/css/responsive.css', '', '', 'screen');
          wp_enqueue_style('responsive');
	}


      /* CSS Admin Hack
        ================================================== */


      add_action('admin_head', 'custom_css_admin');

      function custom_css_admin() {
        echo '<style>
          #customtypes_sectionid input {
            display: block;
            padding: 10px;
            width: 100%;
            margin: 10px 0 0 0;
          }
        </style>';
      }


	/* Comments
	  ================================================== */

	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}

	/* Custom Search Form
	================================================== */

	function custom_search_form($form) {
		$form = '<aside id="searchform_container"><form role="search" method="get" id="searchform" action="' . home_url('/') . '" >
		<input type="text" class="field" value="' . get_search_query() . '" name="s" id="s" placeholder="Buscar"/>
		<input type="submit" class="submit" id="searchsubmit" value="' . esc_attr__('S') . '"/>
		</form></aside>';

		return $form;
	}

	add_filter('get_search_form', 'custom_search_form');

	/* Show Parent Category
	================================================== */
	function show_parent_category() {
		$parentscategory ="";
		foreach((get_the_category()) as $category) {
			if ($category->category_parent == 0) {
				$parentscategory .= '<a class="category" rel="category" href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
			}
		}
		echo substr($parentscategory,0,-2);
	}

	/* Custom Image Size
	================================================== */

	add_image_size('last_post', 466, 254, true); // HOME LAST POST
      add_image_size('contact_face', 240, 240, true); // HOME LAST POST


	/* Title Count
	================================================== */
	function count_char($count, $the_title) {
		$legth = strlen($the_title);
		if ($legth > $count){
		$the_title = strip_tags($the_title);
		$the_title = substr($the_title, 0, $count);
		//$the_title = substr($the_title, 0, strripos($the_title, " "));
		$the_title = $the_title . '...';
		}
		return $the_title;
	}

      /* Content without inline styles
      ================================================== */

      //This filter works at the time of saving/updating the post.

      add_filter( 'wp_insert_post_data' , 'filter_post_data' , '99', 2 );

      function filter_post_data( $data , $postarr ) {

          $content = $data['post_content'];

          $content = preg_replace('#<p.*?>(.*?)</p>#i', '<p>\1</p>', $content);
          $content = preg_replace('#<span.*?>(.*?)</span>#i', '<span>\1</span>', $content);
          $content = preg_replace('#<ol.*?>(.*?)</ol>#i', '<ol>\1</ol>', $content);
          $content = preg_replace('#<ul.*?>(.*?)</ul>#i', '<ul>\1</ul>', $content);
          $content = preg_replace('#<li.*?>(.*?)</li>#i', '<li>\1</li>', $content);

          $data['post_content'] = $content;

          return $data;
      }

      //This filter works at the time when function the_content() is executed.

      add_filter( 'the_content', 'the_content_filter', 20 );

      function the_content_filter( $content ) {
          $content = preg_replace('#<p.*?>(.*?)</p>#i', '<p>\1</p>', $content);
          $content = preg_replace('#<span.*?>(.*?)</span>#i', '<span>\1</span>', $content);
          $content = preg_replace('#<ol.*?>(.*?)</ol>#i', '<ol>\1</ol>', $content);
          $content = preg_replace('#<ul.*?>(.*?)</ul>#i', '<ul>\1</ul>', $content);
          $content = preg_replace('#<li.*?>(.*?)</li>#i', '<li>\1</li>', $content);
          return $content;
      }

      /* Campos personalizados para usuarios
        ================================================== */


      function campos_usuarios($user) {
      ?>
      <h3><?php _e('Información extra', 'your_textdomain'); ?></h3>

      <table class="form-table">
          <tr>
              <th><label for="twitter"><?php _e('Twitter', 'your_textdomain'); ?></label></th>
              <td>
                  <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text" placeholder="https://twitter.com/usuario" /><br />
                  <span class="description"><?php _e('Introduce tu URL de twitter.', 'your_textdomain'); ?></span>
              </td>
              <th><label for="google_plus"><?php _e('Google Plus', 'your_textdomain'); ?></label></th>
              <td>
                  <input type="text" name="google_plus" id="google_plus" value="<?php echo esc_attr(get_the_author_meta('google_plus', $user->ID)); ?>" class="regular-text" placeholder="https://plus.google.com/115229808208707341778" /><br />
                  <span class="description"><?php _e('Introduce la url de autor de Google Plus.', 'your_textdomain'); ?></span>
              </td>
          </tr>
      </table>
    <?php
    }

    function guardar_campos_usuarios($user_id) {
      if (!current_user_can('edit_user', $user_id))
        return FALSE;
      update_usermeta($user_id, 'twitter', $_POST['twitter']);
      update_usermeta($user_id, 'google_plus', $_POST['google_plus']);
    }

      add_action('show_user_profile', 'campos_usuarios');
      add_action('edit_user_profile', 'campos_usuarios');

      add_action('personal_options_update', 'guardar_campos_usuarios');
      add_action('edit_user_profile_update', 'guardar_campos_usuarios');


      /* Custom Post Type Evento and Custom Fields
        ================================================== */

      function custom_post_type() {

        $labels = array(
          'name'                => _x( 'Eventos', 'Post Type General Name', 'text_domain' ),
          'singular_name'       => _x( 'Evento', 'Post Type Singular Name', 'text_domain' ),
          'menu_name'           => __( 'Evento', 'text_domain' ),
          'parent_item_colon'   => __( 'Eventos padre:', 'text_domain' ),
          'all_items'           => __( 'Todos los eventos', 'text_domain' ),
          'view_item'           => __( 'Ver evento', 'text_domain' ),
          'add_new_item'        => __( 'Añadir nuevo evento', 'text_domain' ),
          'add_new'             => __( 'Añadir nuevo ', 'text_domain' ),
          'edit_item'           => __( 'Editar evento', 'text_domain' ),
          'update_item'         => __( 'Actualizar evento', 'text_domain' ),
          'search_items'        => __( 'Buscar evento', 'text_domain' ),
          'not_found'           => __( 'Evento no encontrado', 'text_domain' ),
          'not_found_in_trash'  => __( 'Evento no encontrado en la papelera', 'text_domain' ),
        );
        $args = array(
          'label'               => __( 'evento', 'text_domain' ),
          'description'         => __( 'Post de tipo evento', 'text_domain' ),
          'labels'              => $labels,
          'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', ),
          'taxonomies'          => array( 'category', 'post_tag' ),
          'hierarchical'        => false,
          'public'              => true,
          'show_ui'             => true,
          'show_in_menu'        => true,
          'show_in_nav_menus'   => true,
          'show_in_admin_bar'   => true,
          'menu_position'       => 5,
          'menu_icon'           => 'dashicons-calendar',
          'can_export'          => true,
          'has_archive'         => true,
          'exclude_from_search' => false,
          'publicly_queryable'  => true,
          'capability_type'     => 'post',
        );
        register_post_type( 'evento', $args );

      }

      add_action( 'init', 'custom_post_type', 0 );

      function customtypes_add_meta_box() {
        $screens = array('evento');
        foreach ($screens as $screen) {
          add_meta_box(
          'customtypes_sectionid', __('Datos del evento', 'customtypes_textdomain'), 'customtypes_meta_box_callback', $screen
          );
        }
      }

      add_action('add_meta_boxes', 'customtypes_add_meta_box');


      function customtypes_meta_box_callback($post) {
        wp_nonce_field('customtypes_meta_box', 'customtypes_meta_box_nonce');


        //Fecha Inicio
        $value = get_post_meta($post->ID, 'fecha_inicio', true);
        echo '<label class="label-custom_type" for="fecha_inicio">';
        _e('Fecha de Inicio del Evento:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="date" id="fecha_inicio" name="fecha_inicio" value="' . esc_attr($value) . '"  /><br>';

        //Fecha Fin
        $value = get_post_meta($post->ID, 'fecha_fin', true);
        echo '<label class="label-custom_type" for="fecha_fin">';
        _e('Fecha de Fin del Evento:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="date" id="fecha_fin" name="fecha_fin" value="' . esc_attr($value) . '"  /><br>';

        //URL Google Maps
        $value = get_post_meta($post->ID, 'url_mapa', true);
        echo '<label class="label-custom_type" for="url_mapa">';
        _e('URL de Google Maps:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="url_mapa" name="url_mapa" value="' . esc_attr($value) . '"  /><br>';

        //Hora Inicio
        $value = get_post_meta($post->ID, 'hora_inicio', true);
        echo '<label class="label-custom_type" for="hora_inicio">';
        _e('Hora de Inicio:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="hora_inicio" name="hora_inicio" value="' . esc_attr($value) . '"  /><br>';

        //Hora Fin
        $value = get_post_meta($post->ID, 'hora_fin', true);
        echo '<label class="label-custom_type" for="hora_fin">';
        _e('Hora de Fin:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="hora_fin" name="hora_fin" value="' . esc_attr($value) . '"  /><br>';

        //Direccion Postal
        $value = get_post_meta($post->ID, 'direccion_postal', true);
        echo '<label class="label-custom_type" for="direccion_postal">';
        _e('Dirección Postal:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="direccion_postal" name="direccion_postal" value="' . esc_attr($value) . '" placeholder="Calle Zurita,  17" /><br>';

        //Localidad
        $value = get_post_meta($post->ID, 'localidad', true);
        echo '<label class="label-custom_type" for="localidad">';
        _e('Localidad:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="localidad" name="localidad" value="' . esc_attr($value) . '" placeholder="Altea" /><br>';

        //Provincia
        $value = get_post_meta($post->ID, 'provincia', true);
        echo '<label class="label-custom_type" for="provincia">';
        _e('Provincia:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="provincia" name="provincia" value="' . esc_attr($value) . '" placeholder="Alicante" /><br>';

        //Código Postal
        $value = get_post_meta($post->ID, 'codigo_postal', true);
        echo '<label class="label-custom_type" for="codigo_postal">';
        _e('Código Postal:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="codigo_postal" name="codigo_postal" value="' . esc_attr($value) . '" placeholder="03590" /><br>';


      }


      function customtypes_save_meta_box_data($post_id) {
      if (!isset($_POST['customtypes_meta_box_nonce'])) {
          return;
      }

      if (!wp_verify_nonce($_POST['customtypes_meta_box_nonce'], 'customtypes_meta_box')) {
          return;
      }

      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
          return;
      }

      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
          if (!current_user_can('edit_page', $post_id)) {
              return;
          }
      } else {
          if (!current_user_can('edit_post', $post_id)) {
              return;
          }
      }

      //Fecha Inicio

      if (!isset($_POST['fecha_inicio'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['fecha_inicio']);
      update_post_meta($post_id, 'fecha_inicio', $my_data);

      //Fecha Fin

      if (!isset($_POST['fecha_fin'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['fecha_fin']);
      update_post_meta($post_id, 'fecha_fin', $my_data);

      //URL Mapa

      if (!isset($_POST['url_mapa'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['url_mapa']);
      update_post_meta($post_id, 'url_mapa', $my_data);

      //Hora Inicio

      if (!isset($_POST['hora_inicio'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['hora_inicio']);
      update_post_meta($post_id, 'hora_inicio', $my_data);

      //Hora Fin

      if (!isset($_POST['hora_fin'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['hora_fin']);
      update_post_meta($post_id, 'hora_fin', $my_data);


      //Dirección Postal

      if (!isset($_POST['direccion_postal'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['direccion_postal']);
      update_post_meta($post_id, 'direccion_postal', $my_data);


      //Localidad

      if (!isset($_POST['localidad'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['localidad']);
      update_post_meta($post_id, 'localidad', $my_data);

      //Provincia

      if (!isset($_POST['provincia'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['provincia']);
      update_post_meta($post_id, 'provincia', $my_data);

      //Código postal

      if (!isset($_POST['codigo_postal'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['codigo_postal']);
      update_post_meta($post_id, 'codigo_postal', $my_data);

      }

      add_action('save_post', 'customtypes_save_meta_box_data');





      /* Custom Post Type Persona and Custom Fields
        ==================================================

      function custom_post_type_persona() {

        $labels = array(
          'name'                => _x( 'Personas', 'Post Type General Name', 'text_domain' ),
          'singular_name'       => _x( 'Persona', 'Post Type Singular Name', 'text_domain' ),
          'menu_name'           => __( 'Persona', 'text_domain' ),
          'parent_item_colon'   => __( 'Personas padre:', 'text_domain' ),
          'all_items'           => __( 'Todos los personas', 'text_domain' ),
          'view_item'           => __( 'Ver persona', 'text_domain' ),
          'add_new_item'        => __( 'Añadir nuevo persona', 'text_domain' ),
          'add_new'             => __( 'Añadir nuevo ', 'text_domain' ),
          'edit_item'           => __( 'Editar persona', 'text_domain' ),
          'update_item'         => __( 'Actualizar persona', 'text_domain' ),
          'search_items'        => __( 'Buscar persona', 'text_domain' ),
          'not_found'           => __( 'Persona no encontrado', 'text_domain' ),
          'not_found_in_trash'  => __( 'Persona no encontrado en la papelera', 'text_domain' ),
        );
        $args = array(
          'label'               => __( 'persona', 'text_domain' ),
          'description'         => __( 'Post de tipo persona', 'text_domain' ),
          'labels'              => $labels,
          'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', ),
          'taxonomies'          => array( 'category', 'post_tag' ),
          'hierarchical'        => false,
          'public'              => true,
          'show_ui'             => true,
          'show_in_menu'        => true,
          'show_in_nav_menus'   => true,
          'show_in_admin_bar'   => true,
          'menu_position'       => 5,
          'menu_icon'           => 'dashicons-businessman',
          'can_export'          => true,
          'has_archive'         => true,
          'exclude_from_search' => false,
          'publicly_queryable'  => true,
          'capability_type'     => 'post',
        );
        register_post_type( 'persona', $args );

      }

      add_action( 'init', 'custom_post_type_persona', 0 );

      function customtypes_add_meta_box_persona() {
        $screens = array('persona');
        foreach ($screens as $screen) {
          add_meta_box(
          'customtypes_sectionid', __('Datos de la persona', 'customtypes_textdomain'), 'customtypes_meta_box_callback_persona', $screen
          );
        }
      }

      add_action('add_meta_boxes', 'customtypes_add_meta_box_persona');


      function customtypes_meta_box_callback_persona($post) {
        wp_nonce_field('customtypes_meta_box_persona', 'customtypes_meta_box_nonce_persona');


        //Correo Electrónico
        $value = get_post_meta($post->ID, 'correo_electronico', true);
        echo '<label class="label-custom_type" for="correo_electronico">';
        _e('Correo Electrónico:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="email" id="correo_electronico" name="correo_electronico" value="' . esc_attr($value) . '" placeholder="correo@podemos.info" /><br>';

        //Usuario Twitter
        $value = get_post_meta($post->ID, 'twitter', true);
        echo '<label class="label-custom_type" for="twitter">';
        _e('URL de Twitter:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="twitter" name="twitter" value="' . esc_attr($value) . '"  placeholder="https://twitter.com/usuario"/><br>';

        //Usuario Facebook
        $value = get_post_meta($post->ID, 'facebook', true);
        echo '<label class="label-custom_type" for="facebook">';
        _e('URL de perfil de Facebook:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="facebook" name="facebook" value="' . esc_attr($value) . '"  placeholder="https://www.facebook.com/grupo"><br>';

        //Usuario Google Plus
        $value = get_post_meta($post->ID, 'google_plus', true);
        echo '<label class="label-custom_type" for="google_plus">';
        _e('URL de perfil de Google Plus:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="google_plus" name="google_plus" value="' . esc_attr($value) . '" placeholder="https://plus.google.com/usuario" /><br>';

        //Página web
        $value = get_post_meta($post->ID, 'pagina_web', true);
        echo '<label class="label-custom_type" for="pagina_web">';
        _e('Página web personal:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="pagina_web" name="pagina_web" value="' . esc_attr($value) . '" placeholder="http://tuweb.com" /><br>';

        //Teléfono
        $value = get_post_meta($post->ID, 'telefono', true);
        echo '<label class="label-custom_type" for="telefono">';
        _e('Teléfono de contacto:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="number" id="telefono" name="telefono" value="' . esc_attr($value) . '" placeholder="000 000 000" /><br>';

        //Nombre
        $value = get_post_meta($post->ID, 'nombre', true);
        echo '<label class="label-custom_type" for="nombre">';
        _e('Nombre:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="nombre" name="nombre" value="' . esc_attr($value) . '" placeholder="Nombre" /><br>';

        //Apellidos
        $value = get_post_meta($post->ID, 'apellidos', true);
        echo '<label class="label-custom_type" for="apellidos">';
        _e('Apellidos:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="apellidos" name="apellidos" value="' . esc_attr($value) . '" placeholder="Apellido" /><br>';

      }


      function customtypes_save_meta_box_data_persona($post_id) {
      if (!isset($_POST['customtypes_meta_box_nonce_persona'])) {
          return;
      }

      if (!wp_verify_nonce($_POST['customtypes_meta_box_nonce_persona'], 'customtypes_meta_box_persona')) {
          return;
      }

      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
          return;
      }

      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
          if (!current_user_can('edit_page', $post_id)) {
              return;
          }
      } else {
          if (!current_user_can('edit_post', $post_id)) {
              return;
          }
      }

      //Correo Electrónico

      if (!isset($_POST['correo_electronico'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['correo_electronico']);
      update_post_meta($post_id, 'correo_electronico', $my_data);

      //Usuario Twitter

      if (!isset($_POST['twitter'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['twitter']);
      update_post_meta($post_id, 'twitter', $my_data);

      //Usuario Facebook

      if (!isset($_POST['facebook'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['facebook']);
      update_post_meta($post_id, 'facebook', $my_data);


      //Usuario Google Plus

      if (!isset($_POST['google_plus'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['google_plus']);
      update_post_meta($post_id, 'google_plus', $my_data);

      //Pagina Web

      if (!isset($_POST['pagina_web'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['pagina_web']);
      update_post_meta($post_id, 'pagina_web', $my_data);


      //Teléfono

      if (!isset($_POST['telefono'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['telefono']);
      update_post_meta($post_id, 'telefono', $my_data);

      //Nombre

      if (!isset($_POST['nombre'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['nombre']);
      update_post_meta($post_id, 'nombre', $my_data);

      //Apellidos

      if (!isset($_POST['apellidos'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['apellidos']);
      update_post_meta($post_id, 'apellidos', $my_data);

      }

      add_action('save_post', 'customtypes_save_meta_box_data_persona');


      Deshabiitado hasta decisión de asamblea */




      /* Custom Post Type Comision and Custom Fields
        ================================================== */

      function custom_post_type_comision() {

        $labels = array(
          'name'                => _x( 'Comisiones', 'Post Type General Name', 'text_domain' ),
          'singular_name'       => _x( 'Comision', 'Post Type Singular Name', 'text_domain' ),
          'menu_name'           => __( 'Comision', 'text_domain' ),
          'parent_item_colon'   => __( 'Comisiones padre:', 'text_domain' ),
          'all_items'           => __( 'Todos los comisions', 'text_domain' ),
          'view_item'           => __( 'Ver comision', 'text_domain' ),
          'add_new_item'        => __( 'Añadir nuevo comision', 'text_domain' ),
          'add_new'             => __( 'Añadir nuevo ', 'text_domain' ),
          'edit_item'           => __( 'Editar comision', 'text_domain' ),
          'update_item'         => __( 'Actualizar comision', 'text_domain' ),
          'search_items'        => __( 'Buscar comision', 'text_domain' ),
          'not_found'           => __( 'Comision no encontrado', 'text_domain' ),
          'not_found_in_trash'  => __( 'Comision no encontrado en la papelera', 'text_domain' ),
        );
        $args = array(
          'label'               => __( 'comision', 'text_domain' ),
          'description'         => __( 'Post de tipo comision', 'text_domain' ),
          'labels'              => $labels,
          'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', ),
          'taxonomies'          => array( 'category', 'post_tag' ),
          'hierarchical'        => false,
          'public'              => true,
          'show_ui'             => true,
          'show_in_menu'        => true,
          'show_in_nav_menus'   => true,
          'show_in_admin_bar'   => true,
          'menu_position'       => 5,
          'menu_icon'           => 'dashicons-groups',
          'can_export'          => true,
          'has_archive'         => true,
          'exclude_from_search' => false,
          'publicly_queryable'  => true,
          'capability_type'     => 'post',
        );
        register_post_type( 'comision', $args );

      }

      add_action( 'init', 'custom_post_type_comision', 0 );

      function customtypes_add_meta_box_comision() {
        $screens = array('comision');
        foreach ($screens as $screen) {
          add_meta_box(
          'customtypes_sectionid', __('Datos de la comision', 'customtypes_textdomain'), 'customtypes_meta_box_callback_comision', $screen
          );
        }
      }

      add_action('add_meta_boxes', 'customtypes_add_meta_box_comision');


      function customtypes_meta_box_callback_comision($post) {
        wp_nonce_field('customtypes_meta_box_comision', 'customtypes_meta_box_nonce_comision');


        //Correo Electrónico
        $value = get_post_meta($post->ID, 'correo_electronico', true);
        echo '<label class="label-custom_type" for="correo_electronico">';
        _e('Correo Electrónico:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="email" id="correo_electronico" name="correo_electronico" value="' . esc_attr($value) . '" placeholder="correo@podemos.info" /><br>';

        //Usuario Twitter
        $value = get_post_meta($post->ID, 'twitter', true);
        echo '<label class="label-custom_type" for="twitter">';
        _e('URL de Twitter:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="twitter" name="twitter" value="' . esc_attr($value) . '"  placeholder="https://twitter.com/usuario"/><br>';

        //Grupo Facebook
        $value = get_post_meta($post->ID, 'grupo_facebook', true);
        echo '<label class="label-custom_type" for="grupo_facebook">';
        _e('URL de grupo de Facebook:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="grupo_facebook" name="grupo_facebook" value="' . esc_attr($value) . '"  placeholder="https://www.facebook.com/usuario"><br>';

        //Teléfono
        $value = get_post_meta($post->ID, 'telefono', true);
        echo '<label class="label-custom_type" for="telefono">';
        _e('Teléfono de contacto:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="number" id="telefono" name="telefono" value="' . esc_attr($value) . '" placeholder="000 000 000" /><br>';

        //Nombre Coordinador
        $value = get_post_meta($post->ID, 'nombre_coordinador', true);
        echo '<label class="label-custom_type" for="nombre_coordinador">';
        _e('Nombre del Coordinador:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="input-custom_type required" type="text" id="nombre_coordinador" name="nombre_coordinador" value="' . esc_attr($value) . '" placeholder="Nombre" /><br>';

      }


      function customtypes_save_meta_box_data_comision($post_id) {
      if (!isset($_POST['customtypes_meta_box_nonce_comision'])) {
          return;
      }

      if (!wp_verify_nonce($_POST['customtypes_meta_box_nonce_comision'], 'customtypes_meta_box_comision')) {
          return;
      }

      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
          return;
      }

      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
          if (!current_user_can('edit_page', $post_id)) {
              return;
          }
      } else {
          if (!current_user_can('edit_post', $post_id)) {
              return;
          }
      }

      //Correo Electrónico

      if (!isset($_POST['correo_electronico'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['correo_electronico']);
      update_post_meta($post_id, 'correo_electronico', $my_data);

      //Usuario Twitter

      if (!isset($_POST['twitter'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['twitter']);
      update_post_meta($post_id, 'twitter', $my_data);

      //Grupo Facebook

      if (!isset($_POST['grupo_facebook'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['grupo_facebook']);
      update_post_meta($post_id, 'grupo_facebook', $my_data);

      //Teléfono

      if (!isset($_POST['telefono'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['telefono']);
      update_post_meta($post_id, 'telefono', $my_data);

      //Nombre Coordinador

      if (!isset($_POST['nombre_coordinador'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['nombre_coordinador']);
      update_post_meta($post_id, 'nombre_coordinador', $my_data);

      }

      add_action('save_post', 'customtypes_save_meta_box_data_comision');



      /* Páginas de opciones del theme
        ================================================== */

      if ( !function_exists( 'optionsframework_init' ) ) {
          define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
          require_once dirname( __FILE__ ) . '/inc/options-framework.php';
      }
      

              
      
