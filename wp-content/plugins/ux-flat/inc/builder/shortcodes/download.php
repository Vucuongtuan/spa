<?php

// Set defaults
$repeater_columns = '4';
$repeater_type = 'slider';
$repeater_post_type = 'download';
$repeater_col_spacing = 'normal';

$repeater_post_cat = 'download_category';
$default_text_align = 'center';

$options =  array(
'style_options' => array(
    'type' => 'group',
    'heading' => __( 'Style' ),
    'options' => array(
         'style' => array(
            'type' => 'select',
            'heading' => __( 'Style' ),
            'default' => '',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/box-layouts.php' )
        )
    ),
),
'layout_options' => require( get_template_directory() . '/inc/builder/shortcodes/commons/repeater-options.php' ),
'layout_options_slider' => require( UXF_PATH . '/inc/builder/shortcodes/commons/repeater-slider.php' ),
'post_options' => require( UXF_PATH . '/inc/builder/shortcodes/commons/repeater-posts.php' ),
'post_title_options' => array(
    'type' => 'group',
    'heading' => __( 'Title' ),
        'options' => array(
            'title_size' => array(
                'type' => 'select',
                'heading' => 'Title Size',
                'default' => '',
                'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/sizes.php' )
            ),
            'title_tag' => array(
                'type'    => 'select',
                'heading' => 'Title Tag',
                'default' => 'h3',
                'options' => array(
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'P',
                    'span' => 'Span',
                    'div' => 'Div',
                ),
            ),
            'title_style' => array(
                'type' => 'radio-buttons',
                'heading' => 'Title Style',
                'default' => '',
                'options' => array(
                    ''   => array( 'title' => 'Abc'),
                    'uppercase' => array( 'title' => 'ABC'),
                )
            ),
            'title_color' => array(
                'type' => 'select',
                'heading' => 'Title Color',
                'default' => '',
                'options' => array(
                    '' => 'Default',
                    'primary' => 'Primary',
                    'secondary' => 'Secondary',
                    'alert' => 'Alert',
                    'success' => 'Success',
                    'white' => 'White',
                )
            ),
    )
),
'read_more_button' => array(
    'type' => 'group',
    'heading' => __( 'Button' ),
        'options' => array(
            'readmore' => array(
                'type' => 'textfield',
                'heading' => 'Text',
                'default' => '',
            ),
            'readmore_color' => array(
            'type' => 'select',
            'heading' => 'Color',
            'conditions' => 'readmore',
            'default' => '',
            'options' => array(
                '' => 'Default',
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'alert' => 'Alert',
                'success' => 'Success',
                'white' => 'White',
            )
        ),
        'readmore_style' => array(
            'type' => 'select',
            'heading' => 'Style',
            'conditions' => 'readmore',
            'default' => 'outline',
            'options' => array(
                '' => 'Default',
                'outline' => 'Outline',
                'link' => 'Simple',
                'underline' => 'Underline',
                'shade' => 'Shade',
                'bevel' => 'Bevel',
                'gloss' => 'Gloss',
            )
        ),
        'readmore_size' => array(
            'type' => 'select',
            'conditions' => 'readmore',
            'heading' => 'Size',
            'default' => '',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/sizes.php' ),
        ),
        'readmore_show_date' => array(
            'type' => 'select',
            'heading' => 'Show Button',
            'conditions' => 'readmore',
            'default' => 'badge',
            'options' => array(
                'badge' => 'Badge',
                'text' => 'Text',
            )
        ),
        'readmore_badge_style' => array(
            'type' => 'select',
            'heading' => 'Badge Style',
            'default' => '',
            'conditions' => 'readmore && readmore_show_date == "badge"',
            'options' => array(
                '' => 'Default',
                'outline' => 'Outline',
                'square' => 'Square',
                'circle' => 'Circle',
                'circle-inside' => 'Circle Inside',
            )
        ),
    )
),


