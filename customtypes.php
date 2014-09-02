<?php
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
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
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
    