<?php
function divi__child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'divi__child_theme_enqueue_styles' );

/* CUSTOM FUNCTIONS */

/** DIVI Custom Queries **/
/**
	Documentation: https://diviplugins.com/documentation/divi-filtergrid/custom-query/
	Other properties to distinguish one module instance from another:
		$props['module_id'] ==> CSS ID
		$props['admin_label'] ==> ADMIN Label
		$props['module_class'] ==> CSS Class
		module_id is what can be set for the CSS ID in the module instance settings.
*/
function dp_dfg_custom_query_function($query, $props) {
   	if (isset($props['admin_label']) && $props['admin_label'] === 'APL: Recently Updated') {
        return array(
            'post_type' => 'experience',
			'meta_query' 	=> array(
				array(
				 'key'     	=> 'start_date',
				 'value'   	=> date( "Y-m-d" ),
				 'compare' 	=> '<',
				 'type'    	=> 'DATE'
				)
			),
		    'order'   			=> 'DESC',
		    'orderby'			=> 'modified',
    		'posts_per_page' 	=> 3,
        );
    } elseif (isset($props['admin_label']) && $props['admin_label'] === 'APL: Recently Featured') {
        return array(
            'post_type' => 'experience',
			'meta_query' 	=> array(
				array(
				 'key'     	=> 'start_date',
				 'value'   	=> date( "Y-m-d" ),
				 'compare' 	=> '<',
				 'type'    	=> 'DATE'
				)
			),
		    'order'   			=> 'DESC',
		    'orderby'			=> 'start_date',
		    'offset'			=> 0,
		    'posts_per_page' 	=> 1,
        );    	
    }
}
add_filter('dpdfg_custom_query_args', 'dp_dfg_custom_query_function', 10, 2);

/**
	Documentation: https://diviplugins.com/documentation/divi-filtergrid/custom-content/
	Other properties to distinguish one module instance from another:
		$props['module_id'] ==> CSS ID
		$props['admin_label'] ==> ADMIN Label
		$props['module_class'] ==> CSS Class
		module_id is what can be set for the CSS ID in the module instance settings.
*/
function dpdfg_after_read_more($content, $props) {
    if (isset($props['admin_label']) && $props['admin_label'] === 'APL: Recently Updated') {
        $output = "";
        $img = get_the_post_thumbnail();
        $title = get_the_title();
        $exp_excerpt = get_post_meta( get_the_ID(), 'resource_description', true );
        $blurb = wp_trim_words($exp_excerpt, 12, ' ...');
        $updated = get_the_modified_date();
        $pdtype = get_field('pd_resource');

        $pdtype_str = "";
        if ($pdtype) { $pdtype_str = "label lbl-blu pd_resource_label";}
        
		$people = get_field('presenters__facilitators_relation');
		$people_str = "";
		if( $people ) {
			$people_str .= " by ";
			$len = count($people);
			foreach( $people as $idx => $p) {
			  $name = $p->post_title;
			  $affiliation = get_field('affiliation', $p->ID);
			  $position = get_field('position', $p->ID);
			  $link = get_permalink($p->ID);
			  $people_str .= "<span><a href='{$link}'>{$name}</a>";
			  if ($idx === $len - 2) $people_str .= " & ";
			  else if ($idx < $len -1) $people_str .= ", ";
			  $people_str .= "</span>";
			}
		}

		$single = "";
		if (!has_post_thumbnail()) { $single = ".single"; }

		$series_tags = get_the_term_list( get_the_ID(), 'series', 'In ', ''); 
		$tags = get_the_term_list( get_the_ID(), 'experience_tags','', '');


        $output .= "<div class='card-wrap-row{$single}'>";
	        $output .= "<div>{$img}</div>";
	        $output .= "<div class='card'>";
		        $output .= 	"<h4 class='card-title'>{$title}</h4>";
		        $output .= 	"<div><span class='{$pdtype_str}'>{$pdtype}</span>{$people_str}</div>";
		        $output .= 	"<div class=''>Updated {$updated}</div>";
		        $output .= 	"<div>{$blurb}</div>";
		    	$output .= "<div class='tag-series'>{$series_tags}</div>";
	        	$output .= "<div class='tags'>{$tags}</div>";
	        $output .= "</div>";
        $output .= "</div>";  

        return $output;

    }  elseif (isset($props['admin_label']) && $props['admin_label'] === 'APL: Recently Featured') {
    	$output = "";

		$people = get_field('presenters__facilitators_relation');
		$people_str = "";
		if( $people ) {
			$people_str .= " by ";
			$len = count($people);
			foreach( $people as $idx => $p) {
			  $name = $p->post_title;
			  $affiliation = get_field('affiliation', $p->ID);
			  $position = get_field('position', $p->ID);
			  $link = get_permalink($p->ID);
			  $people_str .= "<span><a href='{$link}'>{$name}</a>";
			  if ($idx === $len - 2) $people_str .= " & ";
			  else if ($idx < $len -1) $people_str .= ", ";
			  $people_str .= "</span>";
			}
		}

        $exp_excerpt = get_post_meta( get_the_ID(), 'resource_description', true );
        $blurb = wp_trim_words($exp_excerpt, 20, ' ...');
        $start = get_field('start_date');
        $updated = get_the_modified_date();
        $pdtype = get_field('pd_resource');
    	$pdtype_str = "";
        if ($pdtype) { $pdtype_str = "label lbl-blu pd_resource_label";}

		$series_tags = get_the_term_list( get_the_ID(), 'series', 'In ', ''); 
		$tags = get_the_term_list( get_the_ID(), 'experience_tags','', '');


    	$output .= 	"<div><span class='{$pdtype_str}'>{$pdtype}</span>{$people_str}</div>";
    	$output .= "<div>{$start}</div>";
    	$output .= "<div>{$blurb}</div>";
    	$output .= "<div class='tag-series'>{$series_tags}</div>";
	    $output .= "<div class='tags'>{$tags}</div>";
	    $output .= "<div style='font-size: 0.8em; text-align: right;'>Updated {$updated}</div>";
    	return $output;
    }
}
add_filter('dpdfg_after_read_more', 'dpdfg_after_read_more', 10, 2);


/** END DIVI Custom Queries **/

/** ACF Hooks **/
//Before post is saved...
add_action('acf/save_post', 'my_acf_save_post', 5);
function my_acf_save_post( $post_id ) {

    // Get previous values.
    $prev_values = get_fields( $post_id );

    // Get submitted values.
    $values = $_POST['acf'];
    // Check if a specific value was updated.
    if( isset($_POST['acf']['field_5f2b41ffcc785']) ) {
        $tags = $_POST['acf']['field_5f2b41ffcc785'];
        add_post_meta( $post_id, 'terms', 'red', true );

        // echo '<p>Your sponsored by ' . $_POST['acf']['field_5f2b41ffcc785'] . '</p>';
    }

}
// After post is saved ... add the image from the form to the featured image of the post.
add_action( 'acf/save_post', 'amp_save_image_field_to_featured_image');
function amp_save_image_field_to_featured_image( $post_id ) {

	// Bail if not logged in or not able to post
	if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
		return;
	}

	// Bail early if no ACF data
	if( empty($_POST['acf']) ) {
		return;
	}

	// ACF image field key
	$image = $_POST['acf']['field_5f2b4242cc786'];

	// Bail if image field is empty
	if ( empty($image) ) {
		return;
	}

	// Add the value which is the image ID to the _thumbnail_id meta data for the current post
	add_post_meta( $post_id, '_thumbnail_id', $image );

}

/** END ACF Hooks **/


