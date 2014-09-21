<?php
/**
 * The Template for displaying all single event
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="detail" itemscope='itemscope' itemtype='http://schema.org/Blog'>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="container">
			<article class="organization" itemscope itemtype="http://schema.org/NGO">
				<figure><?php echo get_the_post_thumbnail($post_id, 'organization')?></figure>
				<h2><?php the_title(); ?></h2>
				<?php
				$twitter =   get_post_meta($post->ID, 'twitter', true);
				$facebook =   get_post_meta($post->ID, 'grupo_facebook', true);
	
				if ( ( $twitter ) || ($facebook) ) { ?>
					<aside class="social_profiles">
					<?php if ($twitter) { ?><a target="_blank" href="<?php echo $twitter  ?>" class="icon twitter"></a><?php  } ?>
					<?php if ($facebook) { ?> <a target="_blank" href="<?php echo $facebook ?>" class="icon facebook"></a><?php  } ?>
					</aside>
				<?php  } ?>
				<p class="excerpt"><?php echo get_the_excerpt(); ?></p>
				<div class="text" itemprop="description">
					<?php the_content(); ?>
				</div>
				<h3>Datos de contacto</h3>
				<aside class="contact_info">
					<div class="direct_contact">
						<p>Persona de contacto: <?php echo get_post_meta($post->ID, 'nombre', true); ?> </p>
						<a class="icon mail" href="mailto:<?php echo get_post_meta($post->ID, 'correo_electronico', true); ?>" class="icon mail" itemprop="email"><?php echo get_post_meta($post->ID, 'correo_electronico', true); ?></a>
						<span class="icon phone" itemprop="telephone"><?php echo get_post_meta($post->ID, 'telefono', true); ?></span>
					</div>
				</aside>
				<?php comments_template( '', true ); ?>
			</article>
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>