<?php
/**
 * Plugin Name:  Display 5 Posts using REST API
 * Description:  Display the latest 5 posts from https://example.com/blog/
 * Plugin URI:   https://prowoos.com/
 * Author:       Rafael Minuesa
 * Author URI:   https://www.linkedin.com/in/rafaelminuesa/
 * Version:      1.1
 * Text Domain:  displaypostsrestapi
 * License:      GPL v2 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package displaypostsrestapi
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Get posts via REST API.
 */
function display_blog_posts() {

	// Initialize variable.
	$allposts = '';
	
	// End point of Blog and filter the result to limit the display to 5 posts.
	$response = wp_remote_get( 'https://example.com/blog/wp-json/wp/v2/posts?per_page=5' );

	// Exit if error.
	if ( is_wp_error( $response ) ) {
		return;
	}

	// Get the body.
	$posts = json_decode( wp_remote_retrieve_body( $response ) );

	// Exit if nothing is returned.
	if ( empty( $posts ) ) {
		return;
	}

	// If there are posts.
	if ( ! empty( $posts ) ) {

		// For each post.
		foreach ( $posts as $post ) {

			// Use print_r($post); to get the details of the post and all available fields
			// Format the date.
			$fordate = date( 'n/j/Y', strtotime( $post->modified ) );

			// Show a linked title and post date.
			$allposts .= '<a href="' . esc_url( $post->link ) . '" target=\"_blank\">' . esc_html( $post->title->rendered ) . '</a>  ' . esc_html( $fordate ) . '<br />';
		}
		
		return $allposts;
	}

}
// Register shortcode to be used on the site.
add_shortcode( 'five_blog_posts', 'display_blog_posts' );
