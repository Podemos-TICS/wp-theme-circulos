<?php
/**
 *  The Template for displaying all single personas
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="detail">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="container">
			<article class="person" itemscope itemtype="http://schema.org/Person">
				<figure><?php echo get_the_post_thumbnail($post_id, 'contact-face')?></figure>
				<?php $nombre = get_post_meta($post->ID, 'nombre', true);
				if (!empty($nombre && $apellidos)){ ?>
				<h3 itemprop="name"><?php echo $nombre ?> <?php echo $apellidos ?></h3>
				<?php } else { ?>
				<h2>Los campos no están completos</h2>
				<?php } ?>
				<h2 itemprop="additionalName"><?php the_title(); ?></h2>
				<aside class="social_profiles">
					<a target="_blank" href="#" class="icon twitter"></a>
					<a target="_blank" href="" class="icon facebook"></a>
					<a target="_blank" href="" class="icon gplus"></a>
				</aside>
				<div class="contact_text" itemprop="description">
					<?php the_content(); ?>
				</div>
				<h3>Datos de contacto</h3>
				<aside class="contact_info">
					<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<span class="icon location" itemprop="streetAddress">, </span>
						<p><span itemprop="postalCode"></span><span itemprop="addressLocality">, </span><span itemprop="addressRegion">,  </span></p>
						<span itemprop="addressCountry"></span>
					</address>
					<div class="direct_contact">
						<a class="icon mail" href="mailto:<?php echo do_shortcode('[ct id="_ct_text_53f38310ab9d4"]'); ?>" class="icon mail" itemprop="email"></a>
						<span class="icon phone" itemprop="telephone"></span>
						<a target="_blank" href="<?php echo do_shortcode('[ct id="_ct_text_53f22ae9f1c25"]'); ?>" class="icon url" itemprop="url"></a>
					</div>
				</aside>
				<?php comments_template( '', true ); ?>
			</article>
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>