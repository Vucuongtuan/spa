<?php
add_ux_builder_shortcode( 'iframe', array(
    'name' => __( 'Iframe' ),
    'category' => __( 'UX Flat' ),
    'thumbnail' =>  flatsome_uxf_builder_thumbnail( 'iframe' ),
    'info' => '{{ text }}',
    'wrap' => false,
    'options' => array(
        'url' => array(
            'type' => 'textfield',
            'heading' => __( 'URL' ),
            'auto_focus' => true,
        ),
        'width' => array(
            'type'    => 'scrubfield',
            'heading' => __( 'Width' ),
            'default' => '600',
        ),
        'height' => array(
            'type'    => 'scrubfield',
            'heading' => __( 'Height' ),
            'default' => '400',
        ),
        'style'       => array(
            'type'    => 'select',
            'heading' => 'Style Gmaps',
            'default' => '',
            'options' => array(
                ''          => 'Default',
                'grayscale'   => 'Grayscale',
                'black'      => 'Black',
            ),
        ),
        'class' => array(
            'type' => 'textfield',
            'heading' => 'Custom Class',
            'placeholder' => 'class-name',
            'default' => '',
        ),
    ),
) );
