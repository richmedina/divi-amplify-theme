/*
Template Name: experiences-grid-iso-layout
*/

<?php
wp_enqueue_script("jquery"); 

get_header();

$args = array(
    'numberposts'   	=> -1,
    'post_type'      	=> 'experience',
    'meta_key'			=> 'start_date',
    'order'   			=> 'DESC',
    'orderby'			=> 'meta_key',
    'posts_per_page' 	=> -1,
);

$exps = new WP_Query($args);
?>

<div id="main-content">
	<style>
		@media (min-width: 981px) {
			.grid-item { 
				width: 30%;
				padding: 0 20px 0 20px;
			}
			.grid-item--width2 { width: 50%; }
			.grid-contain .et_pb_post .entry-featured-image-url {
				/*float: left;*/
				width: 100%;
				max-width: 150px;
				margin: 0 20px 30px 0;
			}
			.grid-contain .et_pb_post {
				margin-bottom: 10px !important;
			}
		}
	</style>

	<div class="et_pb_section et_pb_section_0 et_section_regular">
		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough">
				<div class="button-group filter-button-group">
					<button class="btn-filter" data-filter="*">Show All</button>
					<button class="btn-filter" data-filter=".webinar">Webinar</button>
					<button class="btn-filter" data-filter=".demo">demo</button>
					<button class="btn-filter" data-filter=".video_conference">video_conference</button>
					<button class="btn-filter" data-filter=".online_course">online_course</button>
					<button class="btn-filter" data-filter=".informal_session">informal_session</button>
					<button class="btn-filter" data-filter=".face_to_face">face_to_face</button>
				</div>
			</div><!-- .et_pb_column -->
		</div><!-- .et_pb_row -->

		<div class="et_pb_row et_pb_row_1">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough">
				<div class="grid">
				<!-- <div class="grid grid-contain" data-packery='{ "itemSelector": ".grid-item", "gutter": 40 }'> -->
					<?php if ( $exps->have_posts() ) : ?>
						<?php  while ( $exps->have_posts() ) : $exps->the_post(); ?>

				 			<article id="post-<?php the_ID()?>" class="et_pb_post grid-item <?php the_field('pd_resource')?>">
				 				<a href="<?php the_permalink();?>" class="entry-featured-image-url"><?php the_post_thumbnail();?></a>			
								<h4 class="entry-title clearfix"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h4>
								<div class="post-meta"><span class="published"><?php the_field('start_date');?> <?php print_r(the_field('pd_resource')) ?></span> </div>
								<div class="post-content"><?php the_field('resource_description');?></div>
								<div class="post-content">Presented by <?php the_field('presenters_authors');?></div>
								<div class="post-content"><p><?php the_terms( get_the_ID(), 'experience_tags', 'Tagged as ', ', '); ?></p>	</div>	
							</article>
						<?php endwhile; ?>
					<?php endif; ?>	
					<?php wp_reset_postdata();?>
				</div>
			</div><!-- .et_pb_column -->
		</div><!-- .et_pb_row -->
	</div>
<script type="text/javascript">
jQuery(function($) {
	$grid = $('.grid').isotope({
	  // options
	  itemSelector: '.grid-item',
	  // layoutMode: 'fitRows'
	});

	// filter items on button click
	$('.filter-button-group').on( 'click', 'button', function() {
	  var filterValue = $(this).attr('data-filter');
	  $grid.isotope({ filter: filterValue });
	});
});	
</script>
</div>





