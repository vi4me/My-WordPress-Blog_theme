<?php

get_header();
?>
<section id="banner" class="falling-snow blurred-snow">

	<i></i>
  <div class="container">
	<div class="row">
	  <div class="col-md-6">
		<object id="me" type="image/svg+xml" data="<?php print(get_template_directory_uri());?>/img/cherednichenko.svg"></object>

		<?php

		  $args_title = array( 'post_type' => 'title');
		  $loop = new WP_Query( $args_title );
		  while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<?php
		  $title_text = 'get_post_meta'( get_the_ID(), 'title_text', true);
		?>

		<p class="banner-text"><?=$title_text?></p>
	  </div>
	  <div class="col-md-6 text-center">
		<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'title-img'); ?>" alt="" class="img-fluid">
	  </div>
	  <?php
		endwhile;
	  ?>
	</div>
  </div>
	<img src="<?php print(get_template_directory_uri());?>/img/wave1.png" alt="" class="bottom-img">

</section>

  <section id="services">
    <div class="container text-center">
      <h2 class="title">Дневник программиста</h2>
      <div class="row text-center">
        <?php

          $args_specialization = array( 'post_type' => 'specialization');
          $loop = new WP_Query( $args_specialization );
          while ( $loop->have_posts() ) : $loop->the_post();
        ?>
        <?php
          $specialization_text = 'get_post_meta'( get_the_ID(), 'specialization_text', true);
          $specialization_title = 'get_post_meta'( get_the_ID(), 'specialization_title', true);
        ?>
        <div class="col-md-4 services scroll-item">
          <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'specialization-img'); ?>" alt="" class="services-img img-fluid">

            <h5><?=$specialization_title?></h5>

            <p><?=$specialization_text?></p>

          <div class="wrapper">
          <a href="<?php the_permalink(); ?>" class="btn">подробнее
              <svg>
                <rect width="100%" height="100%"></rect>
              </svg>
            </a>
          </div>
        </div>

        <?php
          endwhile;
        ?>

      </div>
    </div>
  </section>

  <section class="portfolio" id="about-us">
    <div class="container">
      <div class="row portfolio__items">
        <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
        <div class="col-md-5 portfolio__item">

            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'specialization-img'); ?>" alt="" class="inline-photo show-on-scroll img-fluid">
            <h3 class="portfolio__item-title"><?php the_title(); ?></h3>
            <div class="portfolio__item-text"><?php the_excerpt(); ?></div>
            <a href="<?php the_permalink(); ?>"></a>

        </div>

          <?php
            endwhile;

            else :

            get_template_part( 'template-parts/content', 'none' );

            endif;
          ?>
        </div>
      </div>
    </div>
  </section>

  <?php july2_pagination(); ?>

  <section id="testimonials">
    <div class="container">
      <h3 class="title text-center">Отзывы</h3>
      <div class="slider">

        <?php
          global $post;
          $args = array( 'post_type' => 'testimonials',
                         'publish' => true);

          $thumbnails_slider = get_posts( $args );
          foreach( $thumbnails_slider as $post ){

            include (get_template_directory() . '/content_thumbnails.php');

          }
          wp_reset_postdata();
        ?>

      </div>
    </div>
  </section>

  <section id="social">
    <div class="container text-center">
      <h4 class="title">Контакты</h4>
      <div class="social-icons scroll-item">
        <?php

          $args_social = array( 'post_type' => 'social');
          $loop = new WP_Query( $args_social );
          while ( $loop->have_posts() ) : $loop->the_post();
        ?>

        <a href="<?php echo the_field("social_link"); ?>">
			<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'social_img'); ?>" alt="">
		</a>

        <?php
          endwhile;
        ?>
      </div>
    </div>
  </section>


<?php

get_footer();
