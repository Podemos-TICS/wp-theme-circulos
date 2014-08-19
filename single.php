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

<section id="post_detail" itemscope='itemscope' itemtype='http://schema.org/Blog'>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="container">
			<article class="post" itemprop='blogPosts' itemscope='itemscope' itemtype='http://schema.org/BlogPosting'>
				<h2 itemprop="headline"><?php the_title(); ?></h2>
				<header>
					<figure><?php echo get_the_post_thumbnail($post_id, 'post')?></figure>
					<?php $parentscategory ="";
					foreach((get_the_category()) as $category) {
					if ($category->category_parent == 0) {
					$parentscategory .= '<a class="category" rel="category" href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
					}	
					}
					echo substr($parentscategory,0,-2); ?>
				</header>
				<aside class="post_author clearfix" itemscope itemtype="http://data-vocabulary.org/Person">
					<?php if ( get_the_author_meta( 'twitter' ) ) : ?>
					<figure itemprop="photo"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></figure>
					<h4 rel="author"><a target="_blank" title="Google Plus de <?php echo get_the_author() ; ?>" href="<?php the_author_meta( 'google_plus' ); ?>?rel=author" itemprop="contact"> de <span itemprop="name"><?php echo get_the_author() ; ?></span></a></h4>
					<p class="twitter"><a target="_blank" title="Twitter de <?php echo get_the_author() ; ?>" class="icon twitter" href="https://twitter.com/<?php the_author_meta( 'twitter' ); ?>">@<?php the_author_meta( 'twitter' ); ?></a></p>
					<?php endif; ?>
					<time datetime="<?php the_time( 'Y/m/d g:i:s A' ); ?>" pubdate><?php the_date( 'j \d\e F Y'); ?></time>
				</aside>
				<div class="social_share module"></div>
				<div class="excerpt module"><?php  the_excerpt(); ?></div>				
				<div class="post_text module" itemprop="text">
					<?php the_content(); ?>	
				</div>
				<aside class="post_tags module" itemprop="keywords">
					<h3 class="module_title">Tags</h3>
					<?php echo get_the_tag_list(); ?> 
				</aside>	
				<?php comments_template( '', true ); ?>
			</article>
			<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/sidebar') ); ?>		
		</div>
	<?php endwhile; ?>
</section>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>