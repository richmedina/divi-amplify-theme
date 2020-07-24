<?php
/*
Template Name: calendar
*/
get_header();

$args = array(
    'numberposts'     => -1,
    'post_type'       => 'experience',
    'meta_key'        => 'start_date',
    // 'meta_value'       => date( "Y-m-d" ),
    // 'meta_compare'     => '>=',
    'order'         => 'DESC',
    'orderby'     => 'start_date',
    'offset'      => 0,
    'posts_per_page'  => 100,
);
$post_stream = new WP_Query($args);

?>
<div id="main-content">
  
  
  <div class="wrap-rows">
    <h1>Full Calendar</h1>
  
  <?php while ( $post_stream->have_posts() ) : $post_stream->the_post(); ?>
    <article class="card-wrap-row flip clearfix">
      
      <div class="card">
        <header class="card-header">
          <div class="date-block" style="display: inline-block">
            <?php 
              $s = get_field('start_date');
              $d = getdate(strtotime($s));
              $day = $d['mday'];
              $mon = substr($d['month'], 0, 3);
              $year = substr($d['year'], 0, 4);
              
              if (strtotime(date( "Y-m-d" )) > strtotime($s)) {
                echo "<div class='date-block-top past_date'>{$mon}</div><div class='date-block-bottom'>{$day}</div><div class='date-block-footer'>{$year}</div>";
              } else {
                echo "<div class='date-block-top'>{$mon}</div><div class='date-block-bottom'>{$day}</div><div class='date-block-footer'>{$year}</div>";
              }
            ?>
          </div>
          
          <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
          
          <div class="card-meta">
            <div>
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
            <div><sub class="mod-date">Updated <?php echo the_modified_date();?></sub></div>
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
      </aside>

    </article>
  <?php endwhile; ?>
  <?php wp_reset_postdata();?>
</div> <!-- #main-content -->
<?php

get_footer();
