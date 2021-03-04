<?php

?>
<section id="footer">
    <img class="footer-img" src="<?php print(get_template_directory_uri());?>/img/wave2.png" alt="">
    <div class="container">
      <div class="row">
        <div class="col-md-5 footer-box">
          <img src="<?php print(get_template_directory_uri());?>/img/logo.png" alt="">
          <?php

            $args_title = array( 'post_type' => 'title');
            $loop = new WP_Query( $args_title );
            while ( $loop->have_posts() ) : $loop->the_post();
          ?>
          <?php
            $title_text = 'get_post_meta'( get_the_ID(), 'title_text', true);
          ?>
          <p><?=$title_text?></p>
          <?php
            endwhile;
          ?>
        </div>
        <div class="col-md-3 footer-box">
          <p><b>СВЯЗАТЬСЯ</b></p>

          <?php

            $args_connection = array( 'post_type' => 'connection');
            $loop = new WP_Query( $args_connection );
            while ( $loop->have_posts() ) : $loop->the_post();
          ?>
          <?php
            $address = 'get_post_meta'( get_the_ID(), 'address', true);
            $phone = 'get_post_meta'( get_the_ID(), 'phone', true);
            $web_address = 'get_post_meta'( get_the_ID(), 'web_address', true);
          ?>

          <p><i class="fa fa-map-marker"></i><?=$address?></p>
          <p><i class="fa fa-phone"></i><?=$phone?></p>
          <p><i class="fa fa-envelope-o"></i><?=$web_address?></p>

          <?php
            endwhile;
          ?>
        </div>
		<div class="col-md-4 footer-box">
			<form action="<?php print(get_template_directory_uri());?>/telegram.php" method="POST">
				<div class="form-group blog_form">
					<input type="text" class="form-control" name="user_name" placeholder="Ваше имя">
					<input type="text" class="form-control" name="user_phone" placeholder="Телефон">
					<input type="text" class="form-control" name="user_email" placeholder="Email">
				</div>

				<div class="search_btn-3">
					<button class="btn btn-primary" type="submit"><?php esc_html_e('Отправить', 'july2'); ?>  					  </button>
				</div>
			</form>
		</div>

      </div>
      <hr>
      <div class="copyright">Website created by ViMe</div>
    </div>
  </section>


<?php wp_footer(); ?>

</body>
</html>
