<?php
/*
Template Name: portfolio
Template Post Type: specialization
*/
?>
<?php

get_header('main');
?>

<div class="container-fluid">
	<div class="box-wrap row">
	  <?php

		  $args_portfolio = array( 'post_type' => 'portfolio');
		  $loop = new WP_Query( $args_portfolio );
		  while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<?php
		  $portfolio_text = 'get_post_meta'( get_the_ID(), 'portfolio_text', true);
		  $portfolio_title = 'get_post_meta'( get_the_ID(), 'portfolio_title', true);
		  $portfolio_link = 'get_post_meta'( get_the_ID(), 'portfolio_link', true);
		?>
	  <div class="col-md-5 col-lg-3 box">

			<div class="box-item__info-title"><?=$portfolio_title?></div>
			<div class="box-item__info-text"><?=$portfolio_text?></div>
			<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'portfolio_img'); ?>" alt="" class="img-fluid">
			<a href="<?=$portfolio_link?>" target="_blank"></a>
	  </div>
	  <?php
		endwhile;
	  ?>
	</div>
</div>

<?php

get_footer();
