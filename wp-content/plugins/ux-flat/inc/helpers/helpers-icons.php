<?php

/**
 * Get theme icon by classname.
 *
 * @param string $name The icon name.
 * @param string $size Optional size corresponding to font size.
 * @param array  $atts Optional element attributes.
 *
 * @return string Icon markup.
 */

function flatsome_remove_icons_css() {
    remove_action( 'wp_enqueue_scripts', 'flatsome_add_icons_css', 150 );
}
add_action( 'init', 'flatsome_remove_icons_css' );

if(!function_exists('uxf_custom_all_icons')){
    function uxf_custom_all_icons() {
        $theme     = wp_get_theme( get_template() );
        $version   = $theme->get( 'Version' );
        $fonts_url = UXF_URL . 'assets/css/icons';
        $ufx_main_css = '@font-face {
                    font-family: "fl-icons";
                    font-display: block;
                    src: url(' . $fonts_url . '/fl-icons.eot?v=' . $version . ');
                    src:
                        url(' . $fonts_url . '/fl-icons.eot#iefix?v=' . $version . ') format("embedded-opentype"),
                        url(' . $fonts_url . '/fl-icons.woff2?v=' . $version . ') format("woff2"),
                        url(' . $fonts_url . '/fl-icons.ttf?v=' . $version . ') format("truetype"),
                        url(' . $fonts_url . '/fl-icons.woff?v=' . $version . ') format("woff"),
                        url(' . $fonts_url . '/fl-icons.svg?v=' . $version . '#fl-icons) format("svg");
                }
                .icon-download:before { content: "\e81e"; }
                .icon-tablet:before { content: "\e821"; }
                .icon-zalo:before { content: "\e823"; }
                .icon-messenger:before { content: "\e822"; }
                .icon-mobile:before { content: "\e820"; }
                .icon-desktop:before { content: "\e81f"; }
                .icon-calendar:before { content: "\e864"; }
                ';
        wp_add_inline_style( 'flatsome-main', flatsome_minify_css($ufx_main_css) );
    }
}
add_action( 'wp_enqueue_scripts', 'uxf_custom_all_icons', 150 );

