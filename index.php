<?php
/**
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header' , 'parts/shared/header' ) ); ?>

<section id="main_content" role="main">
	<div class="container">
		<section class="call_to_action">
			<div><a class="circulo icon cooperate" href="/colabora" title="Colabora"></a><h2><a href="#" rel="nofollow" title="Colabora">Colabora</a></h2></div>
			<div><a class="circulo icon date" href="/eventos" title="Eventos"></a><h2><a href="#" rel="nofollow" title="Eventos">Eventos</a></h2></div>
			<div><a class="circulo icon comission" href="/comisiones" title="Comisiones"></a><h2><a href="#" rel="nofollow" title="Comisiones">Comisiones</a></h2></div>
			<div><a class="circulo icon propuestas" href="/propuestas" title="Propuestas"></a><h2><a href="#" rel="nofollow" title="Propuestas">Propuestas</a></h2></div>
		</section>
		<section class="last_post">
			<h3 class="section_title"><a href="/blog" title="Últimas noticias">Últimas Noticias</a></h3>
			<?php if ( have_posts() ): ?>
			<?php $temp_query = $wp_query; query_posts('showposts=2'); ?>
			<?php while (have_posts()) { the_post(); ?>
			<article class="post" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
				<header>
					<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="nofollow"><?php echo get_the_post_thumbnail($post_id, 'last_post')?></a></figure>
					<?php $parentscategory ="";
					foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
					$parentscategory .= '<a class="category" rel="category" href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
					}	
					}
					echo substr($parentscategory,0,-2); ?>
				</header>
				<h2 itemprop="headline"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo max_title(70); ?></a></h2>
				<aside class="post_author clearfix" itemscope itemtype="http://data-vocabulary.org/Person">
					<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
					<figure itemprop="photo"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></figure>
					<h4 rel="author"><a target="_blank" title="Google Plus de <?php echo get_the_author() ; ?>" href="<?php the_author_meta( 'google_plus' ); ?>?rel=author" itemprop="contact"> de <span itemprop="name"><?php echo get_the_author() ; ?></span></a></h4>
					<?php endif; ?>
					<time datetime="<?php the_time( 'Y/m/d g:i:s A' ); ?>" pubdate><?php the_date( 'j \d\e F Y'); ?></time>
				</aside>
				<?php echo get_excerpt(160); ?>
			</article>
			<?php } $wp_query = $temp_query; ?>
			<?php else: ?>
			<h2>Todavía no hay contenido</h2>
			<?php endif; ?>
			<a href="/blog" class="button" title="Ver más noticias">Ver más noticias</a>
		</section>

		<section class="last_events clearfix">
			<h3 class="section_title"><a href="/eventos" title="Últimos eventos">Últimos Eventos</a></h3>
				<?php $args = array( 'post_type' => 'eventos', 'posts_per_page' => 4 ); ?>
				<?php $loop = new WP_Query( $args ); ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<article class="post event clearfix" itemscope itemtype="http://schema.org/Event">
					<header>
						<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="nofollow"><?php echo get_the_post_thumbnail($post_id, 'even_list')?></a></figure>
					</header>
					<h2 itemprop="name"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="event_text module" itemprop="description">
						<?php the_excerpt(); ?>	
					</div>
					<aside class="event_info">
						<meta itemprop="startDate" content="<?php echo do_shortcode('[ct id="_ct_datepicker_53f20ab478c53"]'); ?>T<?php echo do_shortcode('[ct id="T_ct_selectbox_53f217fd44188"]'); ?>:<?php echo do_shortcode('[ct id="ct_Minutos_selectbox_13e9"]'); ?>"> 
						<meta itemprop="endDate" content="<?php echo do_shortcode('[ct id="_ct_datepicker_53f20b23cbbf7"]'); ?>T<?php echo do_shortcode('[ct id="_ct_selectbox_53f21916e6093"]'); ?>:<?php echo do_shortcode('[ct id="_ct_selectbox_53f72ffc71339"]'); ?>"> 
						<time class="icon date"><?php echo do_shortcode('[ct id="_ct_datepicker_53f20ab478c53"]'); ?></time>
						<time class="icon clock"><?php echo do_shortcode('[ct id="_ct_selectbox_53f217fd44188"]'); ?>:<?php echo do_shortcode('[ct id="ct_Minutos_selectbox_13e9"]'); ?>-<?php echo do_shortcode('[ct id="_ct_selectbox_53f21916e6093"]'); ?>:<?php echo do_shortcode('[ct id="_ct_selectbox_53f72ffc71339"]'); ?></time>
						<a target="_blank" class="icon url" itemprop="url" href="<?php echo do_shortcode('[ct id="_ct_text_53f44ef41f8ac"]'); ?>">Mapa</a>  
						<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
							<span class="icon location" itemprop="streetAddress"><?php echo do_shortcode('[ct id="_ct_text_53f5e53e10752"]'); ?>, <?php echo do_shortcode('[ct id="_ct_text_53f5e6aa73dd1"]'); ?></span>
							<span itemprop="postalCode"><?php echo do_shortcode('[ct id="_ct_text_53f75147d88ac"]'); ?></span><span itemprop="addressLocality">, <?php echo do_shortcode('[ct id="_ct_text_53f60f86a2acc"]'); ?></span><span itemprop="addressRegion">, <?php echo do_shortcode('[ct id="_ct_text_53f733dcca2df"]'); ?></span>
							<span itemprop="addressCountry"><?php echo do_shortcode('[ct id="ct_Pas_text_59c2"]'); ?></span>
						</address>
					</aside>
				</article>
				<?php endwhile; ?>			
		</section>
		<a href="/eventos" class="button" title="Ver más eventos">Ver más eventos</a>

		<section class="last_persons clearfix">
			<h3 class="section_title"><a href="/personas" title="Todos nosotros">Personas públicas</a></h3>
				<?php $args = array( 'post_type' => 'personas', 'posts_per_page' => 4 ); ?>
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
		</section>
		<a href="/personas" class="button" title="Ver más personas">Conocer al resto</a>

	</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>