<?php

require get_template_directory() . '/inc/class-july2-recent-post-widget.php';
require get_template_directory() . '/inc/class-july2-subscribe-form-widget.php';

function july2_register_widget() {
	register_widget( 'July2_Widget_Recent_Posts' );
	register_widget( 'July2_Widget_Subscribe' );
}

add_action( 'widgets_init', 'july2_register_widget' );


function july2_setup() {

	load_theme_textdomain('july2'
);

	add_theme_support('title-tag');

	add_theme_support('custom-logo', array(
		'height' => 40,
		'width' => 60,
		'flex-height' => true
	));

	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(730,446);

  add_image_size( 'july2-recent-post', 80, 80, true );

	add_theme_support('html5', array(
		'search_form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption'
	));

	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'gallery'
	));
}

add_action('after_setup_theme', 'july2_setup');



function july2_scripts() {

  wp_enqueue_style( 'july2-slick',
                    get_template_directory_uri() . '/slick/slick.css');
  wp_enqueue_style( 'july2-slick_theme',
                    get_template_directory_uri() . '/slick/slick-theme.css');
  wp_enqueue_style( 'july2-bootstrap',
                    'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
  wp_enqueue_style( 'july2-bootstrap_font',
                    'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  wp_enqueue_style( 'july2-main', get_stylesheet_uri() );



  wp_enqueue_script( 'july2-vivus',
    				'https://cdnjs.cloudflare.com/ajax/libs/vivus/0.4.5/vivus.min.js',
    				array(),
    				'',
    				true
  );
  wp_enqueue_script( 'july2-jquery',
    'https://code.jquery.com/jquery-1.11.0.min.js',
    array(),
    '5.4.2',
    true
  );
  wp_enqueue_script( 'july2-bootstrap_js',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
    array(),
    '',
    true
  );
  wp_enqueue_script( 'july2-slick_js',
    get_template_directory_uri() . '/slick/slick.min.js',
    array('jquery'),
    '',
    true
  );

  wp_enqueue_script( 'main_js',
    get_template_directory_uri() . '/js/main.js',
    array('july2-slick_js', 'july2-vivus'),
    '',
    true
  );

}
add_action( 'wp_enqueue_scripts', 'july2_scripts' );

// ----------------------breadcrumb

function july2_the_breadcrumb(){
	global $post;
	if(!is_home()){
	   echo '<li><a href="'.site_url().'"><i class="fa fa-home" aria-hidden="true"></i>'. esc_html__('Главная', 'july2'). '</a></li> <li> </li>';
		if(is_single()){ // posts
		// the_category(', ');
		echo " <li> / </li> ";
		echo '<li>';
			the_title();
		echo '</li>';
		}
		elseif (is_page()) { // pages
			if ($post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . '<li> / </li> ';
			}
			// echo the_title();
		}

		elseif (is_search()) { // search pages
			echo esc_html__('Search results "', 'july2') . get_search_query() . '"';
		}

		elseif (is_day()) { // archive (days)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li> ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> <li> / </li> ';
			echo get_the_time('d');
		}
		elseif (is_month()) { // archive (months)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li>';
			echo get_the_time('F');
		}
		elseif (is_year()) { // archive (years)
			echo get_the_time('Y');
		}
		elseif (is_author()) { // authors
			global $author;
			$userdata = get_userdata($author);
			echo '<li>Posted ' . $userdata->display_name . '</li>';
		} elseif (is_404()) { // if page not found
			echo '<li>'. esc_html__('Error 404', 'july2'). '</li>';
		}

		if (get_query_var('paged')) // number of page
			echo ' (' . get_query_var('paged').'- page)';

	} else { // home
	   $pageNum=(get_query_var('paged')) ? get_query_var('paged') : 1;
	   if($pageNum>1)
	      echo '<li><a href="'.site_url().'"><i class="fa fa-home" aria-hidden="true"></i>'. esc_html__('Home', 'july2'). '</a></li> <li> / </li> <li>'.$pageNum.'- page</li>';
	   else
	      echo '<li><i class="fa fa-home" aria-hidden="true"></i>'. esc_html__('Home', 'july2'). '</li>';
	}
}

// ---------------------------------Pagination

function july2_pagination( $args = array() ) {

    $defaults = array(
        'range'           => 4,
        'custom_query'    => FALSE,
        'previous_string' => esc_html__( 'Предыдущие посты', 'july2' ),
        'next_string'     => esc_html__( 'Следующие посты', 'july2' ),
        'before_output'   => '<div class="next_page"><ul class="page-numbers">',
        'after_output'    => '</ul></div>'
    );

    $args = wp_parse_args(
        $args,
        apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
    );

    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = @$GLOBALS['wp_query'];
    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );

    if ( $count <= 1 )
        return FALSE;

    if ( !$page )
        $page = 1;

    if ( $count > $args['range'] ) {
        if ( $page <= $args['range'] ) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ( $page >= ($count - $ceil) ) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }

    $echo = '';
    $previous = intval($page) - 1;
    $previous = esc_attr( get_pagenum_link($previous) );

    if ( $previous && (1 != $page) )
        $echo .= '<li><a href="' . $previous . '" class="page-numbers" title="' . esc_html__( 'previous', 'july2') . '">' . $args['previous_string'] . '</a></li>';

    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ($page == $i) {
                $echo .= '<li class="active"><span class="page-numbers current">' . str_pad( (int)$i, 1, '0', STR_PAD_LEFT ) . '</span></li>';
            } else {
                $echo .= sprintf( '<li><a href="%s" class="page-numbers">%2d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }

    $next = intval($page) + 1;
    $next = esc_attr( get_pagenum_link($next) );
    if ($next && ($count != $page) )
        $echo .= '<li><a href="' . $next . '" class="page-numbers" title="' . esc_html__( 'next', 'july2') . '">' . $args['next_string'] . '</a></li>';

    if ( isset($echo) )
        echo $args['before_output'] . $echo . $args['after_output'];
}



add_action('init', 'register_title');
function register_title(){

    $ctpArgs_title = array(
		'labels'             => array(
			'name'               => 'Описание',
			'singular_name'      => 'Описание',
			'add_new'            => 'Добавить Описание',
			'add_new_item'       => 'Добавить новое Описание',
			'edit_item'          => 'Редактировать Описание',
			'new_item'           => 'Новое Описание',
			'view_item'          => 'Посмотреть Описание',
			'search_items'       => 'Найти Описание',
			'not_found'          => 'Описание не найдено',
			'not_found_in_trash' => 'В корзине Описание не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Описание'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 4,
    'menu_icon'          => 'dashicons-id',
		'supports'           => array('title', 'thumbnail')
	);
  register_post_type('title', $ctpArgs_title);
}
add_theme_support( 'title-img' );



add_action('init', 'register_specialization');
function register_specialization(){

    $ctpArgs_specialization = array(
		'labels'             => array(
			'name'               => 'Специализация',
			'singular_name'      => 'Специализация',
			'add_new'            => 'Добавить Специализацию',
			'add_new_item'       => 'Добавить новую Специализацию',
			'edit_item'          => 'Редактировать Специализацию',
			'new_item'           => 'Новая Специализация',
			'view_item'          => 'Посмотреть Специализацию',
			'search_items'       => 'Найти Специализацию',
			'not_found'          => 'Специализация не найдено',
			'not_found_in_trash' => 'В корзине Специализации не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Специализация'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
    'menu_icon'          => 'dashicons-editor-ol',
		'supports'           => array('title', 'thumbnail')
	);
  register_post_type('specialization', $ctpArgs_specialization);
}
add_theme_support( 'specialization-img' );




add_action('init', 'register_post_works');
function register_post_works(){

    $ctpArgs_works = array(
		'labels'             => array(
			'name'               => 'Мои работы',
			'singular_name'      => 'Моя работа',
			'add_new'            => 'Добавить Мою работу',
			'add_new_item'       => 'Добавить новую Мою работу',
			'edit_item'          => 'Редактировать Мою работу',
			'new_item'           => 'Новая Моя работа',
			'view_item'          => 'Посмотреть Мою работу',
			'search_items'       => 'Найти Мою работу',
			'not_found'          => 'Мои работы не найдено',
			'not_found_in_trash' => 'В корзине Моих работ не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Мои работы'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
    'menu_icon'          => 'dashicons-awards',
		'supports'           => array('title','thumbnail')
	);
  register_post_type('my_works', $ctpArgs_works);
}

add_theme_support( 'works-thumbnails' );


add_action('init', 'register_post_types');
function register_post_types(){

    $ctpArgs = array(
		'labels'             => array(
			'name'               => 'Отзывы',
			'singular_name'      => 'Отзыв',
			'add_new'            => 'Добавить Отзыв',
			'add_new_item'       => 'Добавить новый Отзыв',
			'edit_item'          => 'Редактировать Отзыв',
			'new_item'           => 'Новый Отзыв',
			'view_item'          => 'Посмотреть Отзыв',
			'search_items'       => 'Найти Отзыв',
			'not_found'          =>  'Отзывов не найдено',
			'not_found_in_trash' => 'В корзине Отзывов не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Отзывы'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
    'menu_icon'          => 'dashicons-format-quote',
		'supports'           => array('title','thumbnail')
	);
  register_post_type('testimonials', $ctpArgs);
}


add_action('init', 'register_post_social');
function register_post_social(){

    $ctpArgs_social = array(
		'labels'             => array(
			'name'               => 'Ссылки',
			'singular_name'      => 'Ссылка',
			'add_new'            => 'Добавить Ссылку',
			'add_new_item'       => 'Добавить новую Ссылку',
			'edit_item'          => 'Редактировать Ссылку',
			'new_item'           => 'Новая Ссылка',
			'view_item'          => 'Посмотреть Ссылку',
			'search_items'       => 'Найти Ссылку',
			'not_found'          =>  'Ссылку не найдено',
			'not_found_in_trash' => 'В корзине Ссылки не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Ссылки'


		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
    'menu_icon'          => 'dashicons-redo',
		'supports'           => array('title','thumbnail')
	);
  register_post_type('social', $ctpArgs_social);
}

add_theme_support( 'post-social' );
if (function_exists('add_image_size') ){
  add_image_size('social_img', 60, 60, true);
}


add_action('init', 'register_connection');
function register_connection(){

    $ctpArgs_connection = array(
		'labels'             => array(
			'name'               => 'Контакт',
			'singular_name'      => 'Контакт',
			'add_new'            => 'Добавить Контакт',
			'add_new_item'       => 'Добавить новый Контакт',
			'edit_item'          => 'Редактировать Контакт',
			'new_item'           => 'Новый Контакт',
			'view_item'          => 'Посмотреть Контакт',
			'search_items'       => 'Найти Контакт',
			'not_found'          => 'Контакт не найден',
			'not_found_in_trash' => 'В корзине Контактов не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Контакт'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
    'menu_icon'          => 'dashicons-location',
		'supports'           => array('title')
	);
  register_post_type('connection', $ctpArgs_connection);
}

add_action('init', 'register_portfolio');
function register_portfolio(){

    $ctpArgs_portfolio = array(
		'labels'             => array(
			'name'               => 'portfolio',
			'singular_name'      => 'portfolio',
			'add_new'            => 'Добавить portfolio',
			'add_new_item'       => 'Добавить новый portfolio',
			'edit_item'          => 'Редактировать portfolio',
			'new_item'           => 'Новый portfolio',
			'view_item'          => 'Посмотреть portfolio',
			'search_items'       => 'Найти portfolio',
			'not_found'          => 'portfolio не найден',
			'not_found_in_trash' => 'В корзине portfolio не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'portfolio'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 7,
    'menu_icon'          => 'dashicons-location',
		'supports'           => array('title', 'thumbnail')
	);
  register_post_type('portfolio', $ctpArgs_portfolio);
}
add_theme_support( 'portfolio' );
if (function_exists('add_image_size') ){
  add_image_size('portfolio_img', 994, 585, true);
}

//---------------------------- widget

/**
 * Add a sidebar.
 */
function july2_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Main Sidebar', 'july2' ),
        'id'            => 'primary',
        'description'   => esc_html__( 'Widgets in this area will be shown on all posts and pages.', 'july2' ),
        'before_widget' => '<div id="%1$s" class="sidebar_wrap %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="side_bar_heading"><h6>',
        'after_title'   => '</h6></div>',
    ));
}
add_action( 'widgets_init', 'july2_widgets_init' );

function july2_widget_categories($args) {
	$walker = new Walker_Categories_july2();
	$args = array_merge($args, array('walker' => $walker));

	return $args;
}

add_action( 'widgets_init', 'july2_widgets_init' );

add_filter('widget_categories_args', 'july2_widget_categories');

class Walker_Categories_july2 extends Walker_Category {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
	 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
	 *                       value is 'list'. See wp_list_categories(). Default empty array.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		parent::start_lvl( $output, $depth, $args);
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Used to append additional content. Passed by reference.
	 * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
	 * @param array  $args   Optional. An array of arguments. Will only append content if style argument
	 *                       value is 'list'. See wp_list_categories(). Default empty array.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		parent::end_lvl( $output, $depth, $args);
	}

	/**
	 * Starts the element output.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @see Walker::start_el()
	 *
	 * @param string $output   Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
	 * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
	 * @param int    $id       Optional. ID of the current category. Default 0.
	 */
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters(
			'list_cats',
			esc_attr( $category->name ),
			$category
		);

		// Don't generate an element if the category name is empty.
		if ( ! $cat_name ) {
			return;
		}

		$link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
		if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
			/**
			 * Filters the category description for display.
			 *
			 * @since 1.2.0
			 *
			 * @param string $description Category description.
			 * @param object $category    Category object.
			 */
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		}

		$link .= '><i class="fa fa-folder-open-o" aria-hidden="true"></i>';
		$link .= $cat_name;
		if ( ! empty( $args['show_count'] ) ) {
			$link .= '<span>' . number_format_i18n( $category->count ) . '</span>';
		}

		$link .= '</a>';

		if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
			$link .= ' ';

			if ( empty( $args['feed_image'] ) ) {
				$link .= '(';
			}

			$link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';

			if ( empty( $args['feed'] ) ) {
				$alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
			} else {
				$alt = ' alt="' . $args['feed'] . '"';
				$name = $args['feed'];
				$link .= empty( $args['title'] ) ? '' : $args['title'];
			}

			$link .= '>';

			if ( empty( $args['feed_image'] ) ) {
				$link .= $name;
			} else {
				$link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
			}
			$link .= '</a>';

			if ( empty( $args['feed_image'] ) ) {
				$link .= ')';
			}
		}


		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$css_classes = array(
				'cat-item',
				'cat-item-' . $category->term_id,
			);

			if ( ! empty( $args['current_category'] ) ) {
				// 'current_category' can be an array, so we use `get_terms()`.
				$_current_terms = get_terms( $category->taxonomy, array(
					'include' => $args['current_category'],
					'hide_empty' => false,
				) );

				foreach ( $_current_terms as $_current_term ) {
					if ( $category->term_id == $_current_term->term_id ) {
						$css_classes[] = 'current-cat';
					} elseif ( $category->term_id == $_current_term->parent ) {
						$css_classes[] = 'current-cat-parent';
					}
					while ( $_current_term->parent ) {
						if ( $category->term_id == $_current_term->parent ) {
							$css_classes[] =  'current-cat-ancestor';
							break;
						}
						$_current_term = get_term( $_current_term->parent, $category->taxonomy );
					}
				}
			}

			/**
			 * Filters the list of CSS classes to include with each category in the list.
			 *
			 * @since 4.2.0
			 *
			 * @see wp_list_categories()
			 *
			 * @param array  $css_classes An array of CSS classes to be applied to each list item.
			 * @param object $category    Category data object.
			 * @param int    $depth       Depth of page, used for padding.
			 * @param array  $args        An array of wp_list_categories() arguments.
			 */
			$css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

			$output .=  ' class="' . $css_classes . '"';
			$output .= ">$link\n";
		} elseif ( isset( $args['separator'] ) ) {
			$output .= "\t$link" . $args['separator'] . "\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page   Not used.
	 * @param int    $depth  Optional. Depth of category. Not used.
	 * @param array  $args   Optional. An array of arguments. Only uses 'list' for whether should append
	 *                       to output. See wp_list_categories(). Default empty array.
	 */
	public function end_el( &$output, $page, $depth = 0, $args = array() ) {
		parent::end_el( $output, $page, $depth, $args );
	}
}

// ------------------------------tag_cloud

function july2_tag_cloud($args) {

	$args['format'] = 'list';
	$args['smallest'] = '14';
	$args['unit'] = 'px';

	return $args;
}

add_filter('widget_tag_cloud_args', 'july2_tag_cloud');

/*------------ДЛЯ ВЫВОДА КОЛИЧЕСТВА ПРОСМОТРОВ СТРАНИЦЫ--------------*/
add_action( 'after_setup_theme', function() {
    add_theme_support( 'pageviews' );
});

function wpdocs_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_excerpt_length', 30 );

function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
