function ajax_search() {
  $search = sanitize_text_field( $_POST[ 'query' ] );

  $query = array(
      'post_type' => 'experiences',
      'meta_query'    => array(
                               array( 'key' => 'resource_description', 'value' => $search, 'compare' => 'LIKE' ),
          array( 'key' => 'title', 'value' => $search, 'compare' => 'LIKE' ),
          'relation' => 'OR'
      )
  );

  $output = '';

  // Run search query
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) : $query->the_post();

      echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';

    endwhile;

    if ( $query->max_num_pages > 1 ) {
      
      echo '<a class="see-all-results" href="' . get_site_url() . '?s=' . urlencode( $search ) . '">View all results</a>';
    }

  } else {

    echo '<p class="no-results">No results</p>';

  }

  // Reset query
  wp_reset_query();

  die();
}

add_action( 'wp_ajax_ajax_search', 'ajax_search' );
add_action( 'wp_ajax_nopriv_ajax_search', 'ajax_search' );
