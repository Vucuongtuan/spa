<?php
/**
 * Post archive title.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

?>
<header class="archive-page-header">
	<div class="row">
	<div class="large-12 text-center col">
    <?php 
    $image_id = get_term_meta(get_queried_object_id(), '_thumbnail_id', true);
    if (is_category() && $image_id) {
    echo flatsome_apply_shortcode( 'page_header', array(
        'height'    => '300px',
        'style' => 'normal',
        'nav_style' => 'simple',
        'bg'        => $image_id,
        'bg_size'   => 'original',
        'title'     => single_cat_title( '', false ),
        'bg_overlay' => 'rgba(255, 255, 255, 0.5)',
        'text_color' => 'dark',
        'title_size' => 'xxlarge',
        'class' => 'title-category',
    ) );
    } else { ?>
	<h1 class="page-title is-large uppercase">
		<?php

			if ( is_category() ) :
				printf( __( 'Category Archives: %s', 'flatsome' ), '<span>' . single_cat_title( '', false ) . '</span>' );

			elseif ( is_tag() ) :
				printf( __( 'Tag Archives: %s', 'flatsome' ), '<span>' . single_tag_title( '', false ) . '</span>' );

			elseif ( is_search() ) :
				printf( __( 'Search Results for: %s', 'flatsome' ), '<span>' . get_search_query() . '</span>' );

			elseif ( is_author() ) :
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				*/
				the_post();
				printf( __( 'Author Archives: %s', 'flatsome' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'flatsome' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'flatsome' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'flatsome' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
				_e( 'Asides', 'flatsome' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
				_e( 'Images', 'flatsome');

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
				_e( 'Videos', 'flatsome' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
				_e( 'Quotes', 'flatsome' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
				_e( 'Links', 'flatsome' );

			else :
				_e( '', 'flatsome' );

			endif;
		?>
	</h1>
    <?php } ?>
	</div>
	</div>
</header>
