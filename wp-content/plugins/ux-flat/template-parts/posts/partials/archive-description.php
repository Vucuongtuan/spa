<?php
/**
 * Post archive description.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

?>
<?php
    if ( is_category() ) :
        // show an optional category description
        $category_description = category_description();
        if ( ! empty( $category_description ) ) :
            echo apply_filters( 'category_archive_meta', '<div class="row"><div class="large-12 text-center col"><div class="taxonomy-description">' . $category_description . '</div></div></div>' );
        endif;

    elseif ( is_tag() ) :
        // show an optional tag description
        $tag_description = tag_description();
        if ( ! empty( $tag_description ) ) :
            echo apply_filters( 'tag_archive_meta', '<div class="row"><div class="large-12 text-center col"><div class="taxonomy-description">' . $tag_description . '</div></div></div>' );
        endif;

    endif;
?>
