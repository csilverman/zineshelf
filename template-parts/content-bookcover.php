<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zineshelf
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('book--'.$post->nb_dimensions); ?>>

	<a class="book" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post_id, 'full' ); ?>)" href="<?php echo get_permalink( $post->ID ); ?>">
	  <div class="cover">
	    <?php echo get_the_post_thumbnail( $post_id, 'full' ); ?>
	  </div>
	  <div class="pages"></div>
	</a>

	<div class="entry-content">
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
