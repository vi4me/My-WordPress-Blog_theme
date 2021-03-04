<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<section id="nav-bar">
	    <nav class="navbar navbar-expand-lg navbar-light bg-light">
	      <a class="navbar-brand" href="#"><?php the_custom_logo(); ?></a>
				<?php get_template_part('template-parts/breadcrumbs'); ?>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	        <i class="fa fa-bars" aria-hidden="true"></i>
	      </button>

				<div class="collapse navbar-collapse" id="navbarNav">

					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
	          	<a class="nav-link" href="#banner">Главная</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#services">Специализация</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="#about-us">Блог</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="#testimonials">Отзывы</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="#social">Контакты</a>
						</li>
					</ul>
				</div>
	    </nav>
	  </section>


		
