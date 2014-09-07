<?php
/**
 * The Template for displaying all single posts
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
			<article class="post" itemprop='blogPosts' itemscope='itemscope' itemtype='http://schema.org/BlogPosting'>
				<h2 itemprop="headline"><?php the_title(); ?></h2>
				<header>
					<figure><?php echo get_the_post_thumbnail($post_id, 'post')?></figure>
					<?php show_parent_category(); ?>
				</header>
				<aside class="post_author clearfix" itemscope itemtype="http://data-vocabulary.org/Person">
					<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
					<figure itemprop="photo"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></figure>
					<h4 rel="author"><a target="_blank" title="Google Plus de <?php echo get_the_author() ; ?>" href="<?php the_author_meta( 'google_plus' ); ?>?rel=author" itemprop="contact"> de <span itemprop="name"><?php echo get_the_author() ; ?></span></a></h4>
					<p class="twitter"><a target="_blank" title="Twitter de <?php echo get_the_author() ; ?>" class="icon twitter" href="https://twitter.com/<?php the_author_meta( 'twitter' ); ?>">@<?php the_author_meta( 'twitter' ); ?></a></p>
					<?php endif; ?>
					<time datetime="<?php the_time( 'Y/m/d g:i:s A' ); ?>" pubdate><?php the_date( 'j \d\e F Y'); ?></time>
				</aside>
				<p itemprop="alternativeHeadline" class="excerpt"><?php echo get_the_excerpt(); ?></p>
				<div class="post_text module" itemprop="text">
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