<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zineshelf
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php /*
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				zineshelf_posted_on();
				zineshelf_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; 				*/
 ?>
	</header><!-- .entry-header -->

	<details class="view-controls">
	    <summary>View books as</summary>
			<ul>
				<li>
			    <input type="radio" id="book-view" name="view" value="book-view" checked>
			    <label for="book-view">Book (prettier)</label>
			  </li>
			  <li>
			    <input type="radio" id="list-view" name="view" value="list-view">
			    <label for="list-view">List (better on small screens)</label>
			  </li>
			</ul>

<?php /*
			<p>
				<input type="checkbox" id="all-books" name="all-books" value="all-books">
				<label for="all-books">View all books this way</label>
			</p>
*/ ?>

	</details>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'zineshelf' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zineshelf' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php zineshelf_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

<div id="bookpage-nav">
	<button class="prev">Prev</button>
<button class="next">Next</button>
</div>
