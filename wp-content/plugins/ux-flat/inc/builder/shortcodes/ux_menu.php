<?php

/* $listmenus = get_registered_nav_menus();
foreach ( $listmenus as $location => $description ) {
	$listmenu[$description] = $description;
} */

$listmenus = wp_get_nav_menus();
foreach ($listmenus as $itemmenu) {
    $listmenu[$itemmenu->name] = $itemmenu->name;
}

add_ux_builder_shortcode( 'menu', array(
    'name' => __( 'Menu' ),
    'category' => __( 'UX Flat' ),
    'thumbnail' =>  flatsome_uxf_builder_thumbnail( 'ux_menu' ),
    'options' => array(
        'menu' => array(
            'type' => 'select',
            'heading' => __( 'Menu' ),
            'default' => '',
            'options' => $listmenu,
        ),
        'name' => array(
            'type'    => 'checkbox',
            'heading' => __( 'Name' ),
            'default' => '',
        ),
		'submenu'          => array(
            'type' => 'select',
			'heading'    => __( 'Sub Menu & Icons', 'flatsome' ),
			'responsive' => true,
			'default'    => '',
			'options'    => array(
				''      =>  __( 'Hidden', 'flatsome' ),
				'parent' => __( 'Parent', 'flatsome' ),
				'expand' => __( 'Expand', 'flatsome' ),
			),
		),
		'type' => array(
          'type' => 'select',
          'heading' => __( 'Direction','ux-builder' ),
          'default' => 'vertical',
          'options' => array(
              'horizontal' => 'Horizontal',
              'vertical' => 'Vertical',
          )
        ),
        'style' => array(
            'type' => 'select',
            'heading' => __( 'Style','ux-builder'),
            'default' => 'line',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/nav-styles.php' ),
        ),
        'align' => array(
	        'conditions' => 'type == "horizontal"',
            'type' => 'radio-buttons',
            'heading' => 'Text align',
            'default' => 'left',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/align-radios.php' ),
        ),
        'size' => array(
            'type' => 'radio-buttons',
            'heading' => __( 'Size' ,'ux-builder'),
            'default' => 'medium',
            'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/text-sizes.php' ),
        ),
		'hover' => array(
          'type' => 'select',
          'heading' => __( 'Hover','ux-builder' ),
          'default' => '',
          'options' => array(
              '' => 'None',
              'translatey' => 'translateY',
              'scalex' => 'scaleX',
          )
        ),
        'advanced_options' => require( get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php'),
    ),
) );
