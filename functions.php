<?php
/**
 * zineshelf functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zineshelf
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'zineshelf_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function zineshelf_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on zineshelf, use a find and replace
		 * to change 'zineshelf' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'zineshelf', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'zineshelf' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'zineshelf_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'zineshelf_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zineshelf_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zineshelf_content_width', 640 );
}
add_action( 'after_setup_theme', 'zineshelf_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zineshelf_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'zineshelf' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'zineshelf' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zineshelf_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zineshelf_scripts() {
	wp_enqueue_style( 'zineshelf-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'zineshelf-style', 'rtl', 'replace' );

	wp_enqueue_script( 'zineshelf-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'zineshelf-pageflip', get_template_directory_uri() . '/js/pageflip.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'js-cookie', get_template_directory_uri() . '/js/js.cookie.js', array('jquery'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zineshelf_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/*

function return_post_as_pages($content='') {
  if (empty($content)) {
    global $post;
    $content = $post->post_content;
  }
  if (empty($content)) {
    return false;
  }
  $content = str_replace("\n<!--nextpage-->\n", '<!--nextpage-->', $content);
  $content = str_replace("\n<!--nextpage-->", '<!--nextpage-->', $content);
  $content = str_replace("<!--nextpage-->\n", '<!--nextpage-->', $content);
  $pages = explode('<!--nextpage-->', $content);
//  if (isset($pages[$n])) {
    return $pages;
//  }
}

function format_post_pages($pages) {

var_dump($pages);

	$formatted_content = '';
	foreach ($pages as &$page) {
    $formatted_content .= '<div>'.$page.'</div>';
	}
	return $formatted_content;
}


add_filter( 'the_content', 'filter_the_content_in_the_main_loop', 1 );

function filter_the_content_in_the_main_loop( $content ) {

	$paginated_content = return_post_as_pages( $content );

    // Check if we're inside the main loop in a single Post.
    if ( is_singular() && in_the_loop() && is_main_query() ) {
        $content = format_post_pages($paginated_content);
    }

    return $content;
}


// https://stackoverflow.com/questions/59565369/wordpress-content-pagination-filter-breaks-first-paragraph-if-modifided
add_filter( 'content_pagination', 'wrap_pages');
function wrap_pages( $pages ) {
     // Nothing to do without content pagination
    if( count( $pages ) <= 1 )
        return $pages;
    // Number of pages per chunk
    $pages_per_chunk = 3; // <-- Edit to your needs!
    // Create chunks of pages
    $chunks = array_chunk( $pages, $pages_per_chunk );
    // Merge pages in each chunk
    $merged = [];
    foreach( (array) $chunks as $chunk )
        $merged[] = join( '', $chunk );
    return $merged;
}
*/

// https://stackoverflow.com/questions/59565369/wordpress-content-pagination-filter-breaks-first-paragraph-if-modifided
add_filter( 'content_pagination', 'wrap_pages');

function wrap_pages( $pages ) {

	global $post;

	//	make Cover
	if ( has_post_thumbnail( $post->ID ) ) {
		$cover_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	 }

	 $number_of_pages = count( $pages );
	 $number_of_pages += 2; // add two extra ones for the cover page and end page

	 $number_of_pages = ceil( $number_of_pages / 2 );

	$merged = [];
   // Nothing to do without content pagination
  if( count( $pages ) <= 1 )
      return $pages;
  // Number of pages per chunk

	$count = 1;
	$book = '<style> :root { --pages: ' . $number_of_pages . '; ' . $post->nb_vars . ' } </style><div class="book-page book-page-1" style="--h: 1"><div class="side side--front"><img src="'.$cover_url[0].'" /></div>';

	$page_number = 2;

  foreach( (array) $pages as $page ) {
		if ($count % 2) {
				$book .= '<div class="side side--back">'.$page.'<b class="page-number">'.$count.'</b></div>';
				$book .= '</div><div class="book-page book-page-'.$page_number.'" style="--h: '.$page_number.'">';
				$page_number++;
		}
		else {
			$book .= '<div class="side side--front"><b class="shine"></b>'.$page.'<b class="page-number">'.$count.'</b></div>';
			/*
				.shine is the result of a very strange bug I discovered where, if the .shine
				element is a direct child of book-page and has both z-index:1 and mix-blend-mode:overlay,
				it throws off the page stacking so the first page in the book sits on top of all
				the other ones.

			*/
		}
		$count++;

	}

	if ($count % 2) $book .= '<div class="side side--back"></div>';


	$categories_list = get_the_category_list( esc_html__( ', ', 'zineshelf' ) );
	$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'zineshelf' ) );

	$number_of_pages = '<p>Pages: '.count( $pages ).'</p>';
	$pub_date = '<p>Date: '.get_the_date(  ).'</p>';
	$intro_page = '<div class="intro">'.get_the_title().$number_of_pages.$pub_date.$categories_list.$tags_list.'</div>';
	$close_page = '<div class="the-end" style="--h: '.($count).'"><p>Le Fin</p></div>';
	$notebook_dimensions = $post->nb_dimensions;

  $merged[] = '<div class="notebook closed size--'.$notebook_dimensions.'">'.$intro_page.$book.'</div>'.$close_page;
	// return value must be an array
  return $merged;
}


function add_typekit($code) {
	$type_codes = array(
    "besley" => "<style> @import url('https://fonts.googleapis.com/css2?family=Besley:ital,wght@0,400;0,800;1,400;1,800&display=swap'); </style>",
    "cutive-mono" => "<style> @import url('https://fonts.googleapis.com/css2?family=Cutive+Mono&display=swap'); </style>"
	);
	return $type_codes[$code];
}

// [bartag foo="foo-value"]
function bartag_func( $atts ) {
	$a = shortcode_atts( array(
		'foo' => 'something',
	), $atts );

	return "foo = {$a['foo']}";
}
add_shortcode( 'bartag', 'bartag_func' );


function my_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}

add_filter( 'get_the_archive_title', 'my_theme_archive_title' );
