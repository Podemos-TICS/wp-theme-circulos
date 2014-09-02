<?php
add_action( 'init', 'create_events_taxonomies', 0 );

function create_events_taxonomies() {

	$labels = array(
		'name'              => _x( 'Categorías', 'taxonomy general name' ),
		'singular_name'     => _x( 'Categoría', 'taxonomy singular name' ),
		'search_items'      => __( 'Buscar Categorías' ),
		'all_items'         => __( 'Todas Categorías' ),
		'parent_item'       => __( 'Parent Categoría' ),
		'parent_item_colon' => __( 'Parent Categoría:' ),
		'edit_item'         => __( 'Editar Categoría' ),
		'update_item'       => __( 'Actualizar Categoría' ),
		'add_new_item'      => __( 'Añadir nueva Categoría' ),
		'new_item_name'     => __( 'Nombre de la Categoría' ),
		'menu_name'         => __( 'Categoría' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'Categoría' ),
	);

	register_taxonomy( 'Categoría', array( 'events' ), $args );
	
}
?>