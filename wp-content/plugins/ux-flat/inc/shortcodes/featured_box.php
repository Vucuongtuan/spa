<?php
// [featured_box]
function ux_featured_box( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'_id'			=> 'iconbox_' . rand(),
		'title'       => '',
		'title_small' => '',
		'font_size'   => '',
		'class'				=> '',
		'visibility'	=> '',
		'img'         => '',
		'inline_svg'  => 'true',
		'img_width'   => '60',
		'pos'         => 'top',
		'link'        => '',
		'target'      => '_self',
		'rel'         => '',
		'tooltip'     => '',
		'margin'      => '',
		'box_hover' => '',
		'icon_border' => '',
		'icon_border_color'  => '',
		'icon_color'  => '',
		'icon_align'    => '',
		'icon_custom'    => '',
		'icon_size'  => '',
		'icon_bgcolor'  => '',
		'timeline'  => '',
		'timeline_top'  => '',
		'timeline_left'  => '',
		'timeline_height'  => '',
		'timeline_width'  => '',
		), $atts )
	);

	if($visibility == 'hidden') return;
    
	if($box_hover) wp_enqueue_style( 'uxf-hover');

	$classes     = array( 'featured-box' );
	$classes_img = array( 'icon-box-img' );
	$classes_icon   = array();
	
	if( $class ) $classes[] = $class;
	if( $visibility ) $classes[] = $visibility;

	$classes[] = 'icon-box-' . $pos;

	if ( $tooltip ) $classes[] = 'tooltip';
	if ( $pos == 'center' ) $classes[] = 'text-center';
	if ( $pos == 'left' || $pos == 'top' ) $classes[] = 'text-left';
	if ( $pos == 'right' ) $classes[] = 'text-right';
	if ( $font_size ) $classes[] = 'is-' . $font_size;
	if ( $img_width ) $img_width = 'width: ' . intval( $img_width ) . 'px';
	if ( $icon_border ) $classes_img[] = 'has-icon-bg';

	$css_args_out = array(
		'margin' => array(
			'attribute' => 'margin',
			'value'     => $margin,
		),
	);

	$css_args = array(
		'icon_border' => array(
			'attribute' => 'border-width',
			'unit'      => 'px',
			'value'     => $icon_border,
		),
		'icon_border_color'  => array(
			'attribute' => 'border-color',
			'value'     => $icon_border_color,
		),
		'icon_color'  => array(
			'attribute' => 'color',
			'value'     => $icon_color,
		),
		'icon_bgcolor'  => array(
			'attribute' => 'background-color',
			'value'     => $icon_bgcolor,
		),
		'icon_align'  => array(
			'attribute' => 'text-align',
			'value'     => $icon_align,
		),
	);
	if($box_hover) {
        $classes_img[] = 'hvr-'.$box_hover;
    }
	if($icon_size) {
        $classes_icon[] = 'font-size:'.$icon_size.';';
    }
	$classes     = implode( ' ', $classes );
	$classes_img = implode( ' ', $classes_img );
	$link_atts   = array(
		'target' => $target,
		'rel'    => array( $rel ),
	);
	ob_start();
	?>

	<?php if ( $link ) echo '<a class="plain" href="' . $link . '"' . flatsome_parse_target_rel( $link_atts ) . '>'; ?>
	<div id="<?php echo esc_attr($_id); ?>" class="icon-box <?php echo $classes; ?>" <?php if ( $tooltip )
		echo 'title="' . $tooltip . '"' ?> <?php echo get_shortcode_inline_css( $css_args_out ); ?>>
		<?php if ( $img ) { ?>
			<div class="<?php echo $classes_img; ?>" style="<?php if ( $img_width ) {
				echo $img_width;
			} ?>">
				<div class="icon">
					<div class="icon-inner" <?php echo get_shortcode_inline_css( $css_args ); ?>>
						<?php echo flatsome_get_image( $img, $size = 'medium', $alt = $title, $inline_svg ); ?>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="<?php echo $classes_img; ?>" style="<?php if ( $img_width ) {
				echo $img_width;
			} ?>">
				<div class="icon">
					<div class="icon-inner" <?php echo get_shortcode_inline_css( $css_args ); ?>>
						<?php echo get_flatsome_icon( null, null, array ( 'aria-hidden' => 'true', 'class' => $icon_custom, 'style' => $classes_icon ) ); ?>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="icon-box-text last-reset">
			<?php if ( $title ) { ?><h5 class="uppercase"><?php echo $title; ?></h5><?php } ?>
			<?php if ( $title_small ) { ?><h6><?php echo $title_small; ?></h6><?php } ?>
			<?php echo do_shortcode( $content ); ?>
		</div>
        <?php if($timeline){ ?>
        <style>
        <?php echo '#'.esc_attr($_id); ?> .icon-box-img:before {
            content: "";
            width: <?php echo esc_attr($timeline_width); ?>;
            height: <?php echo esc_attr($timeline_height).'%'; ?>;
            position: absolute;
            top: <?php echo esc_attr($timeline_top).'%'; ?>;
            left: <?php echo esc_attr($timeline_left).'%'; ?>;
            background-color: <?php echo esc_attr($icon_color); ?>;
        }
        </style>
        <?php } ?>
	</div>
	<?php if ( $link ) echo '</a>'; ?>
    
	<?php
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode( 'featured_box', 'ux_featured_box' );