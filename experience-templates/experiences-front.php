<?php
/*
Template Name: experiences-front
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
    'posts_per_page' 	=> 3,
);

$upcoming_posts = new WP_Query($args);

$args2 = array(
    'numberposts'   	=> -1,
    'post_type'      	=> 'experience',
    'meta_key'       	=> 'start_date',
    'meta_value'   		=> date( "Y-m-d" ),
    'meta_compare'		=> '<',
    'order'   			=> 'DESC',
    'orderby'			=> 'modified',
    'offset'			=> 0,
    'posts_per_page' 	=> 3,
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
.left-blog-image .et_pb_post .entry-featured-image-url {
	float: left;
	width: 100%;
	max-width: 150px;
	margin: 0px 20px 30px 0;
}
.card-event-row {
	/*Horizontal card wrapper with two columns:  */
	display: grid;
	grid-template-columns: 48px minmax(230px, 1fr); 
	grid-gap: 10px;
	/*       border-bottom: 6px solid lightgrey; */
	padding: 10px;
	grid-auto-flow: dense;
}
.card-event-row .card{
	/*min-height: 100%;*/
	display: grid;
	grid-template-rows: auto 1fr auto;
	grid-gap: 5px;		
}
.card-feature {
  min-height: 100%;
  display: grid;
  grid-template-rows: auto 1fr auto;
  grid-gap: 10px;
}

