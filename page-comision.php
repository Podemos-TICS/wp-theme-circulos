<?php
/**
 * Template Name: Comision
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="main_content" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		<div class="container">
			<section class="last_organizations clearfix">
				<h3 class="section_title">Comisiones</h3>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'comision', 'posts_per_page' => 10, 'paged' => $paged );
				$wp_query = new WP_Query($args);
				while ( have_posts() ) : the_post(); ?>
				<article class="organization" itemscope itemtype="http://schema.org/NGO">
						<header>
							<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_post_thumbnail($post_id, 'contact_face')?></a></figure>
						</header>
						<h2 itemprop="name"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<div class="contact_text" itemprop="description">
							<?php echo excerpt_count(100); ?>
						</div>
						<aside class="social_profiles">
							<a target="_blank" href="http://twitter.com/<?php echo get_post_meta($post->ID, 'twitter', true); ?>" class="icon twitter"></a>
							<a target="_blank" href="<?php echo get_post_meta($post->ID, 'facebook', true); ?>" class="icon facebook"></a>
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


