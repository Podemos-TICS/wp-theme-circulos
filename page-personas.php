<?php
/**
 * Template Name: Contactos 
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="main_content" role="main">
		<div class="container">
			<section class="last_persons">
				<h3 class="section_title">Personas de contacto</h3>
				<?php $args = array( 'post_type' => 'personas', 'posts_per_page' => 10 ); ?>
				<?php $loop = new WP_Query( $args ); ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<article class="person" itemscope itemtype="http://schema.org/Person">
					<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="nofollow"><?php echo get_the_post_thumbnail($post_id, 'organization')?></a></figure>
					<h2 itemprop="name"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<aside class="social_profiles">
						<a target="_blank" href="<?php echo do_shortcode('[ct id="_ct_text_53f5de3a47b50"]'); ?>" class="icon twitter"></a> 
						<a target="_blank" href="<?php echo do_shortcode('[ct id="_ct_text_53f22aa20066a"]'); ?>" class="icon facebook"></a>
						<a target="_blank" href="<?php echo do_shortcode('[ct id="_ct_text_53f5dfa71d4ac"]'); ?>" class="icon gplus"></a>
					</aside>
					<div class="text" itemprop="description">
						<?php echo get_excerpt(100); ?>
					</div>
				</article>
				<?php endwhile; ?>
			</secion>
		</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>