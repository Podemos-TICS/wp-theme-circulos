<?php

/* Información del cículo
================================================== */


function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {

	/* Pestaña de Información de contacto
	================================================== */

	$options[] = array(
		'name' => __('Información de contacto', 'options_framework_theme'),
		'type' => 'heading'
	);


		//Teléfono
		$options[] = array(
			'name' => __('Teléfono de contacto', 'options_framework_theme'),
			'desc' => __('Instroduzca el número de teléfono de contacto con círculo.', 'options_framework_theme'),
			'id' => 'telefono',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Dirección postal
		$options[] = array(
			'name' => __('Dirección de contacto', 'options_framework_theme'),
			'desc' => __('Instroduzca su dirección postal del círculo.', 'options_framework_theme'),
			'id' => 'direccion_postal',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Código postal
		$options[] = array(
			'name' => __('Código postal', 'options_framework_theme'),
			'desc' => __('Instroduzca su código postal.', 'options_framework_theme'),
			'id' => 'codigo_postal',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Provincia
		$options[] = array(
			'name' => __('Provincia', 'options_framework_theme'),
			'desc' => __('Instroduzca su provincia.', 'options_framework_theme'),
			'id' => 'provincia',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);


		//Localidad
		$options[] = array(
			'name' => __('Localidad', 'options_framework_theme'),
			'desc' => __('Instroduzca su localidad.', 'options_framework_theme'),
			'id' => 'localidad',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);


		//País
		$options[] = array(
			'name' => __('País', 'options_framework_theme'),
			'desc' => __('Instroduzca su pais.', 'options_framework_theme'),
			'id' => 'pais',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Email Círculo
		$options[] = array(
			'name' => __('Email del Círculo', 'options_framework_theme'),
			'desc' => __('Instroduzca el email del círculo.', 'options_framework_theme'),
			'id' => 'email_circulo',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);


	/* Pestaña de Redes del Círculo
	================================================== */

	$options[] = array(
		'name' => __('Redes del Círculo', 'options_framework_theme'),
		'type' => 'heading'
	);


		//Twitter
		$options[] = array(
			'name' => __('Twitter', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL del perfil de Twitter', 'options_framework_theme'),
			'id' => 'twitter',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);


		//Google Plus
		$options[] = array(
			'name' => __('Google Plus', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL del perfil de Twitter', 'options_framework_theme'),
			'id' => 'google_plus',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Google Group
		$options[] = array(
			'name' => __('Google Group', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL del perfil de Google Group', 'options_framework_theme'),
			'id' => 'google_group',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Facebook Fan Page
		$options[] = array(
			'name' => __('Facebook Fan Page', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL de la fan page de Facebook', 'options_framework_theme'),
			'id' => 'facebook_fan_page',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);


		//Facebook Grupo
		$options[] = array(
			'name' => __('Facebook Grupo', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL de la pagina de grupo de Facebook', 'options_framework_theme'),
			'id' => 'facebook_grupo',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Diaspora
		$options[] = array(
			'name' => __('Diaspora', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL de la pagina de Diaspora', 'options_framework_theme'),
			'id' => 'diaspora',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Loomio
		$options[] = array(
			'name' => __('Loomio', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL de la pagina de Loomio', 'options_framework_theme'),
			'id' => 'loomio',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//Reddit
		$options[] = array(
			'name' => __('Reddit', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL de la pagina de Reddit (Plaza Podemos)', 'options_framework_theme'),
			'id' => 'reddit',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);

		//N-1
		$options[] = array(
			'name' => __('N-1', 'options_framework_theme'),
			'desc' => __('Instroduzca la URL de la pagina de N-1 (Plaza Podemos)', 'options_framework_theme'),
			'id' => 'ene_uno',
			'std' => '',
			'class' => 'mini',
			'type' => 'text'
		);


	/* Pestaña de personalización del Tema
	================================================== */

	$options[] = array(
		'name' => __('Personalización del Tema', 'options_framework_theme'),
		'type' => 'heading'
	);

	$options[] = array(
	     'name' => __('Imagen cabecera', 'options_check'),
	     'desc' => __('Selecciona el imagen de cabecera que quieras mostrar, tamaño de 1260 × 450px.', 'options_check'),
	     'id' => 'imagen_cabecera',
	     'type' => 'upload');

	return $options;
}