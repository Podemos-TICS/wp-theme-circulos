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