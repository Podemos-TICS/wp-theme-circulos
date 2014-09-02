<?php
/**
 * Template Name: Eventos 
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="main_content" role="main">
		<div class="container">
			<section class="last_events">
				<h3 class="section_title"><a href="/blog" title="Últimos eventos">Últimos Eventos</a></h3>
				<?php $args = array( 'post_type' => 'eventos', 'posts_per_page' => 10 ); ?>
				<?php $loop = new WP_Query( $args ); ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<article class="post event clearfix" itemscope itemtype="http://schema.org/Event">
					<header>
						<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="nofollow"><?php echo get_the_post_thumbnail($post_id, 'even_list')?></a></figure>
					</header>
					<h2 itemprop="name"><?php the_title(); ?></h2>
					<div class="event_text module" itemprop="description">
						<?php echo get_excerpt(160); ?>
					</div>
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
				</article>
				<?php endwhile; ?>
			</section>
		</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>


