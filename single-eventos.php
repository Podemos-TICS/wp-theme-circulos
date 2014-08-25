<?php
/**
 *  The Template for displaying all single events
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
			<article class="post event" itemscope itemtype="http://schema.org/Event">
				<h2 itemprop="name"><?php the_title(); ?></h2>
				<header>
					<figure><?php echo get_the_post_thumbnail($post_id, 'post')?></figure>
				</header>
				<div class="social_share module"></div>
				<aside class="event_info">
					<meta itemprop="startDate" content="<?php echo do_shortcode('[ct id="_ct_datepicker_53f20ab478c53"]'); ?>T<?php echo do_shortcode('[ct id="T_ct_selectbox_53f217fd44188"]'); ?>:<?php echo do_shortcode('[ct id="ct_Minutos_selectbox_13e9"]'); ?>"> 
					<meta itemprop="endDate" content="<?php echo do_shortcode('[ct id="_ct_datepicker_53f20b23cbbf7"]'); ?>T<?php echo do_shortcode('[ct id="_ct_selectbox_53f21916e6093"]'); ?>:<?php echo do_shortcode('[ct id="_ct_selectbox_53f72ffc71339"]'); ?>"> 
					<time class="icon date"><?php echo do_shortcode('[ct id="_ct_datepicker_53f20ab478c53"]'); ?></time>
					<time class="icon clock"><?php echo do_shortcode('[ct id="T_ct_selectbox_53f217fd44188"]'); ?>:<?php echo do_shortcode('[ct id="ct_Minutos_selectbox_13e9"]'); ?>-<?php echo do_shortcode('[ct id="_ct_selectbox_53f21916e6093"]'); ?>:<?php echo do_shortcode('[ct id="_ct_selectbox_53f72ffc71339"]'); ?></time>
					<a target="_blank" class="icon url" itemprop="url" href="<?php echo do_shortcode('[ct id="_ct_text_53f44ef41f8ac"]'); ?>">Mapa</a>  
					<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<span class="icon location" itemprop="streetAddress"><?php echo do_shortcode('[ct id="_ct_text_53f5e53e10752"]'); ?>, <?php echo do_shortcode('[ct id="_ct_text_53f5e6aa73dd1"]'); ?></span>
						<span itemprop="postalCode">03590</span><span itemprop="addressLocality">, <?php echo do_shortcode('[ct id="_ct_text_53f60f86a2acc"]'); ?></span><span itemprop="addressRegion">, <?php echo do_shortcode('[ct id="_ct_text_53f733dcca2df"]'); ?></span>
						<span itemprop="addressCountry"><?php echo do_shortcode('[ct id="ct_Pas_text_59c2"]'); ?></span>
					</address>
				</aside>
				<div class="event_text module" itemprop="description">
					<?php the_content(); ?>	
				</div>
				<aside class="post_tags module" itemprop="keywords">
					<h3 class="module_title">Tags</h3>
					<?php echo get_the_tag_list(); ?> 
				</aside>	
				<?php comments_template( '', true ); ?>
			</article>
			<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/sidebar') ); ?>		
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>

<?php echo do_shortcode('[ct id="_ct_text_53f5de3a47b50"]'); ?>