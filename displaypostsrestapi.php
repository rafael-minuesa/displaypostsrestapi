<?php
/**
 * Plugin Name:  Display 5 Posts using REST API
 * Description:  Display the latest 5 posts from https://protonmail.com/blog/
 * Plugin URI:   https://proton.prowoos.com/
 * Author:       Rafael Minuesa
 * Author URI:   https://www.linkedin.com/in/rafaelminuesa/
 * Version:      1.1
 * Text Domain:  displaypostsrestapi
 * License:      GPL v2 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package displaypostsrestapi
 */

// Disable direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get posts via REST API.
 */
 function display_protonmail_posts() {

	// Initialize variable.
    $allposts = '';
    
    // End point of ProtonMail Blog and filter the result to limit the display to 5 posts.
    $response = wp_remote_get( add_query_arg( array(
    'per_page' => 5,
     ), 'https://protonmail.com/blog/wp-json/wp/v2/posts?_embed' ) 
);

if( !is_wp_error( $response ) && $response['response']['code'] == 200 ) {

   $remote_posts = json_decode( $response['body'] ); 
   foreach( $remote_posts as $remote_post ) {
    $thumb_full_url = '';
    $thumb_url = '';

    // Featured image URL can be retrieved like this:
    if ( ! empty( $remote_post->featured_media ) && isset( $remote_post->_embedded ) ) {
        $thumb_full_url = $remote_post->_embedded->{'wp:featuredmedia'}[0]->source_url;
        $thumb_url = $remote_post->_embedded->{'wp:featuredmedia'}[0]->media_details->sizes->medium->source_url;
    }

    // Get the URL of a specific thumbnail size:
    echo '<a href="' . esc_url( $remote_post->link ) . '" target=\"_blank\"><h3>' . esc_html( $remote_post->title->rendered ) . '</h3></a>  ' .
        '<p><a href="' . esc_url( $remote_post->link ) . '" target=\"_blank\"><img src="' . $thumb_url . '" /></a>' .$remote_post->excerpt->rendered . '</p>' .
    }
		}
		
		return $allposts;
	}

// Register shortcode to be used on the site.
add_shortcode( 'five_protonmail_posts', 'display_protonmail_posts' );
