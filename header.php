<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zineshelf
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

<?php /*
<script src="https://use.typekit.net/ibb5tom.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
*/ ?>

	<?php
		wp_head();

		/*	Here's where we add the typography for that specific book.
		*/
		if( $post->nb_type ) {
			$the_kits = $post->nb_type;
			//	this may be a list of kits
			if ( strpos($the_kits, ',') ) {
				$all_kits = explode(',', $the_kits);
				foreach( $all_kits as $kit ) {
					echo add_typekit( $kit );
					echo $kit;
				}
			}
			else echo add_typekit($post->nb_type);
		}
		if( $post->nb_stylekit ) {
			wp_enqueue_style('typekit-styles', get_template_directory_uri() . '/assets/css/'.$post->nb_stylekit.'.css', array(), filemtime(get_template_directory() . '/assets/css/'.$post->nb_stylekit.'.css'), false);
		}
	?>
</head>

<?php
$page_classes = '';
if( is_singular() ) $page_classes .= 'is-singular';
?>

<body <?php body_class( $page_classes ); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'zineshelf' ); ?></a>

	<a class="skip-link screen-reader-text" href="#bookpage-nav">Skip to page nav</a>


	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$zineshelf_description = get_bloginfo( 'description', 'display' );
			if ( $zineshelf_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $zineshelf_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'zineshelf' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
