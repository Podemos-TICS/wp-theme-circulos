<?php
/**
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<section id="main_content" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
	<div class="container">
		<section id="detail">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<article class="post" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
				<h2 itemprop="headline"><?php the_title(); ?></h2>
				<div class="post_text" itemprop="description">
					<?php the_content(); ?>
				</div>
				<?php comments_template( '', true ); ?>
			</article>
			<?php endwhile; ?>
			<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/sidebar') ); ?>
		</section>
	</div>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>


