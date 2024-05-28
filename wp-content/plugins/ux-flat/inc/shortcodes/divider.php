<?php

// [divider]
function uxf_divider_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'width' => '',
    'height' => '',
    'margin' => '',
    'align' => '',
    'color' => '',
    //UXF
    'id' => 'divider-'.rand(),
    'line_style' => '',
    //Dashed
    'dashed' => '',
    'dashed_color' => '',
    'dashed_gradient' => '',
    'dashed_radius' => '',
    'dashed_length' => '1',
    'dashed_spacing' => '2',
    'dashed_slanting' => '-60',
    'dashed_fade' => '1',
    'dashed_diraction' => '',
    'dashed_animation' => '',
    'dashed_visibility' => '',
  ), $atts ) );

$align_end ='';
$align_start = '';

// Fallback
if($width == 'full') $width = '100%';

$css_args = array(
  array( 'attribute' => 'margin-top', 'value' => $margin),
  array( 'attribute' => 'margin-bottom', 'value' => $margin),
  array( 'attribute' => 'max-width', 'value' => $width ),
  array( 'attribute' => 'height', 'value' => $height ),
  array( 'attribute' => 'background-color', 'value' => $color ),
);

$color_gradient = 'transparent';
if($dashed_gradient) {
  $color_gradient = $dashed_gradient; 
}
if($dashed){
  $gradient_1 = round($dashed_length * (100 - $dashed_fade)) / 100;
  $gradient_2 = round($dashed_spacing * (100 - $dashed_fade)) / 100;
  $gradient_3 = ($dashed_length + $dashed_spacing);
  $dashed_top = ($dashed_slanting + ($dashed_diraction ? 270 : 90)).'deg, '.$dashed_color.', '.$dashed_color.' '.$gradient_1.'px, '.$color_gradient.' '.$dashed_length.'px, '.$color_gradient.' '.$gradient_2.'px, '.$dashed_color.' '.$gradient_3.'px';
  $css_args[] = array( 'attribute' => 'background-image', 'value' => 'repeating-linear-gradient(transparent, transparent),
    repeating-linear-gradient('.($dashed_top).')');
  $css_args[] = array( 'attribute' => 'background-position', 'value' => '0 0, 0 0, 100% 0, 0 100%' );
  $css_args[] = array( 'attribute' => 'background-repeat', 'value' => 'no-repeat');
  $css_args[] = array( 'attribute' => 'padding-top', 'value' => $dashed.'px');
}
if($dashed_animation){
  $dashed_length_px = round(($dashed_length + $dashed_spacing) / sin((90 - abs($dashed_slanting)) * M_PI / 180) * 100) / 100;
  $dashed_length_v = ($dashed_animation > 0) ? 'calc(100% + '.$dashed_length_px.'px)' : '100%';
  $dashed_speed = round((1.1 - $dashed_animation) * 10) / 10;
  $css_args[] = array( 'attribute' => 'background-size', 'value' => $dashed.'px '.$dashed_length_v.', '.$dashed_length_v.' '.$dashed.'px, '.$dashed.'px '.$dashed_length_v.' , '.$dashed_length_v.' '.$dashed.'px');
  $css_args[] = array( 'attribute' => 'animation', 'value' => $id.' '.$dashed_speed.'s infinite linear '.($dashed_diraction ? ' reverse' : ''));
}
if($dashed_radius){
  $css_args[] = array( 'attribute' => 'border-radius', 'value' => $dashed_radius.'px');
}

if($align === 'center'){
  $align_start ='<div class="text-center">';
  $align_end = '</div>';
}
if($align === 'right'){
  $align_start ='<div class="text-right">';
  $align_end = '</div>';
}
if($dashed_animation){ ?>
    <style>
    @keyframes <?php echo esc_attr($id); ?> {
      from { background-position: 0 0, -<?php echo esc_attr($dashed_length_px); ?>px 0, 100% -<?php echo esc_attr($dashed_length_px); ?>px, 0 100%; }
      to { background-position: 0 -<?php echo esc_attr($dashed_length_px); ?>px, 0 0, 100% 0, -<?php echo esc_attr($dashed_length_px); ?>px 100%; }
    }
    </style>
<?php }

return $align_start.'<div id="'.esc_attr($id).'" class="is-divider divider clearfix" '.get_shortcode_inline_css($css_args).'></div>'.$align_end;
}
add_shortcode('divider', 'uxf_divider_shortcode');