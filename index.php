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


		<?php $args = array( 'post_type' => 'evento', 'posts_per_page' => 4 ); ?>
		<?php $loop = new WP_Query( $args ); ?>
		<?php  $existe_evento=$loop->have_posts();
		if ($existe_evento){ ?>
			<section class="last_events clearfix">
				<h3 class="section_title"><a href="/eventos" title="Últimos eventos">Últimos Eventos</a></h3>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<article class="post event" itemscope itemtype="http://schema.org/Event">
					<header>
						<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_post_thumbnail($post_id, 'post')?></a></figure>
					</header>
					<h2 itemprop="name"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="event_text module" itemprop="description">
						<?php echo excerpt_count(160); ?>
					</div>
					<?php
					$fecha_inicio =   get_post_meta($post->ID, 'fecha_inicio', true);
					$fecha_fin =   get_post_meta($post->ID, 'fecha_fin', true);
					$url_mapa =   get_post_meta($post->ID, 'url_mapa', true);
					$direccion_postal =   get_post_meta($post->ID, 'direccion_postal', true);
					$codigo_postal =   get_post_meta($post->ID, 'codigo_postal', true);
					$localidad =   get_post_meta($post->ID, 'localidad', true);
					$provincia =   get_post_meta($post->ID, 'provincia', true);
					if ( ( $fecha_inicio ) || ($fecha_fin) || ($url_mapa)  || ($direccion_postal)  || ($codigo_postal)  || ($localidad)  || ($provincia)  ) { ?>
						<aside class="event_info">
							<?php if ($fecha_inicio) { ?><meta itemprop="startDate" content="<?php echo $fecha_inicio ?>"><?php  } ?>
							<?php if ($fecha_fin) { ?><meta itemprop="endDate" content="<?php echo $fecha_fin ?>"><?php  } ?>
							<?php if ( ($fecha_inicio) || ($fecha_fin) ) { ?><time class="icon date"><?php echo $fecha_inicio ?> - <?php echo $fecha_fin ?></time> <?php  } ?>
							<?php if ( ($hora_inicio) || ($hora_fin) ) { ?><time class="icon clock"><?php echo $hora_inicio ?> - <?php echo $hora_fin ?></time><?php  } ?>
							<?php if ($url_mapa) { ?><a target="_blank" class="icon url" itemprop="url" href="<?php echo $url_mapa ?>">Mapa</a><?php  } ?>
							<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								<?php if ($direccion_postal) { ?><span class="icon location" itemprop="streetAddress"><?php echo $direccion_postal ?></span><?php  } ?>
								<?php if ($codigo_postal) { ?><span itemprop="postalCode"><?php echo $codigo_postal ?> - </span><?php  } ?><?php if ($localidad) { ?><span itemprop="addressLocality"><?php echo $localidad ?></span><?php  } ?>,  <?php if ($provincia) { ?><span itemprop="addressRegion"><?php echo $provincia ?></span><?php  } ?>
							</address>
						</aside>
					<?php  } ?>
				</article>
				<?php endwhile; ?>
			</section>
			<a href="/eventos" class="button" title="Ver más eventos">Ver más eventos</a>
		<?php } ?>

		<?php $args = array( 'post_type' => 'persona', 'posts_per_page' => 4 ); ?>
		<?php $loop = new WP_Query( $args ); ?>
		<?php  $existe_persona=$loop->have_posts();
		if ($existe_persona){ ?>
			<section class="last_persons clearfix">
				<h3 class="section_title"><a href="/personas" title="Todos nosotros">Personas públicas</a></h3>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<article class="person" itemscope itemtype="http://schema.org/Person">
					<header>
						<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_post_thumbnail($post_id, 'contact_face')?></a></figure>
					</header>
					<h2 itemprop="additionalName"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="contact_text" itemprop="description">
						<?php echo excerpt_count(100); ?>
					</div>
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
				</article>
				<?php endwhile; ?>
			</section>
			<a href="/personas" class="button" title="Ver más">Ver más</a>
		<?php } ?>

	</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>