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
				<h2 itemprop="additionalName"><?php the_title(); ?></h2>
				<h3 itemprop="name"><?php echo do_shortcode('[ct id="_ct_text_53f73d239a8e3"]'); ?> <?php echo do_shortcode('[ct id="_ct_text_53f73d6cf1135"]'); ?></h3>
				<aside class="social_profiles">
					<a target="_blank" href="<?php echo do_shortcode('[ct id="_ct_text_53f5de3a47b50"]'); ?>" class="icon twitter"></a> 
					<a target="_blank" href="<?php echo do_shortcode('[ct id="_ct_text_53f22aa20066a"]'); ?>" class="icon facebook"></a>
					<a target="_blank" href="<?php echo do_shortcode('[ct id="_ct_text_53f5dfa71d4ac"]'); ?>" class="icon gplus"></a>
				</aside>
				<div class="contact_text" itemprop="description">
					<?php the_content(); ?>	
				</div> 
				<h3>Datos de contacto</h3>
				<aside class="contact_info">
					<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<span class="icon location" itemprop="streetAddress"><?php echo do_shortcode('[ct id="_ct_text_53f5e53e10752"]'); ?>, <?php echo do_shortcode('[ct id="_ct_text_53f5e6aa73dd1"]'); ?></span>
						<p><span itemprop="postalCode"><?php echo do_shortcode('[ct id="_ct_text_53f75147d88ac"]'); ?></span><span itemprop="addressLocality">, <?php echo do_shortcode('[ct id="_ct_text_53f60f86a2acc"]'); ?> </span><span itemprop="addressRegion">,  <?php echo do_shortcode('[ct id="_ct_text_53f733dcca2df"]'); ?></span></p>
						<span itemprop="addressCountry"><?php echo do_shortcode('[ct id="ct_Pas_text_59c2"]'); ?></span>
					</address>
					<div class="direct_contact">
						<a class="icon mail" href="mailto:<?php echo do_shortcode('[ct id="_ct_text_53f38310ab9d4"]'); ?>" class="icon mail" itemprop="email"><?php echo do_shortcode('[ct id="_ct_text_53f38310ab9d4"]'); ?></a>
						<span class="icon phone" itemprop="telephone"><?php echo do_shortcode('[ct id="_ct_text_53f3821bf2c5f"]'); ?></span>
						<a target="_blank" href="<?php echo do_shortcode('[ct id="_ct_text_53f22ae9f1c25"]'); ?>" class="icon url" itemprop="url"><?php echo do_shortcode('[ct id="_ct_text_53f22ae9f1c25"]'); ?></a>
					</div>
				</aside>
				<?php comments_template( '', true ); ?>
			</article>
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>