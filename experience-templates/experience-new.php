<?php 
/*
Template Name: new-experience
*/

acf_form_head(); 
get_header();

if ( ! ( is_user_logged_in()|| current_user_can('publish_posts') ) ) {
	echo '<p>You must be a registered author to post.</p>';
	return;
}
?>

<div id="main-content">
		
	<h1><?php the_title(); ?></h1>
		
    <?php
    	$experience_form = array(
	        'post_id'       => 'new_post',
	        'new_post'      => array(
	            'post_type'     => 'experience',
	            'post_status'   => 'publish',
	        ),
	        'post_title' => true,
	        'label_placement' => 'left',
	        'field_groups'    => array(5), // Create post field group ID(s)
	        'form' => true,
	        // 'return' => '%post_url%',
	        'submit_value'  => 'Add New Experience'
    	); 
		acf_form($experience_form);
    ?>		
	
</div> <!-- #main-content -->

<?php get_footer();
