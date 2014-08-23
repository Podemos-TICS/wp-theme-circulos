<?php
/**
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
				<header>
					<h2 itemprop="additionalName"><?php the_title(); ?></h2>
					<h3 itemprop="name">NOMBRE COMPLETO</h3>
				</header>
				<div class="contact_text" itemprop="description">
					<?php the_content(); ?>	
				</div>
				<aside class="social_profiles">
					<a target="_blank" href="#" class="icon twitter"></a>
					<a target="_blank" href="#" class="icon facebook"></a>
					<a target="_blank" href="#" class="icon gplus"></a>
				</aside>
				<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<span itemprop="streetAddress">DIRECCIÓN</span>
					<span itemprop="addressLocality">LOCALIDAD</span>,
					<span itemprop="postalCode">CÓDIGOPOSTAL</span>
				</address>
				<a class="mail" href="mailto:CORREO ELECTRÓNICO" class="icon" itemprop="email">CORREO ELECTRÓNICO</a>
				<span class="phone" itemprop="telephone">123 34 56 78</span>
				<a target="_blank" href="#" class="web" itemprop="url">URL DE LA WEB</a>
				<span class="skype">USUARIO SKYPE</span>

				<?php comments_template( '', true ); ?>
			</article>
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>