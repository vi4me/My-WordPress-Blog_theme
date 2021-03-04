<?php
/*
Template Name: vi
Template Post Type: post
*/
?>
<?php
get_header('main');
?>


<?php
  if (have_posts()) {
      while (have_posts()) {
          the_post();
          ?>
        <div class="container post">

          <div class="row">
            <div class="col-md-8 post__content shadow-drop-2-center">
              <h1 class="post__title"><?php the_title(); ?></h1>
              <!-- <div class="portfolio-section__time">
                <p><?php the_date(); ?></p>
                <p><?php the_time(); ?></p>
              </div> -->
              <div class="blog_category">
				<ul>
                	<li>Категория:</li>
					<li> <?php the_category(', ');?></li>
					<li class="pageviews">Читали: <?php do_action( 'pageviews' ); ?></li>
				</ul>

			  </div>
						<div class="blog_text">
							<ul>
								<li> <?php esc_html_e('Автор :', 'july2'); ?> <?php the_author_posts_link(); ?></li>

								<li>  <?php esc_html_e(' Дата:', 'july2'); ?> <?php the_time('j F Y');?> </li>
							</ul>
						</div>
              <?php echo get_the_post_thumbnail(get_the_id(), 'full', array('class' => 'img-fluid') ); ?>

              <p><?php the_content(); ?></p>
              <p class="post__content-date"><?php the_date(); ?></p>

			  <?php echo do_shortcode("[anycomment]"); ?>
            </div>


              <?php get_sidebar( 'primary' ); ?>

          </div>
        </div>

      <?php
  } // end while
} // end if
?>
<?php

get_footer()

?>
