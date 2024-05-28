<?php

add_ux_builder_shortcode( 'faq', array(
    'type' => 'container',
    'name' => __( 'FAQ' ),
    'image' => '',
    'category' => __( 'UX Flat' ),
    'template' => flatsome_uxf_builder_template( 'faq.html' ),
    'thumbnail' =>  flatsome_uxf_builder_thumbnail( 'accordion' ),
    'info' => '{{ title }}',
    'allow' => array( 'faq-item' ),

    'presets' => array(
        array(
            'name' => __( 'Default' ),
            'content' => '
                [faq]
                    [faq-item title="FAQ Item 1 Title"][/faq-item]
                    [faq-item title="FAQ Item 2 Title"][/faq-item]
                    [faq-item title="FAQ Item 3 Title"][/faq-item]
                [/faq]
            '
        ),
    ),

    'options' => array(
        'title' => array(
            'type' => 'textfield',
            'heading' => __( 'Title' ),
            'default' => __( '' ),
            'auto_focus' => true,
        ),
        'auto_open' => array(
            'type' => 'radio-buttons',
            'heading' => __('Auto Open'),
            'default' => '',
            'options' => array(
                ''  => array( 'title' => 'Off'),
                'true'  => array( 'title' => 'On'),
            ),
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

add_ux_builder_shortcode( 'faq-item', array(
    'type' => 'container',
    'name' => __( 'FAQ Panel' ),
    'template' => flatsome_uxf_builder_template( 'faq_item.html' ),
    'info' => '{{ title }}',
    'require' => array( 'faq' ),
    'wrap' => false,
    'hidden' => true,
    'options' => array(
        'title' => array(
            'type' => 'textfield',
            'heading' => __( 'Title' ),
            'default' => __( 'FAQ Panel Title' ),
            'auto_focus' => true,
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
