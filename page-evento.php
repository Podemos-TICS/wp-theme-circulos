<?php
/**
 * Template Name: Evento
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="main_content" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		<div class="container">
			<section class="last_events clearfix">
				<h3 class="section_title">Últimos Eventos</h3>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'evento', 'posts_per_page' => 10, 'paged' => $paged, 'orderby'=>'date' );
				$wp_query = new WP_Query($args);
				while ( have_posts() ) : the_post(); ?>
					<article class="post event" itemscope itemtype="http://schema.org/Event">
						<header>
							<figure><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo get_the_post_thumbnail($post_id, 'post')?></a></figure>
						</header>
						<h2 itemprop="name"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php $the_title = get_the_title(); echo(count_char('60', $the_title)); ?></a></h2>
						<div class="event_text module" itemprop="description">
							<?php $excerpt = get_the_excerpt();  echo(count_char('140', $excerpt)); ?>
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
			<?php if (!previous_posts_link){ ?>
			<!-- Condicional para que no salga este código en caso de que no sea necesario -->
			<nav class="page_nav" role="navigation">
				<div class="previous"><?php previous_posts_link( 'Anteriores' ); ?></div>
				<div class="next"><?php next_posts_link( 'Siguientes', '' ); ?></div>
			</nav>
			<?php }?>
		</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>


