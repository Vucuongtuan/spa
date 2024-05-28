<?php
/**
 * [icon]
 */
function ux_icon_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'icon'        => '',
		'icon_size'        => '16px',
		'icon_color'        => '',
		'link'        => '',
		'target'      => '_self',
		'rel'         => '',
		'class'       => '',
		'visibility'  => '',
		'id'          => '',
		'block'       => '',
		//Animate
		'ani'     => '',
		'ani_infinite'     => '',
		'ani_repeat'     => '',
		'ani_delay'     => '',
		'ani_duration'     => '',
		'ani_dynamic'     => '',
		'ani_text'     => '',
		//Box Hover
		'box_hover' => '',
		'icon_custom'    => '',
	), $atts ) );

    // Ani CSS
	if($ani) {
        wp_enqueue_style( 'uxf-animate');
        wp_enqueue_script( 'uxf-anidynamic');
    }
	if($box_hover) wp_enqueue_style( 'uxf-hover');

	$attributes = array();

	// Add Button Classes.
	$classes   = array();
	$styles   = array();
    
    if ($icon && $icon == 'custom') {
		$classes[] = $icon_custom;
    } elseif ( $icon ) {
		$classes[] = $icon;
	}
	if ( $class ) {
		$classes[] = $class;
	}
	if ( $visibility ) {
		$classes[] = $visibility;
	}
	if ( $target == '_blank' ) {
		$attributes['rel'][] = 'noopener noreferrer';
	}
	if ( $rel ) {
		$attributes['rel'][] = $rel;
	}
	if ( $link ) {
		// Smart links.
		$link               = flatsome_smart_links( $link );
		$attributes['href'] = $link;
		if ( $target ) {
			$attributes['target'] = $target;
		}
	}

	if($box_hover) {
        $classes[] = 'hvr-'.$box_hover;
    }
	if($ani) {
        $classes[] = 'ani_'.$ani.' animate__animated animate__'.$ani;
    }
	if($ani_dynamic) {
        if ( ! is_array( $ani_dynamic ) ) {
            $ani_dynamic = explode( ',', $ani_dynamic );
        }
        foreach ( $ani_dynamic as $key => $value ) {
            $classes[] = $value;
        }
    }
	if($ani_text) {
        $classes[] = 'aniCus_text-'.$ani;
    } 
	if($ani_infinite) {
        $classes[] = 'animate__infinite';
    }
	if($ani_repeat) {
        $classes[] = 'animate__repeat-'.$ani_repeat;
    }
	if($ani_delay) {
        $classes[] = 'animate__delay-'.$ani_delay.'s';
    }
	if($ani_duration) {
        $classes[] = 'animate__'.$ani_duration;
    }
    
	if($icon_size) {
        $styles[] = 'font-size:'.$icon_size.';';
    }
	if($icon_color) {
        $styles[] = 'color:'.$icon_color;
    }

	$attributes          = flatsome_html_atts( $attributes );
    
	$link_top  = $link ? '<a '. wp_kses_post($attributes). '>' : '';
	$link_bottom = $link ? '</a>' : '';
    
	$icon_atts = get_flatsome_icon( null, null, array ( 'aria-hidden' => 'true', 'class' => $classes, 'style' => $styles ) );
	ob_start();
	?>
	<?php echo wp_kses_post($link_top); ?>
		<?php echo wp_kses_post($icon_atts); ?>
	<?php echo wp_kses_post($link_bottom); ?>
	<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode( 'icon', 'ux_icon_shortcode' );