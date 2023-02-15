<?php
/*
Plugin Name: WP REST API Button
Description: Adds a button in the post editor that opens the current post's REST API endpoint in a new tab. Supports custom post types.
Version: 1.0.0
Author: Kaelan Smith
*/

function open_post_endpoint_button_enqueue_scripts() {
  wp_enqueue_script(
      'open-post-endpoint-button',
      plugins_url( 'build/index.js', __FILE__ ),
      array( 'wp-blocks', 'wp-element', 'wp-data', 'wp-edit-post' ),
      '1.2.0',
      true
  );
  wp_add_inline_script(
    'open-post-endpoint-button',
    'document.currentScript.setAttribute("type", "module");'
  );
}

function open_post_endpoint_button_content_type( $content_type, $file ) {
  if ( 'build/index.js' === $file ) {
    return 'application/javascript';
  }

  return $content_type;
}

add_action( 'enqueue_block_editor_assets', 'open_post_endpoint_button_enqueue_scripts' );
add_filter( 'wp_check_filetype_and_ext', 'open_post_endpoint_button_content_type', 10, 3 );
