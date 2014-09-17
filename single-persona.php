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
			<article class="person" itemscope itemtype="http://schema.org/Person">
				<figure><?php echo get_the_post_thumbnail($post_id, 'contact_face')?></figure>
				<h3 itemprop="name"><?php echo get_post_meta($post->ID, 'nombre', true); ?> <?php echo get_post_meta($post->ID, 'apellidos', true); ?></h3>
				<h2 itemprop="additionalName"><?php the_title(); ?></h2>
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
				<p itemprop="alternativeHeadline" class="excerpt"><?php echo get_the_excerpt(); ?></p>
				<div class="contact_text" itemprop="description">
					<?php the_content(); ?>
				</div>
				<h3>Datos de contacto</h3>
				<aside class="contact_info">
					<div class="direct_contact">
						<a class="icon mail" href="mailto:<?php echo get_post_meta($post->ID, 'correo_electronico', true); ?>" class="icon mail" itemprop="email"><?php echo get_post_meta($post->ID, 'correo_electronico', true); ?></a>
						<span class="icon phone" itemprop="telephone"><?php echo get_post_meta($post->ID, 'telefono', true); ?></span>
						<a target="_blank" href="" class="icon url" itemprop="url"><?php echo get_post_meta($post->ID, 'pagina_web', true); ?></a>
					</div>
				</aside>
				<?php comments_template( '', true ); ?>
			</article>
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>