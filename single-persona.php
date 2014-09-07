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
				<aside class="social_profiles">
					<a target="_blank" href="http://twitter.com/<?php echo get_post_meta($post->ID, 'twitter', true); ?>" class="icon twitter"></a>
					<a target="_blank" href="<?php echo get_post_meta($post->ID, 'facebook', true); ?>" class="icon facebook"></a>
					<a target="_blank" href="<?php echo get_post_meta($post->ID, 'google_plus', true); ?>" class="icon gplus"></a>
				</aside>
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
			<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/sidebar') ); ?>
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>