'post_meta_options' => array(
    'type' => 'group',
    'heading' => __( 'Meta' ),
    'options' => array(

    'show_date' => array(
        'type' => 'select',
        'heading' => 'Date',
        'default' => 'badge',
        'options' => array(
            'badge' => 'Badge',
            'text' => 'Text',
            'false' => 'Hidden',
        )
    ),
    'badge_style' => array(
        'type' => 'select',
        'heading' => 'Badge Style',
        'default' => '',
        'conditions' => 'show_date == "badge"',
        'options' => array(
            '' => 'Default',
            'outline' => 'Outline',
            'square' => 'Square',
            'circle' => 'Circle',
            'circle-inside' => 'Circle Inside',
        )
    ),
    'excerpt' => array(
        'type' => 'select',
        'heading' => 'Excerpt',
        'default' => 'visible',
        'options' => array(
            'visible' => 'Visible',
            'fade' => 'Fade In On Hover',
            'slide' => 'Slide In On Hover',
            'reveal' => 'Reveal On Hover',
            'false' => 'Hidden',
        )
    ),
   'excerpt_length' => array(
        'type' => 'slider',
        'heading' => 'Excerpt Length',
        'default' => 15,
        'max' => 50,
        'min' => 5,
    ),
    'show_category' => array(
        'type' => 'select',
        'heading' => 'Category',
        'default' => 'false',
        'options' => array(
            'badge' => 'Badge',
            'label' => 'Label',
            'text' => 'Text',
            'false' => 'Hidden',
        )
    ),
    'show_author' => array(
        'type' => 'select',
        'heading' => 'Author',
        'default' => 'false',
        'options' => array(
            'badge' => 'Badge',
            'text' => 'Text',
            'false' => 'Hidden',
        )
    ),
    'show_avatar' => array(
        'type' => 'select',
        'heading' => 'Avatar',
        'conditions' => 'show_author !== "false"',
        'default' => 'visible',
        'options' => array(
            'visible' => 'Visible',
            'false' => 'Hidden',
        )
    ),
    'show_price' => array(
        'type' => 'select',
        'heading' => 'Price',
        'default' => '',
        'options' => array(
            '' => 'Visible',
            'false' => 'Hidden',
        )
    ),
    'comments' => array(
        'type' => 'select',
        'heading' => 'Comments',
        'default' => 'visible',
        'options' => array(
            'visible' => 'Visible',
            'false' => 'Hidden',
        )
    ),
    'divider' => array(
        'type' => 'select',
        'heading' => 'Divider',
        'default' => '',
        'options' => array(
            '' => 'Visible',
            'false' => 'Hidden',
        )
    ),
    'v_align' => array(
        'type' => 'radio-buttons',
        'heading' => 'Align Vertical',
        'full_width' => true,
        'default' => '',
        'options' => array(
            '' => array( 'title' => 'None'),
            'equal' => array( 'title' => 'Equal'),
        )
    ),
    'col_padding' => array(
      'type' => 'margins',
      'heading' => __( 'Column Padding' ),
      'value' => '',
      'full_width' => true,
      'min' => 0,
      'max' => 100,
      'step' => 1,
      'on_change' => array(
            'selector' => '.post-item',
            'style' => 'padding: {{ value }}'
        )
    ),
    'col_bg' => array(
        'type' => 'colorpicker',
        'heading' => __('Column Background'),
        'format' => 'rgb',
        'alpha' => true,
        'position' => 'bottom right',
        'helpers' => require( get_template_directory() . '/inc/builder/shortcodes/helpers/colors.php' ),
    ),

    'col_bg_radius' => array(
        'type'       => 'slider',
        'vertical'   => true,
        'full_width' => true,
        'heading'    => __( 'Column Radius' ),
        'unit'       => 'px',
        'default'    => 0,
        'min'        => 0,
        'max'        => 100,
    ),
    ),
),
);


$box_styles = require( UXF_PATH . '/inc/builder/shortcodes/commons/box-styles.php' );
$options = array_merge($options, $box_styles);

add_ux_builder_shortcode( 'ux_download', array(
    'name' => __( 'Download' ),
    'category' => __( 'UX Flat' ),
    'thumbnail' =>  flatsome_uxf_builder_thumbnail( 'edd' ),
    'scripts' => array(
        'flatsome-masonry-js' => get_template_directory_uri() .'/assets/libs/packery.pkgd.min.js',
    ),

    'presets' => array(
        array(
            'name' => __( 'Normal' ),
            'content' => '[ux_download style="normal" columns="3" columns__md="1" image_height="56.25%"]'
        ),
        array(
            'name' => __( 'Bounce' ),
            'content' => '[ux_download style="bounce" badge_style="square" image_height="75%"]'
        ),
        array(
            'name' => __( 'Push' ),
            'content' => '[ux_download style="push" columns="3" columns__md="1" badge_style="circle-inside" image_height="75%"]'
        ),
        array(
            'name' => __( 'Vertical' ),
            'content' => '[ux_download style="vertical" slider_nav_style="simple" slider_nav_position="outside" columns="2" columns__md="1" depth="2" image_height="89%" image_width="43"]'
        ),
        array(
            'name' => __( 'Overlay' ),
            'content' => '[ux_download style="overlay" depth="1" title_style="uppercase" show_date="text" image_height="144%" image_overlay="rgba(0, 0, 0, 0.17)" image_hover="zoom"]'
        ),
        array(
            'name' => __( 'Overlay - Grayscale' ),
            'content' => '[ux_download style="overlay" depth="1" animate="fadeInLeft" title_style="uppercase" show_date="text" image_height="144%" image_overlay="rgba(0, 0, 0, 0.56)" image_hover="color" image_hover_alt="overlay-remove-50"]'
       ),
        array(
            'name' => __( 'Masonery' ),
            'content' => '[ux_download type="masonry" columns="3" depth="2" image_height="180px"]'
       ),
       array(
            'name' => __( 'Grid' ),
            'content' => '[ux_download style="shade" type="grid" columns="3" depth="1" posts="4" title_size="larger" title_style="uppercase" readmore="Read More" badge_style="circle-inside" image_height="180px"]'
       ),
       array(
            'name' => __( 'Full Slider' ),
            'content' => '[ux_download style="shade" type="slider-full" grid="2" slider_nav_style="circle" columns="1" title_size="larger" show_date="text" excerpt="false" show_category="label" comments="false" image_size="large" image_overlay="rgba(0, 0, 0, 0.09)" image_hover="overlay-remove" text_size="large" text_hover="bounce" text_padding="10% 0px 10% 0px"]'
        ),
),

    'options' => $options
) );