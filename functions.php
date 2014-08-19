<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */


	/* Required external files
	================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* Theme specific settings
	================================================== */
	
	add_theme_support('post-thumbnails');
	
	register_nav_menus(array('primary' => 'Primary Navigation'));

	/* Actions and Filters
	================================================== */
	
	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* Scripts
	================================================== */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/css/main.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}	

	/* Comments
	================================================== */

	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
	 
	/* Excerpt Class
	================================================== */

	function add_excerpt_class( $excerpt )
	{
	    $excerpt = str_replace( "<p", "<p itemprop=\"alternativeHeadline\" class=\"excerpt\"", $excerpt );
	    return $excerpt;
	}
	 
	add_filter( "the_excerpt", "add_excerpt_class" );

	/* Get THUMB URL
	================================================== */
	
	function get_image_url(){
		global $post;
		$imagen = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		$ruta_imagen = $imagen[0];
		echo $ruta_imagen;
	}

	/* Custom Search Form
	================================================== */
	
	function custom_search_form( $form ) {
	    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	    <input type="text" class="field" value="' . get_search_query() . '" name="s" id="s" placeholder="Buscar"/>
	    <input type="submit" class="submit" id="searchsubmit" value="'. esc_attr__( 'S' ) .'"/>
	    </form>';

	    return $form;
	}

	add_filter( 'get_search_form', 'custom_search_form' );

	/* Custom Image Size
	================================================== */
		
	add_image_size( 'last_post', 466, 254 ); // Hard Crop Mode
	add_image_size( 'post', 629, 344 ); // Hard Crop Mode

	/* Sidebar
	================================================== */
	
	function yourblog_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'r12themes' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'r12themes' ),
		'before_widget' => '<aside class="widget">
		',
		'after_widget' => '</aside>
		',
		'before_title' => '<h3 class="widget_title">
		',
		'after_title' => '</h3>
		',
		) );
	}
	add_action( 'widgets_init', 'yourblog_widgets_init' );

	/* Add Category Class to Body in Single Post
	================================================== */

	add_filter('body_class','add_category_to_single');
	function add_category_to_single($classes, $class) {
		if (is_single() ) {
			global $post;
			foreach((get_the_category($post->ID)) as $category) {
				// add category slug to the $classes array
				$classes[] = $category->category_nicename;
			}
		}
		// return the $classes array
		return $classes;
	}







	/* Twitter URL user area
	================================================== */

	function fb_add_custom_user_profile_fields( $user ) {
?>
	<h3><?php _e('Información extra', 'your_textdomain'); ?></h3>
	
	<table class="form-table">
		<tr>
			<th>
				<label for="twitter"><?php _e('Twitter', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Introduce tu usuario de twitter.', 'your_textdomain'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="google_plus"><?php _e('Google Plus', 'your_textdomain'); ?>
			</label></th>
			<td>
				<input type="text" name="google_plus" id="google_plus" value="<?php echo esc_attr( get_the_author_meta( 'google_plus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Introduce tu url de autor de Google Plus.', 'your_textdomain'); ?></span>
			</td>
		</tr>
	</table>

<?php }

function fb_save_custom_user_profile_fields( $user_id ) {
	
	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;
	
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'google_plus', $_POST['google_plus'] );
}

add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );
