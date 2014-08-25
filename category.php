<?php
/**
 * Search results page
 * 
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="main_content" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
	<div class="container">
		<section class="last_post">
			<?php if ( have_posts() ): ?>
				<h3 class="section_title">Publicaciones de <?php echo single_cat_title( '', false ); ?></h3>
			<?php while ( have_posts() ) : the_post(); ?>
			<article itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
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
				<time class="icon hora" datetime="<?php the_time( 'F j, Y' ); ?>" pubdate><?php the_date(); ?></time>
				<?php the_excerpt(); ?>
			</article>
			<?php endwhile; ?>
			<?php else: ?>
				<h3 class="section_title">No hay publicaciones en <?php echo single_cat_title( '', false ); ?></h3>
			<h2>No posts to display in <?php echo single_cat_title( '', false ); ?></h2>
			<?php endif; ?>
			<a href="/blog" class="button" title="Ver más noticias">Ver más noticias</a>
		</section>
	</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>