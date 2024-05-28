<?php
/**
 * FAQ Shortcode
 *
 * FAQ and FAQ Item Shortcode builder.
 *
 * @author UX Themes
 * @package Flatsome/Shortcodes/FAQ
 * @version 3.9.0
 */

$flatsome_faq_state = array();

/**
 * Output the faq shortcode.
 *
 * @param array  $atts Shortcode attributes.
 * @param string $content FAQ content.
 *
 * @return string.
 */
function ux_faq( $atts, $content = null ) {
	global $flatsome_faq_state;

	extract(shortcode_atts(array(
		'auto_open' => '',
		'open'      => '',
		'title'     => '',
		'class'     => '',
	), $atts));

	if ($auto_open) $open = 1;

	array_push( $flatsome_faq_state, array(
		'open'    => (int) $open,
		'current' => 1,
	) );

	$classes                 = array( 'accordion' );
	if ( $class ) $classes[] = $class;

	if ($title) $title = '<h2 class="accordion_title">' . $title . '</h2>';

	$result = $title . '<section itemscope itemtype="https://schema.org/FAQPage"  class="' . implode( ' ', $classes ) . '">' . do_shortcode( $content ) . '</section>';

	array_pop( $flatsome_faq_state );

	return $result;
}
add_shortcode( 'faq', 'ux_faq' );


/**
 * Output the faq-item shortcode.
 *
 * @param array  $atts Shortcode attributes.
 * @param string $content FAQ content.
 *
 * @return string.
 */
function ux_faq_item( $atts, $content = null ) {
	global $flatsome_faq_state;

	$current  = count( $flatsome_faq_state ) - 1;
	$state    = isset( $flatsome_faq_state[ $current ] )
		? $flatsome_faq_state[ $current ]
		: null;

	extract(shortcode_atts(array(
		'id'    => 'faq-' . wp_rand(),
		'title' => 'FAQ Panel',
		'class' => '',
	), $atts));

	$is_open       = false;
	$classes       = array( 'accordion-item' );
	$title_classes = array( 'accordion-title', 'plain' );

	if ( is_array( $state ) && $state['current'] === $state['open'] ) {
		$is_open         = true;
		$title_classes[] = 'active';
	}

	if ( $class ) $classes[] = $class;

	if ( isset( $flatsome_faq_state[ $current ]['current'] ) ) {
		$flatsome_faq_state[ $current ]['current']++;
	}

	return '<div id="' . esc_attr( $id ) . '" class="' . implode( ' ', $classes ) . '" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"><a id="' . esc_attr( $id ) . '-label" href="#" class="' . implode( ' ', $title_classes ) . '" aria-expanded="' . ( $is_open ? 'true' : 'false' ) . '" aria-controls="' . esc_attr( $id ) . '-content"><button class="toggle" aria-label="' . esc_attr__( 'Toggle', 'flatsome' ) . '"><i class="icon-angle-down"></i></button><h3 class="is-large mb-0" itemprop="name">' . $title . '</h3></a><div id="' . esc_attr( $id ) . '-content" class="accordion-inner"' . ( $is_open ? ' style="display: block;"' : '' ) . ' aria-labelledby="' . esc_attr( $id ) . '-label" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"><div itemprop="text">' . do_shortcode( $content ) . '</div></div></div>';
}
add_shortcode( 'faq-item', 'ux_faq_item' );