<?php
add_ux_builder_shortcode( 'more', array(
    'type' => 'container',
    'name' => __( 'More' ),
    'category' => __( 'UX Flat' ),
    'template' => flatsome_uxf_builder_template( 'more.html' ),
    'thumbnail' =>  flatsome_uxf_builder_thumbnail( 'more' ),
    'info' => '{{ text }}',
    'wrap' => false,
    'options' => array(
        'text' => array(
            'type' => 'textfield',
            'heading' => __( 'Text' ),
            'default' => __( 'More' ),
            'auto_focus' => true,
        ),
        'bgcolor' => array(
            'type'     => 'colorpicker',
            'heading'  => __( 'BG Color' ),
            'format'   => 'rgb',
            'helpers'  => require( get_template_directory() . '/inc/builder/shortcodes/helpers/colors.php' ),
        ),
        'color' => array(
            'type'     => 'colorpicker',
            'heading'  => __( 'Color' ),
            'format'   => 'rgb',
            'helpers'  => require( get_template_directory() . '/inc/builder/shortcodes/helpers/colors.php' ),
        ),
        'height'          => array(
            'type'       => 'scrubfield',
            'heading'    => 'Height',
            'default' => '100px',
            'responsive' => true,
            'min'        => 0,
            'max'        => 1000,
        ),
        'class' => array(
            'type' => 'textfield',
            'heading' => 'Custom Class',
            'full_width' => true,
            'placeholder' => 'class-name',
            'default' => '',
        ),
    ),
) );
