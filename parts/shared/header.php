<header id="main_header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
	<div class="container">
		<h1 id="logo"><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>"></a></h1>
		<?php wp_nav_menu( array( 'container_class' => 'main_nav', 'items_wrap' => '<ul id="%1$s" class="%2$s" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">%3$s</ul>', 'theme_location' => 'primary' ) ); ?>
		<?php get_search_form(); ?>
	</div>
</header>
