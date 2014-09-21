<?php
/**
 * Template Name: Persona
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="main_content" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		<div class="container">
			<section class="last_persons clearfix">
				<h3 class="section_title">Personas</h3>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'persona', 'posts_per_page' => 10, 'paged' => $paged );
				$wp_query = new WP_Query($args);
				while ( have_posts() ) : the_post(); ?>
					<article class="person" itemscope itemtype="http://schema.org/Person">
						<header>
							<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_post_thumbnail($post_id, 'contact_face')?></a></figure>
						</header>
						<h2 itemprop="additionalName"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php $the_title = get_the_title(); echo(count_char('60', $the_title)); ?></a></h2>
						<div class="contact_text" itemprop="description">
							<?php $excerpt = get_the_excerpt();  echo(count_char('100', $excerpt)); ?>
						</div>
						<?php
						$twitter =   get_post_meta($post->ID, 'twitter', true);
						$facebook =   get_post_meta($post->ID, 'facebook', true);
						$google_plus =   get_post_meta($post->ID, 'google_plus', true);
						if ( ( $twitter ) || ($facebook) || ($google_plus) ) { ?>
							<aside class="social_profiles">
							<?php if ($twitter) { ?><a target="_blank" href="<?php echo $twitter  ?>" class="icon twitter"></a><?php  } ?>
							<?php if ($facebook) { ?> <a target="_blank" href="<?php echo $facebook ?>" class="icon facebook"></a><?php  } ?>
							<?php if ($google_plus) { ?><a target="_blank" href="<?php echo $google_plus ?>" class="icon gplus"></a><?php  } ?>
							</aside>
						<?php  } ?>
					</article>
				<?php endwhile; ?>
			</section>
			<?php if (!previous_posts_link){ ?>
			<!-- Condicional para que no salga este código en caso de que no sea necesario -->
			<nav class="page_nav" role="navigation">
				<div class="previous"><?php previous_posts_link( 'Anteriores' ); ?></div>
				<div class="next"><?php next_posts_link( 'Siguientes', '' ); ?></div>
			</nav>
			<?php }?> 
		</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>


