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
			<div><a class="circulo icon colabora" href="#" title="Colabora"></a><h2><a href="#" rel="nofollow" title="Colabora">Colabora</a></h2></div>
			<div><a class="circulo icon fecha" href="#" title="Eventos"></a><h2><a href="#" rel="nofollow" title="Eventos">Eventos</a></h2></div>
			<div><a class="circulo icon comisiones" href="#" title="Comisiones"></a><h2><a href="#" rel="nofollow" title="Comisiones">Comisiones</a></h2></div>
			<div><a class="circulo icon propuestas" href="#" title="Propuestas"></a><h2><a href="#" rel="nofollow" title="Propuestas">Propuestas</a></h2></div>
		</section>

		<?php if ( have_posts() ): ?>
		<h2>Latest Posts</h2>	
		<ol>
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<article>
					<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
					<?php the_content(); ?>
				</article>
			</li>
		<?php endwhile; ?>
		</ol>
		<?php else: ?>
		<h2>No posts to display</h2>
		<?php endif; ?>

		
	</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>