.date-block {float: left; max-width: 48px; width: 48px; height: 80px; border: 1px solid #ecece9; text-align: center; font-weight: bold; margin-right: 10px;}
.date-block-top {background-color: #cc3333; color: white; padding: 5px; font-size: 1.0em; text-transform: uppercase;}
.date-block-bottom {font-size: 2.0em; padding-top: 10px;}
/*.label {padding:5px; font-weight:800; font-size:80%; text-transform:uppercase; max-width: 64px; width: 64px;}*/
/*.lbl-blu {background-color:#0099cc; color:#ffffff}*/
/*.lbl-red {background-color:#cc3333; color:#ffffff}*/
@media (max-width: 640px) {
  .card-event-row {
    /*grid-template-columns: 1fr;*/
  }
  /*.card-wrap-row img {
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    max-height: 200px;
  }
  .card-wrap-row.flip img {
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    max-height: 200px;
  }
  .card-wrap-row.flip {
    grid-template-columns: 1fr;
  }*/
  .card-event-row .date-block {
  	/*grid-row: 1;*/
  }
}
			</style>
		</div>
	</div> <!-- .et_pb_code -->
	<div class="et_pb_section et_pb_section_0 et_section_regular">
		<div class="et_pb_row et_pb_row_0">
			<h1 class="front-title">Professional Learning Experiences </h1>
			<h2 class="front-title">in World Language Education</h2>
		</div>						
		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_2_5 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough">
				
				<?php if ( $featured->have_posts() ) : ?>
					<h1>Next Up</h1>
					<?php  while ( $featured->have_posts() ) : $featured->the_post(); ?>
			 			<article id="post-<?php the_ID()?>" class="et_pb_post clearfix post-<?php the_ID()?> has-post-thumbnail hentry card-feature">
			 				<header>
				 				<a href="<?php the_permalink();?>" class="entry-featured-image-url"><?php the_post_thumbnail();?></a>
								
								<div class="date-block">
									<?php 
										$s = get_field('start_date');
										$d = getdate(strtotime($s));
										$day = $d['mday'];
										$mon = substr($d['month'], 0, 3);
										echo "<div class='date-block-top'>{$mon}</div><div class='date-block-bottom'>{$day}</div>";
									?>
								</div>
								<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
								<div>
				            		<span class="label lbl-blu"><?php the_field('pd_resource');?></span>

					                <?php         
					                  $people = get_field('presenters__facilitators_relation');
					                  if( $people ) {
					                    echo " by ";
					                    $len = count($people);
					                    foreach( $people as $idx => $p) {
					                      $name = $p->post_title;
					                      $affiliation = get_field('affiliation', $p->ID);
					                      $position = get_field('position', $p->ID);
					                      $link = get_permalink($p->ID);
					                      echo "<span><a href='{$link}'>{$name}</a>";
					                      if ($idx === $len - 2) echo " & ";
					                      else if ($idx < $len -1) echo ", ";
					                      echo "</span>";
					                    }
					                  }
					                ?>
				            	</div>
			            	</header>

							<div>
								<?php 
									$blurb = get_field('resource_description');
									$trim = wp_trim_words($blurb, 60, ' ...');
									echo $trim;							
								?>								
							</div>
							<div>
								<div class=""><?php the_terms( get_the_ID(), 'series', '<i>Part of </i> ', ', '); ?></div>
        						<div class="tags"><?php the_terms( get_the_ID(), 'experience_tags','', ''); ?></div>
							</div>				
						</article>
					<?php endwhile; ?>
				<?php endif; ?>		   
				<?php wp_reset_postdata();?>
				
			</div> <!-- .et_pb_column -->

			<div class="et_pb_column et_pb_column_3_5 et_pb_column_1 et_pb_css_mix_blend_mode_passthrough left-blog-image">
				
				<?php if ( $upcoming_posts->have_posts() ) : ?>
					<h1>Coming Soon</h1>
					<?php  while ( $upcoming_posts->have_posts() ) : $upcoming_posts->the_post(); ?>	
			 			<article id="post-<?php the_ID()?>" class=" card-event-row">
			 				<!-- COL 1 -->
							<div class="date-block">
								<?php 
									$s = get_field('start_date');
									$d = getdate(strtotime($s));
									$day = $d['mday'];
									$mon = substr($d['month'], 0, 3);
									echo "<div class='date-block-top'>{$mon}</div><div class='date-block-bottom'>{$day}</div>";
								?>
							</div>							
							<!-- COL 2 -->
							<div class="card">
								<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
				                
								<div>
				            		<span class="label lbl-blu"><?php the_field('pd_resource');?></span>

					                <?php         
					                  $people = get_field('presenters__facilitators_relation');
					                  if( $people ) {
					                    echo " by ";
					                    $len = count($people);
					                    foreach( $people as $idx => $p) {
					                      $name = $p->post_title;
					                      $affiliation = get_field('affiliation', $p->ID);
					                      $position = get_field('position', $p->ID);
					                      $link = get_permalink($p->ID);
					                      echo "<span><a href='{$link}'>{$name}</a>";
					                      if ($idx === $len - 2) echo " & ";
					                      else if ($idx < $len -1) echo ", ";
					                      echo "</span>";
					                    }
					                  }
					                ?>
				            	</div>

								<div>
									<?php 
										$blurb = get_field('resource_description');
										$trim = wp_trim_words($blurb, 18, ' ...');
										echo $trim;							
									?>								
								</div>
								<div>
									<div class="tag-series"><?php the_terms( get_the_ID(), 'series', '<i>Part of </i> ', ', '); ?></div>
            						<div class="tags"><?php the_terms( get_the_ID(), 'experience_tags','', ''); ?></div>
								</div>
							</div> 
						</article>
					<?php endwhile; ?>
				<?php else: ?>
					<p>Nothing coming up</p>
				<?php endif; ?>		   
				<?php wp_reset_postdata();?>
			</div> <!-- .et_pb_column -->
		</div> <!-- .et_pb_row -->

		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_3_5 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough left-blog-image">
				<h2>Recently Updated</h2>
				<?php if ( $past_posts->have_posts() ) : ?>
					<?php  while ( $past_posts->have_posts() ) : $past_posts->the_post(); ?>	
						<article id="post-<?php the_ID()?>" class="et_pb_post clearfix post-<?php the_ID()?> has-post-thumbnail hentry card-wrap-row">
				            
				            <aside class="card-wrap-sidebar">
				        		<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?></a>        
				      		</aside>

					      	<div class="card">
						        <header class="card-header">

						          <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
						          <div class="">Updated <?php echo the_modified_date();?></div>

						          <div class="card-meta">
						              <a href="<?php the_field('url_website'); ?>"><span class="label lbl-blu pd_resource_label"><?php the_field('pd_resource');?></span></a>
						                <?php         
						                  $people = get_field('presenters__facilitators_relation');
						                  if( $people ) {
						                    echo " by ";
						                    $len = count($people);
						                    foreach( $people as $idx => $p) {
						                      $name = $p->post_title;
						                      $affiliation = get_field('affiliation', $p->ID);
						                      $position = get_field('position', $p->ID);
						                      $link = get_permalink($p->ID);
						                      echo "<span><a href='{$link}'>{$name}</a>";
						                      if ($idx === $len - 2) echo " & ";
						                      else if ($idx < $len -1) echo ", ";
						                      echo "</span>";
						                    }
						                  }
						                ?>
						          </div>
						        </header>
					        
						        <div class='card-body'>         
						            <?php 
						            	$blurb = get_field('resource_description');
						            	$trim = wp_trim_words($blurb, 20, ' ...');
						            	echo "<p>{$trim}</p>";            
						        	?>
						        </div>

						        <footer class="card-footer">
						          <div class="tag-series"><?php the_terms( get_the_ID(), 'series', 'In ', ''); ?></div>
						          <div class="tags"><?php the_terms( get_the_ID(), 'experience_tags','', ''); ?></div>
						        </footer>
					      	</div>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>		   
				<?php wp_reset_postdata();?>
			</div> <!-- .et_pb_column -->

			<div class="et_pb_column et_pb_column_2_5 et_pb_column_1 et_pb_css_mix_blend_mode_passthrough">
				<h2>Recently Featured</h2>
				<?php if ( $featured2->have_posts() ) : ?>
					<?php  while ( $featured2->have_posts() ) : $featured2->the_post(); ?>
			 			<article id="post-<?php the_ID()?>" class="et_pb_post clearfix post-<?php the_ID()?> experience type-experience status-publish has-post-thumbnail hentry">
			 				<a href="<?php the_permalink();?>" class="entry-featured-image-url"><?php the_post_thumbnail();?></a>			
							<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<div class="post-content"><span class="published"><?php the_field('start_date');?></span> </div>
							<div>
			                <?php         
			                  $people = get_field('presenters__facilitators_relation');
			                  if( $people ) {
			                    echo " by ";
			                    $len = count($people);
			                    foreach( $people as $idx => $p) {
			                      $name = $p->post_title;
			                      $affiliation = get_field('affiliation', $p->ID);
			                      $position = get_field('position', $p->ID);
			                      $link = get_permalink($p->ID);
			                      echo "<span><a href='{$link}'>{$name}</a>";
			                      if ($idx === $len - 2) echo " & ";
			                      else if ($idx < $len -1) echo ", ";
			                      echo "</span>";
			                    }
			                  }
			                ?>
			            </div>
							<div class="post-content"><span class="label lbl-blu"><?php the_field('pd_resource');?></span>
							<div class="post-content"><?php the_field('resource_description');?></div>
							<div class="post-content"><p><?php the_terms( get_the_ID(), 'experience_tags', '', ', '); ?></p>	</div>
						</article>
					<?php endwhile; ?>
				<?php endif; ?>		   
				<?php wp_reset_postdata();?>
				
			</div> <!-- .et_pb_column -->
		</div> <!-- .et_pb_row -->
		<div class="et_pb_row et_pb_row_0">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough">
				<h2>Browse by Descriptor</h2>
				<?php 
					$xtags = get_terms( array(
						'taxonomy' 	=> 'experience_tags',
						'hide_empty'=> true,
						'orderby' 	=> 'count',
						'order'		=> 'DESC'
					)); 
				?>
				<ul>
					<?php foreach( $xtags as $term ) : ?>
						<li><a href="<?php print_r(esc_url( get_term_link( $term ))); ?>"> <?php print_r($term->name); ?></a> (<?php print_r($term->count) ?>)</li>
					<?php endforeach; ?>
				</ul>
			</div><!-- .et_pb_column -->
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough">
				<h2>Browse by Series</h2>
				<?php 
					$xtags = get_terms( array(
						'taxonomy' 	=> 'series',
						'hide_empty'=> true,
						'orderby' 	=> 'count',
						'order'		=> 'DESC'
					)); 
				?>
				<ul>
					<?php foreach( $xtags as $term ) : ?>
						<li><a href="<?php print_r(esc_url( get_term_link( $term ))); ?>"> <?php print_r($term->name); ?></a> (<?php print_r($term->count) ?>)</li>
					<?php endforeach; ?>
				</ul>
			</div><!-- .et_pb_column -->
		</div><!-- .et_pb_row -->




	</div> <!-- .et_pb_section -->
</div> <!-- #main-content -->
<?php get_footer(); 
