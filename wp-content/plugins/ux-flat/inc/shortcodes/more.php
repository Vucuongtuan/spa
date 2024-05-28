<?php
/**
 * [more]
 */

function uxf_more_item( $atts, $content = null ) {
	$atts = shortcode_atts(array(
		'id' => 'more-'.rand(),
		'text' => 'More',
		'bgcolor' => '',
		'color' => '',
		'height' => '100px',
		'class' => '',
	), $atts);
    
    $button_color = array();
    if($atts['color']){
        $button_color[] = array( 'attribute' => 'color', 'value' => $atts['color']);
    }
    $bg_color = (!empty($atts['bgcolor']) ? $atts['bgcolor'] : '#FFF');
$max_height = (!empty($atts['height']) ? $atts['height'] : '100px');

    
    return '<div id="' . esc_attr( $atts['id'] ) . '" class="more has-dropdown ' . esc_attr( $atts['class'] ) . '"><details><summary '.get_shortcode_inline_css($button_color).'>' . $atts['text'] . '<i class="icon-angle-down"></i></summary>' . do_shortcode( $content ) . '</details></div><style>
    #' . esc_attr( $atts['id'] ) . ' details[open] summary {display: none;}
    #' . esc_attr( $atts['id'] ) . ' details[open] summary ~ * {-webkit-animation:stuckFadeIn .6s; animation:stuckFadeIn .6s;}
    #' . esc_attr( $atts['id'] ) . ' details[open]:before {background-image: unset;height: auto;}
    #' . esc_attr( $atts['id'] ) . ' details {position: relative;}
    #' . esc_attr( $atts['id'] ) . ' summary {text-align: center; width: 100%; cursor: pointer; top: -25px; position: absolute;}
    #' . esc_attr( $atts['id'] ) . ' details:before {content:"";position: absolute;bottom: 100%;height:' . $max_height . ';left: 0;background-image: linear-gradient(180deg,hsla(0,0%,100%,0),' . $bg_color . ');width: 100%;}</style>';
}
add_shortcode( 'more', 'uxf_more_item' );
