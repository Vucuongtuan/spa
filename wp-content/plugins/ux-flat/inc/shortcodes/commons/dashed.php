<?php

if($dashed){
    $color_gradient = 'transparent';
    if($dashed_gradient) {
      $color_gradient = $dashed_gradient; 
    }
    $gradient_1 = round($dashed_length * (100 - $dashed_fade)) / 100;
    $gradient_2 = round($dashed_spacing * (100 - $dashed_fade)) / 100;
    $gradient_3 = ($dashed_length + $dashed_spacing);
    $dashed_left = ($dashed_slanting + ($dashed_diraction ? 180 : 0)).'deg, '.$dashed_color.', '.$dashed_color.' '.$gradient_1.'px, '.$color_gradient.' '.$dashed_length.'px, '.$color_gradient.' '.$gradient_2.'px, '.$dashed_color.' '.$gradient_3.'px';
    $dashed_right = ($dashed_slanting + ($dashed_diraction ? 0 : 180)).'deg, '.$dashed_color.', '.$dashed_color.' '.$gradient_1.'px, '.$color_gradient.' '.$dashed_length.'px, '.$color_gradient.' '.$gradient_2.'px, '.$dashed_color.' '.$gradient_3.'px';
    $dashed_top = ($dashed_slanting + ($dashed_diraction ? 270 : 90)).'deg, '.$dashed_color.', '.$dashed_color.' '.$gradient_1.'px, '.$color_gradient.' '.$dashed_length.'px, '.$color_gradient.' '.$gradient_2.'px, '.$dashed_color.' '.$gradient_3.'px';
    $dashed_bottom = ($dashed_slanting + ($dashed_diraction ? 90 : 270)).'deg, '.$dashed_color.', '.$dashed_color.' '.$gradient_1.'px, '.$color_gradient.' '.$dashed_length.'px, '.$color_gradient.' '.$gradient_2.'px, '.$dashed_color.' '.$gradient_3.'px';
    if ( ! is_array( $dashed_visibility ) ) {
        $dashed_visibility = explode( ',', $dashed_visibility );
    }
    foreach ( $dashed_visibility as $key => $hidden ) {
        if($hidden == "top") {
          $dashed_top = 'transparent, transparent';
          $css_dashed[] = array( 'attribute' => 'padding-top', 'value' => '0 !important');
        }
        if($hidden == "left") {
          $dashed_left = 'transparent, transparent';
          $css_dashed[] = array( 'attribute' => 'padding-left', 'value' => '0 !important');
        }
        if($hidden == "right") {
          $dashed_right = 'transparent, transparent';
          $css_dashed[] = array( 'attribute' => 'padding-right', 'value' => '0 !important');
        }

        if($hidden == "bottom") {
          $dashed_bottom = 'transparent, transparent';
          $css_dashed[] = array( 'attribute' => 'padding-bottom', 'value' => '0 !important');
        }
    }
    if($dashed_animation){
        $dashed_length_px = round(($dashed_length + $dashed_spacing) / sin((90 - abs($dashed_slanting)) * M_PI / 180) * 100) / 100;
        $dashed_length_v = ($dashed_animation > 0) ? 'calc(100% + '.$dashed_length_px.'px)' : '100%';
        $dashed_speed = round((1.1 - $dashed_animation) * 10) / 10;
    }

    $dashed_style = array(
        array( 'attribute' => 'background-image', 'value' => 'repeating-linear-gradient('.($dashed_left).'),
        repeating-linear-gradient('.($dashed_top).'),
        repeating-linear-gradient('.($dashed_right).'),
        repeating-linear-gradient('.($dashed_bottom).')' ),
        array( 'attribute' => 'background-position', 'value' => '0 0, 0 0, 100% 0, 0 100%' ),
        array( 'attribute' => 'background-repeat', 'value' => 'no-repeat' ),
        array( 'attribute' => 'background-size', 'value' => $dashed.'px '.$dashed_length_v.', '.$dashed_length_v.' '.$dashed.'px, '.$dashed.'px '.$dashed_length_v.' , '.$dashed_length_v.' '.$dashed.'px' ),
        array( 'attribute' => 'animation', 'value' => $id.' '.$dashed_speed.'s infinite linear '.($dashed_diraction ? ' reverse' : '') ),
        array( 'attribute' => 'padding', 'value' => $dashed.'px' ),
        array( 'attribute' => 'border-width', 'value' => '0px' ),
        array( 'attribute' => 'border-radius', 'value' => $dashed_radius, 'unit' => 'px' ),
    );
}
?>

<?php if($dashed) { ?>
	<div class="is-border"
		<?php echo get_shortcode_inline_css($dashed_style); ?>>
	</div>
<?php } ?>
 
<?php if($dashed_animation){ ?>
<style>
  @keyframes <?php echo esc_attr($id); ?> {
    from { background-position: 0 0, -<?php echo esc_attr($dashed_length_px); ?>px 0, 100% -<?php echo esc_attr($dashed_length_px); ?>px, 0 100%; }
    to { background-position: 0 -<?php echo esc_attr($dashed_length_px); ?>px, 0 0, 100% 0, -<?php echo esc_attr($dashed_length_px); ?>px 100%; }
  }
</style>
<?php } ?>