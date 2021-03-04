<?php

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>

	<section id="nav-bar">
	    <nav class="navbar navbar-expand-lg navbar-light bg-light">
	      <a class="navbar-brand" href="#"><?php the_custom_logo(); ?></a>
		  <?php get_template_part('template-parts/breadcrumbs'); ?>

	    </nav>
	  </section>
	<section id="banner">
	  <div class="container">
		<div class="row">
		  <div class="col-md-6">
			<object id="me" type="image/svg+xml" data="<?php print(get_template_directory_uri());?>/img/cherednichenko.svg"></object>


		  </div>

		</div>
	  </div>
	  <img src="<?php print(get_template_directory_uri());?>/img/wave1.png" alt="" class="bottom-img">
	</section>
