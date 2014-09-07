<?php
/**
 * Template Name: Evento
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="main_content" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		<div class="container">
			<section class="last_events clearfix">
				<h3 class="section_title">Últimos Eventos</h3>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'evento', 'posts_per_page' => 10, 'paged' => $paged );
				$wp_query = new WP_Query($args);
				while ( have_posts() ) : the_post(); ?>
					<article class="post event" itemscope itemtype="http://schema.org/Event">
						<header>
							<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_post_thumbnail($post_id, 'post')?></a></figure>
						</header>
						<h2 itemprop="name"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<div class="event_text module" itemprop="description">
							<?php echo get_the_excerpt(); ?>
						</div>
						<aside class="event_info">
							<meta itemprop="startDate" content="<?php echo get_post_meta($post->ID, 'fecha_inicio', true); ?>">
							<meta itemprop="endDate" content="<?php echo get_post_meta($post->ID, 'fecha_fin', true); ?>">
							<time class="icon date"><?php echo get_post_meta($post->ID, 'fecha_inicio', true); ?> - <?php echo get_post_meta($post->ID, 'fecha_fin', true); ?></time>
							<time class="icon clock"><?php echo get_post_meta($post->ID, 'fecha_fin', true); ?></time>
							<a target="_blank" class="icon url" itemprop="url" href="<?php echo get_post_meta($post->ID, 'url_mapa', true); ?>">Mapa</a>
							<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								<span class="icon location" itemprop="streetAddress"><?php echo get_post_meta($post->ID, 'direccion_postal', true); ?></span>
								<span itemprop="postalCode"><?php echo get_post_meta($post->ID, 'codigo_postal', true); ?> </span><span itemprop="addressLocality"><?php echo get_post_meta($post->ID, 'localidad', true); ?></span>,  <span itemprop="addressRegion"><?php echo get_post_meta($post->ID, 'provincia', true); ?></span>
							</address>
						</aside>
					</article>
				<?php endwhile; ?>
			</section>
			<!-- Condicional para que no salga este código en caso de que no sea necesario -->
			<nav class="page_nav" role="navigation">
				<div class="previous"><?php previous_posts_link( 'Anteriores' ); ?></div>
				<div class="next"><?php next_posts_link( 'Siguientes', '' ); ?></div>
			</nav>
		</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>


