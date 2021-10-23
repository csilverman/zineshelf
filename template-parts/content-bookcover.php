<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zineshelf
 */

?>

<?php
	if ( $post->nb_dimensions  === '' ) $book_type = 'square';
	else $book_type = $post->nb_dimensions;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('book--'.$book_type); ?>>
	<?php
		if ( $post->nb_cover_style ) {
			echo '<style> #post-'.get_the_ID().' {';
			echo $post->nb_cover_style;
			echo '} </style>';
		}
	?>
	<a class="book" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post_id, 'full' ); ?>)" href="<?php echo get_permalink( $post->ID ); ?>">
	  <div class="cover">
	    <?php echo get_the_post_thumbnail( $post_id, 'full' ); ?>
	  </div>
	  <div class="pages"></div>
	</a>

	<div class="entry-content">
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
