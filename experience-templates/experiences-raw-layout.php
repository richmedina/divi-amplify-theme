<?php
/*
Template Name: experiences-raw-no-layout
*/

/*
resource_title
resource_descrition
presenters_authors
affiliation
position
pd_resource
target_audience_
language
start_date
end_date
url_website
materials
featured
instructions
title
description
image
uploadmaterial
presenter
full_name
affiliation
position
bio
*/

wp_enqueue_script("jquery"); 

get_header();

$args = array(
    'numberposts'   	=> -1,
    'post_type'      	=> 'experience',
    'meta_key'       	=> 'start_date',
    'meta_value'   		=> date( "Y-m-d" ),
    'meta_compare' 		=> '>=',
    'order'   			=> 'ASC',
    'orderby'			=> 'start_date',
    'offset'			=> 1,
    'posts_per_page' 	=> 5,
);

$upcoming_posts = new WP_Query($args);

$args2 = array(
    'numberposts'   	=> -1,
    'post_type'      	=> 'experience',
    'meta_key'       	=> 'start_date',
    'meta_value'   		=> date( "Y-m-d" ),
    'meta_compare'		=> '<',
    'order'   			=> 'DESC',
    'orderby'			=> 'start_date',
    'offset'			=> 1,
    'posts_per_page' 	=> 10,
);
$past_posts = new WP_Query($args2);

$args3 = array(
     'numberposts'   	=> -1,
    'post_type'      	=> 'experience',
    'meta_key'       	=> 'start_date',
    'meta_value'   		=> date( "Y-m-d" ),
    'meta_compare' 		=> '>=',
    'order'   			=> 'ASC',
    'orderby'			=> 'start_date',
    'offset'			=> 0,
    'posts_per_page' 	=> 1,
);

$featured = new WP_Query($args3);

$args4 = array(
    'numberposts'   	=> -1,
    'post_type'      	=> 'experience',
    'meta_key'       	=> 'start_date',
    'meta_value'   		=> date( "Y-m-d" ),
    'meta_compare'		=> '<',
    'order'   			=> 'DESC',
    'orderby'			=> 'start_date',
    'offset'			=> 0,
    'posts_per_page' 	=> 1,
);

$featured2 = new WP_Query($args4);

?>	

<div id="main-content">
<div class="et_pb_module et_pb_code et_pb_code_0">				
	<div class="et_pb_code_inner">
		<style>
			@media (min-width: 981px) {
				.left-blog-image .et_pb_post .entry-featured-image-url {
					float: left;
					width: 100%;
					max-width: 150px;
					margin: 0 20px 30px 0;
				}
				.left-blog-image .et_pb_post {
					margin-bottom: 20px !important;
				}
			}
		</style>
	</div>
</div> <!-- .et_pb_code -->
	<div class="et_pb_section et_pb_section_0 et_section_regular">							
		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_2_5 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough">
				<h2>Featured</h2>
				<?php if ( $featured->have_posts() ) : ?>
					<?php  while ( $featured->have_posts() ) : $featured->the_post(); ?>
			 			<article id="post-<?php the_ID()?>" class="et_pb_post clearfix post-<?php the_ID()?> experience type-experience status-publish has-post-thumbnail hentry">
			 				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a>				
							<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<p class="post-meta"><span class="published"><?php the_field('start_date');?></span> </p>
							<div class="post-content"><?php the_field('resource_description');?></div>							
						</article>
					<?php endwhile; ?>
				<?php endif; ?>		   
				<?php wp_reset_postdata();?>
				
			</div> <!-- .et_pb_column -->

			<div class="et_pb_column et_pb_column_3_5 et_pb_column_1 et_pb_css_mix_blend_mode_passthrough">
				<h2>Upcoming</h2>
				<?php if ( $upcoming_posts->have_posts() ) : ?>
					<?php  while ( $upcoming_posts->have_posts() ) : $upcoming_posts->the_post(); ?>	
			 			<article id="post-<?php the_ID()?>" class="et_pb_post clearfix post-<?php the_ID()?> experience type-experience status-publish has-post-thumbnail hentry"> 
							<h4 class="entry-title"><a href="<?php the_permalink();?>"><?php the_field('resource_title');?></a></h4>
							<p class="post-meta"><span class="published"><?php the_field('start_date');?></span> </p>
							<div class="post-content"><?php the_field('resource_description');?></div>	
						</article>
					<?php endwhile; ?>
				<?php else: ?>
					<p>Nothing coming up</p>
				<?php endif; ?>		   
				<?php wp_reset_postdata();?>
			</div> <!-- .et_pb_column -->
		</div> <!-- .et_pb_row -->

		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_1_2 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough">
				<h2>Past Events</h2>
				<?php if ( $past_posts->have_posts() ) : ?>
					<?php  while ( $past_posts->have_posts() ) : $past_posts->the_post(); ?>	
						<article id="post-<?php the_ID()?>" class="et_pb_post clearfix post-<?php the_ID()?> experience type-experience status-publish has-post-thumbnail hentry"> 
							<h4 class="entry-title"><a href="<?php the_permalink();?>"><?php the_field('resource_title');?></a></h4>
							<p class="post-meta"><span class="published"><?php the_field('start_date');?></span> </p>
							<div class="post-content"></div>	
						</article>
					<?php endwhile; ?>
				<?php endif; ?>		   
				<?php wp_reset_postdata();?>
			</div> <!-- .et_pb_column -->
			<div class="et_pb_column et_pb_column_1_2 et_pb_column_1 et_pb_css_mix_blend_mode_passthrough">
				<h2>Recently Featured</h2>
				<?php if ( $featured2->have_posts() ) : ?>
					<?php  while ( $featured2->have_posts() ) : $featured2->the_post(); ?>	
						<article id="post-<?php the_ID()?>" class="et_pb_post clearfix post-<?php the_ID()?> experience type-experience status-publish has-post-thumbnail hentry"> 
							<h4 class="entry-title"><a href="<?php the_permalink();?>"><?php the_field('resource_title');?></a></h4>
							<p class="post-meta"><span class="published"><?php the_field('start_date');?></span> </p>
							<div class="post-content"></div>	
						</article>
					<?php endwhile; ?>
				<?php endif; ?>		   
				<?php wp_reset_postdata();?>
			</div> <!-- .et_pb_column -->
		</div> <!-- .et_pb_row -->
	</div> <!-- .et_pb_section -->
</div> <!-- #main-content -->
<?php get_footer(); 