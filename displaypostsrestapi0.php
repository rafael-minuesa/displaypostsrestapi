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

foreach( $remote_posts as $remote_post ) {
    $thumb_full_url = '';
    $thumb_url = '';

    if ( ! empty( $remote_post->featured_media ) && isset( $remote_post->_embedded ) ) {
        $thumb_full_url = $remote_post->_embedded->{'wp:featuredmedia'}[0]->source_url;
        $thumb_url = $remote_post->_embedded->{'wp:featuredmedia'}[0]->media_details->sizes->medium->source_url;
    }

    echo '<h2>'. $remote_post->title->rendered . '</h2>' .
        '<p>' . $remote_post->excerpt->rendered . '</p>' .
        '<p>' .
            'Medium-sized thumbnail: ' . $thumb_url . '<br>' .
            'Full-sized / source: ' . $thumb_full_url .
        '</p>';
}