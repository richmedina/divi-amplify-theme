/*
Template Name: experiences-grid-layout
*/

<?php
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
    'posts_per_page' 	=> -1,
);

$exps = new WP_Query($args);
?>

<div id="main-content">
	<style>
		@media (min-width: 981px) {
			.grid-item { width: 30%; }
			.left-blog-image .et_pb_post .entry-featured-image-url {
				/*float: left;*/
				width: 100%;
				max-width: 150px;
				margin: 0 20px 30px 0;
			}
			.left-blog-image .et_pb_post {
				margin-bottom: 10px !important;
			}
		}
	</style>
	
	<div class="et_pb_section et_pb_section_0 et_section_regular">
		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_0">
				<div class="grid left-blog-image" data-packery='{ "itemSelector": ".grid-item", "gutter": 40 }'>
					<?php if ( $exps->have_posts() ) : ?>
						<?php  while ( $exps->have_posts() ) : $exps->the_post(); ?>
				 			<article id="post-<?php the_ID()?>" class="et_pb_post clearfix  grid-item">
				 				<a href="<?php the_permalink();?>" class="entry-featured-image-url"><?php the_post_thumbnail();?></a>			
								<h4 class="entry-title clearfix"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<div class="post-meta"><span class="published"><?php the_field('start_date');?></span> </div>
								<div class="post-content"><?php the_field('resource_description');?></div>
								<div class="post-content">Presented by <?php the_field('presenters_authors');?></div>
								<div class="post-content"><p><?php the_terms( get_the_ID(), 'experience_tags', 'Tagged ', ', '); ?></p>	</div>					
							</article>
						<?php endwhile; ?>
					<?php endif; ?>	
					<?php wp_reset_postdata();?>
				</div>

			</div><!-- .et_pb_column -->
		</div><!-- .et_pb_row -->
	</div>
</div>





