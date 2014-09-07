
      /* Custom Post Type Persona and Custom Fields
        ================================================== */

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
          'customtypes_sectionid', __('Datos del persona', 'customtypes_textdomain'), 'customtypes_meta_box_callback_persona', $screen
          );
        }
      }

      add_action('add_meta_boxes', 'customtypes_add_meta_box_persona');


      function customtypes_meta_box_callback_persona($post) {
        wp_nonce_field('customtypes_meta_box_persona', 'customtypes_meta_box_nonce_persona');


        //Correo Electrónico
        $value = get_post_meta($post->ID, 'correo_electronico', true);
        echo '<label for="correo_electronico">';
        _e('Correo Electrónico:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="date" id="correo_electronico" name="correo_electronico" value="' . esc_attr($value) . '" placeholder="correo@podemos.info" /><br>';

        //Usuario Twitter
        $value = get_post_meta($post->ID, 'twitter', true);
        echo '<label for="twitter">';
        _e('Twitter:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="date" id="twitter" name="twitter" value="' . esc_attr($value) . '"  placeholder="podemos"/><br>';

        //Usuario Facebook
        $value = get_post_meta($post->ID, 'facebook', true);
        echo '<label for="facebook">';
        _e('Facebook:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="text" id="facebook" name="facebook" value="' . esc_attr($value) . '"  placeholder="https://www.facebook.com/usuario><br>';

        //Usuario Google Plus
        $value = get_post_meta($post->ID, 'google_plus', true);
        echo '<label for="google_plus">';
        _e('Google Plus:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="text" id="google_plus" name="google_plus" value="' . esc_attr($value) . '" placeholder="https://plus.google.com/usuario" /><br>';

        //Página web
        $value = get_post_meta($post->ID, 'pagina_web', true);
        echo '<label for="pagina_web">';
        _e('Página web:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="text" id="pagina_web" name="pagina_web" value="' . esc_attr($value) . '" placeholder="http://tuweb.com" /><br>';

        //Teléfono
        $value = get_post_meta($post->ID, 'telefono', true);
        echo '<label for="telefono">';
        _e('Teléfono:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="text" id="telefono" name="telefono" value="' . esc_attr($value) . '" placeholder="000 000 000" /><br>';

        //Nombre
        $value = get_post_meta($post->ID, 'nombre', true);
        echo '<label for="nombre">';
        _e('Nombre:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="text" id="nombre" name="nombre" value="' . esc_attr($value) . '" placeholder="Nombre" /><br>';

        //Apellidos
        $value = get_post_meta($post->ID, 'apellidos', true);
        echo '<label for="apellidos">';
        _e('Apellidos:  ', 'customtypes_textdomain');
        echo '</label> ';
        echo '<input class="required" type="text" id="apellidos" name="apellidos" value="' . esc_attr($value) . '" placeholder="Apellido" /><br>';

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


      //Telefono

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

      //Código postal

      if (!isset($_POST['apellidos'])) {
          return;
      }

      $my_data = sanitize_text_field($_POST['apellidos']);
      update_post_meta($post_id, 'apellidos', $my_data);

      }

      add_action('save_post', 'customtypes_save_meta_box_data_persona');
