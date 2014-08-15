<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/pre-header' ) ); ?>

<header id="main_header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
	<h1><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<nav class="nav_container">
		<div class="container">
			<?php wp_nav_menu( array( 'container_class' => 'main_nav', 'items_wrap' => '<ul id="%1$s" class="%2$s" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">%3$s</ul>', 'theme_location' => 'primary' ) ); ?>
			<?php get_search_form(); ?>
		</div>
	</nav>
</header>
