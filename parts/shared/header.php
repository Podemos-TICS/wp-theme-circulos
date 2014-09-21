<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/pre-header' ) ); ?>


<?php $imagen_cabecera = of_get_option('imagen_cabecera',''); ?>

<header id="main_header" role="banner" itemscope itemtype="http://schema.org/WPHeader" <?php if ($imagen_cabecera) { ?>
      style="background-image: url('<?php echo $imagen_cabecera ?>');"
    <?php }else{ ?>
          style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/main-bg.jpg');"
    <?php }?>>
	<h1><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<nav class="nav_container">
		<div class="container">
			<?php wp_nav_menu( array( 'container_class' => 'main_nav', 'items_wrap' => '<ul id="%1$s" class="%2$s" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">%3$s</ul>', 'theme_location' => 'primary' ) ); ?>
                  <button id="search" class="icon search" title="Desplegar Buscador"></button>
                  <a class="icon user login" href="/wp-login.php" title="Iniciar Sesión"></a>
		</div>
            <?php wp_nav_menu_select(
                array(
                    'theme_location' => 'select-menu',
                    'menu_class' => 'custom-class'
                )
            ); ?>
	</nav>
</header>
  <?php get_search_form(); ?>
