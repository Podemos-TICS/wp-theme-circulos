<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

		<?php if ( have_posts() ): ?>

		<?php if ( is_day() ) : ?>
		<h2>Publicaciones: <?php echo  get_the_date( 'D M Y' ); ?></h2>							
		<?php elseif ( is_month() ) : ?>
		<h2>Publicaciones: <?php echo  get_the_date( 'M Y' ); ?></h2>	
		<?php elseif ( is_year() ) : ?>
		<h2>Publicaciones: <?php echo  get_the_date( 'Y' ); ?></h2>								
		<?php else : ?>
		<h2>Publicaciones</h2>	
		<?php endif; ?>

		<section class="last_post">
		<h3 class="section_title">Resultados para '<?php echo get_search_query(); ?>'</a></h3>
		<?php while ( have_posts() ) : the_post(); ?>
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
		<?php endwhile; ?>
		</section>
		<?php else: ?>
		<h3 class="section_title">No hay contenido</a></h3>
		<?php endif; ?>

	</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>