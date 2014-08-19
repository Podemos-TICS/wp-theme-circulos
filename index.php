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
		<section class="last_post">
			<h3 class="section_title"><a href="/blog" title="Últimas noticias">Últimas Noticias</a></h3>
			<?php if ( have_posts() ): ?>
			<?php $temp_query = $wp_query; query_posts('showposts=2&cat=-55'); ?>
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
				<h2 itemprop="headline"><a itemprop="url" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<aside class="post_author clearfix" itemscope itemtype="http://data-vocabulary.org/Person">
					<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
					<figure itemprop="photo"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></figure>
					<h4 rel="author"><a target="_blank" title="Google Plus de <?php echo get_the_author() ; ?>" href="<?php the_author_meta( 'google_plus' ); ?>?rel=author" itemprop="contact"> de <span itemprop="name"><?php echo get_the_author() ; ?></span></a></h4>
					<?php endif; ?>
					<time datetime="<?php the_time( 'Y/m/d g:i:s A' ); ?>" pubdate><?php the_date( 'j \d\e F Y'); ?></time>
				</aside>
				<?php the_excerpt(); ?>
			</article>
			<?php } $wp_query = $temp_query; ?>
			<?php else: ?>
			<h2>Todavía no hay contenido</h2>
			<?php endif; ?>
			<a href="/blog" class="button" title="Ver más noticias">Ver más noticias</a>
		</section>
	</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>