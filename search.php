<?php
/*
Template Name: search.php
Customized for pdlang.
*/
get_header();


?>
<div id="main-content">
	
	<div class="wrap-rows">
		<h1><?php single_term_title( '', true ); ?></h1>
	
	<?php while ( have_posts() ) : the_post(); ?>
		<?php global $post; ?>
		<article class="card-wrap-row flip clearfix">
		  
		  <div class="card">
		    <header class="card-header">
		      <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		      <div class="card-meta">
		      	<div> </div>
		      	<?php 
		      	if ($post->post_type === 'presenter') {
					$args = array(
					    'numberposts'  	=> -1,
					    'post_type'		=> 'experience',
					    'posts_per_page'=> -1,
					    'meta_query'   	=> array( 
					    	array(
					    		'key'	 =>'presenters__facilitators_relation',
					    		'value'	 =>'"'. $post->ID .'"', 
					    		'compare'=>'LIKE',
					    	)
					    ),
					);
					$related_exps = get_posts($args);
					if ( $related_exps ) {	    
						echo "<ul style='list-unstyled'><li>Related Experiences: </li>";
					    foreach ( $related_exps as $p ) {
							echo "<li><a href='" . get_permalink($p->ID) . "'>" . $p->post_title ."</a></li>";
						}
						echo "</ul>";
					}		      		
		      	} 
		      	?>
				<div>
					<a href="<?php the_field('url_website'); ?>"><span class="label lbl-blu pd_resource_label"><?php the_field('pd_resource');?></span></a>
				<?php					
					$people = get_field('presenters__authors_relation');
					if( $people ) {
						echo " by ";
						$len = count($people);
					    foreach( $people as $idx => $p) {
					    	$name = get_field('full_name', $p->ID);
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
		      </div>
		    </header>
		    
		    <div class='card-body'>		    	
		    	<?php 
					$blurb = get_field('resource_description');
					$trim = wp_trim_words($blurb, 100, ' ...');
					echo "<p>{$trim}</p>";						
				?>
		    </div>

		    <footer class="card-footer">
		    	<div class="tag-series"><?php the_terms( get_the_ID(), 'series', 'In ', ', '); ?></div>
		    	<div class="tags"><?php the_terms( get_the_ID(), 'experience_tags','', ''); ?></div>
		    </footer>
		  </div>

		  <aside class="card-wrap-sidebar">
		  	<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?></a>		 	      	
	      	<?php
				$date = get_field('start_date', $post->ID);
			?>
			<div class="date-meta">
				<span><?php echo $date; ?><span>
				<span class="mod-date">Updated <?php echo the_modified_date();?></span>
			</div>				
				
		  </aside>

		</article>
	<?php endwhile; ?>
</div> <!-- #main-content -->
<?php

get_footer();
