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
			<article class="post event" itemscope itemtype="http://schema.org/Event">
				<h2 itemprop="name"><?php the_title(); ?></h2>
				<header>
					<figure><?php echo get_the_post_thumbnail($post_id, 'post')?></figure>
				</header>
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
				<div class="event_text module" itemprop="description">
					<?php the_content(); ?>
				</div>
				<?php if (get_the_tag_list() ) : ?>
				<aside class="post_tags module" itemprop="keywords">
					<h3 class="module_title">Tags</h3>
					<?php echo get_the_tag_list(); ?>
				</aside>
				<?php endif; ?>
				<?php comments_template( '', true ); ?>
			</article>
			<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/sidebar') ); ?>
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>