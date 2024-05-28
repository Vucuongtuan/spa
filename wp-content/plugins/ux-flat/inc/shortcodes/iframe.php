<?php
/**
 * [iframe]
 */
 
function uxf_iframe( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'url' => '',
		'width'     => '600',
		'height'    => '400',
		'style'     => '',
		'class'     => '',
	), $atts));
    $css = '';
	if ( strpos( $style, 'grayscale' ) !== false ) {
		$css = '-webkit-filter: grayscale(100%); filter: grayscale(100%);';
	} elseif ( strpos( $style, 'black' ) !== false ) {
		$css = 'filter: grayscale(100%) invert(92%) contrast(83%);';
	}
    return '<div class="' . esc_attr( $class ) . '" style="' . esc_attr( $css ) . '"><iframe src="' . esc_attr( $url ) . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>';
}
add_shortcode( 'iframe', 'uxf_iframe' );