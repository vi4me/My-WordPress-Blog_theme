<?php
  $thumbnails_text = 'get_post_meta'( get_the_ID(), 'thumbnails_text', true);
  $thumbnails_name = 'get_post_meta'( get_the_ID(), 'thumbnails_name', true);
?>

<div class="testimonials">
  <p class="testimonial__text"><?=$thumbnails_text?></p>
  <div class="person">
    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnails_slider'); ?>" alt="">
    <p class="user-details"><b><?=$thumbnails_name?></b><br><?php the_title(); ?></p>
  </div>
</div>
