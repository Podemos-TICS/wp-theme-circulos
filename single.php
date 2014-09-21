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
					<figure itemprop="photo"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></figure>
					<?php $google_plus =  get_the_author_meta( 'google_plus' ); ?>
					<h4 rel="author"> <?php if ($google_plus) { ?><a target="_blank" title="Google Plus de <?php echo get_the_author() ; ?>" href="<?php the_author_meta( 'google_plus' ); ?>?rel=author" itemprop="contact"> de <span itemprop="name"><?php echo get_the_author() ; ?></span></a><?php  } else { ?><span itemprop="name"><?php echo get_the_author() ; ?></span><?php }  ; ?></h4>
					<?php $twitter =  get_the_author_meta( 'twitter' );
					$nombre_twitter = explode("twitter.com/", $twitter);
					if ($twitter) { ?><p class="twitter"><a target="_blank" title="Twitter de <?php echo get_the_author() ; ?>" class="icon twitter" href="<?php echo $twitter ?>">@<?php echo $nombre_twitter [1]?></a></p><?php  } ?>
					<time datetime="<?php the_time( 'Y/m/d g:i:s A' ); ?>" pubdate><?php the_date( 'j \d\e F Y'); ?></time>
				</aside>
				<?php if( $post->post_excerpt ) { ?>
				<p itemprop="alternativeHeadline" class="excerpt"><?php echo $post->post_excerpt; ?></p>
				<?php } ?>
				<div class="share">
					<span class='st_facebook_hcount' displayText='Facebook'></span>
					<span class='st_twitter_hcount' displayText='Tweet'></span>
					<span class='st_googleplus_hcount' displayText='Google +'></span>
					<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
					<span class='st_meneame_hcount' displayText='Meneame'></span>
				</div>
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