<?php
/**
 * [menu]
 */
 function uxf_menu_item( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'menu' => '',
        'name' => '',
        'submenu' => '',
        'class' => '',
        'visibility' => '',
        'align' => 'left',
        'style' => 'line',
        'type' => 'vertical', // horizontal / vertical
        'size' => 'medium',
        'hover' => ''
    ), $atts ) );

    $classes = array( 'nav' );
    if ( $class ) $classes[] = $class;
    if ( $visibility ) $classes[] = $visibility;
    if ( $type ) $classes[] = 'nav-' . $type;
    if ( $size ) $classes[] = 'nav-size-' . $size;
    if ( $style ) $classes[] = 'nav-' . $style;
    if ( $align ) $classes[] = 'text-' . $align . ' nav-' . $align;

    if ( $submenu === 'expand' ) {
        $submenu = new FlatsomeNavDropdown();
    } else {
        $depth = ( $submenu === 'parent' ) ? 0 : 1;
    }

    $menu_content = wp_nav_menu(
        array(
            'menu' => $menu,
            'menu_class' => implode( ' ', $classes ),
            'walker' => ( isset( $submenu ) ) ? $submenu : '',
            'depth' => ( isset( $depth ) ) ? $depth : 1,
            'echo' => false
        )
    );

    if ( $name ) {
        $menu_content = '<h4 class="menu-title">' . $menu . '</h4>' . $menu_content;
    }
    if ( $hover === 'translatey' ) {
        $menu_class = '.menu-' . sanitize_title($menu) . '-container';
        $menu_content .= "<style>
            {$menu_class} ul li a::after {
                position: absolute;
                content: '';
                top: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
                left: 0;
                height: 1px;
                width: 0;
            }
            {$menu_class} ul li a:hover {
                color: var(--primary-color);
                padding-left: 15px;
            }
            {$menu_class} ul li a:hover::after {
                background: var(--primary-color);
                width: 10px;
            }</style>";
    } elseif ( $hover === 'scalex' ) {
        $menu_class = '.menu-' . sanitize_title($menu) . '-container';
        $menu_content .= "<style>
        {$menu_class} ul li > a:after{
            content: '';
            display: block;
            position: absolute;
            top: calc(100% - 2px);
            left: 0;
            width: 100%;
            border-bottom: 1px solid var(--primary-color);
            transition: transform 1s cubic-bezier(.28,.75,.22,.95);
            transform: scaleX(0);
            transform-origin: right center;
        }
        {$menu_class} ul li > a:hover{
            color: var(--primary-color);
        }
        {$menu_class} ul li > a:hover:after{
            transform: scale(1);
            transform-origin: left center;
        }
        </style>";
    }
    return $menu_content;
}
add_shortcode( 'menu', 'uxf_menu_item' );


