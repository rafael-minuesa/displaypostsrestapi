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

// Disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get posts via REST API
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

    // Format the date.
	$fordate = date( 'jS \of F Y', strtotime( $remote_post->modified ) );

    // Get Feaured Image 
    if ( ! empty( $remote_post->featured_media ) && isset( $remote_post->_embedded ) ) {
        $thumb_url = $remote_post->_embedded->{'wp:featuredmedia'}[0]->media_details->sizes->medium->source_url;
    }
    // Get Author Name 
    if ( ! empty( $remote_post->author ) && isset( $remote_post->_embedded ) ) {
        $author_name = $remote_post->_embedded->author[0]->name;
        $author_name_url = $remote_post->_embedded->author[0]->source_url;
    }
    echo '<a href="' . esc_url( $remote_post->link ) . '" target=\"_blank\"><h3>' . esc_html( $remote_post->title->rendered ) . '</h3></a>'. esc_html( $fordate ) . ' by <a href="' . esc_url( $remote_post->$author_name_url ) . '" target=\"_blank\">' . esc_html( $author_name ) . '</a><p><a href="' . esc_url( $remote_post->link ) . '" target=\"_blank\"><img src="' . $thumb_url . '" /></a>'  .$remote_post->excerpt->rendered . '</p>';
}
		}
		
		return $allposts;
	}

// Register shortcode to be used on the site
add_shortcode( 'five_protonmail_posts', 'display_protonmail_posts' );

// https://stackoverflow.com/questions/51889908/how-to-use-wpfeaturedmedia-in-wp-rest-api-response/51890483
// https://stackoverflow.com/questions/36144270/wp-rest-api-vs-how-can-i-get-author-information-from-v2-the-author-id/40599471
