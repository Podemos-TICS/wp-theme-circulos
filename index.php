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
					<?php show_parent_category(); ?>
				</header>
				<h2 itemprop="headline"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<aside class="post_author clearfix" itemscope itemtype="http://data-vocabulary.org/Person">
					<figure itemprop="photo"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></figure>
					<h4 rel="author"><a target="_blank" title="Google Plus de <?php echo get_the_author() ; ?>" href="<?php the_author_meta( 'google_plus' ); ?>?rel=author" itemprop="contact"> de <span itemprop="name"><?php echo get_the_author() ; ?></span></a></h4>
					<time datetime="<?php the_time( 'Y/m/d g:i:s A' ); ?>" pubdate><?php the_date( 'j \d\e F Y'); ?></time>
				</aside>
				<p itemprop="alternativeHeadline" class="excerpt"><?php echo excerpt_count(160); ?></p>
			</article>
			<?php } $wp_query = $temp_query; ?>
			<?php else: ?>
			<h2>Todavía no hay contenido</h2>
			<?php endif; ?>
			<a href="/blog" class="button" title="Ver más noticias">Ver más noticias</a>
		</section>

	<section class="last_events clearfix">
		<h3 class="section_title"><a href="/eventos" title="Últimos eventos">Últimos Eventos</a></h3>
		<?php $args = array( 'post_type' => 'evento', 'posts_per_page' => 4 ); ?>
		<?php $loop = new WP_Query( $args ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<article class="post event" itemscope itemtype="http://schema.org/Event">
			<header>
				<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_post_thumbnail($post_id, 'post')?></a></figure>
			</header>
			<h2 itemprop="name"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="event_text module" itemprop="description">
				<?php echo excerpt_count(160); ?>
			</div>
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
		</article>
		<?php endwhile; ?>
	</section>
	<a href="/eventos" class="button" title="Ver más eventos">Ver más eventos</a>
	<section class="last_persons clearfix">
	<h3 class="section_title"><a href="/personas" title="Todos nosotros">Personas públicas</a></h3>
	<?php $args = array( 'post_type' => 'persona', 'posts_per_page' => 4 ); ?>
	<?php $loop = new WP_Query( $args ); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<article class="person" itemscope itemtype="http://schema.org/Person">
		<header>
			<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_post_thumbnail($post_id, 'contact_face')?></a></figure>
		</header>
		<h2 itemprop="additionalName"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="contact_text" itemprop="description">
			<?php echo excerpt_count(100); ?>
		</div>
		<aside class="social_profiles">
			<a target="_blank" href="http://twitter.com/<?php echo get_post_meta($post->ID, 'twitter', true); ?>" class="icon twitter"></a>
			<a target="_blank" href="<?php echo get_post_meta($post->ID, 'facebook', true); ?>" class="icon facebook"></a>
			<a target="_blank" href="<?php echo get_post_meta($post->ID, 'google_plus', true); ?>" class="icon gplus"></a>
		</aside>
	</article>
	<?php endwhile; ?>
	</section>
	<a href="/personas" class="button" title="Ver más personas">Conocer al resto</a>
	</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>