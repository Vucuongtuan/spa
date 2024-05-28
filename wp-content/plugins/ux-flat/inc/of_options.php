<?php
/**
 * Advanced UXFlat Options
 */

add_action( 'init', 'uxf_of_options', 20 );
function uxf_of_options(){
    global $of_options;
    
    if(!$of_options) return;
    
    $of_options[] = array(
        'name' => 'UX Flat',
        'type' => 'heading',
    );

    $of_options[] = array(
        'name' => '',
        'type' => 'info',
        'desc' => '<p style="font-size:14px"><a class="button" targer="_blank" href="https://www.paypal.me/copvn" rel="nofollow">Donate to this plugin</a></p>',
    );

    $of_options[] = array(
        'name' => 'Replace Elements',
        'desc' => 'Section / Banner / Title / Devider / Button / Gallery / Slider / Image / Blog Posts / Portfolio',
        'id'   => 'uxf_elements',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'name' => 'New Elements',
        'id'   => 'uxf_categories',
        'desc' => 'Blog Categories',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_more',
        'desc' => 'More',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_menus',
        'desc' => 'Menu',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_icons',
        'desc' => 'Icon',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_faqs',
        'desc' => 'FAQ Schema',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_lightbox',
        'desc' => 'Lightbox',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_tables',
        'desc' => 'Table',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_iframe',
        'desc' => 'IFrame',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_module',
        'desc' => 'Module',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_progressbar',
        'desc' => 'Progress Bar & Skill Bar <code>PRO</code>',
        'std'  => 0,
        'type' => 'checkbox',
    );
    if ( class_exists( 'Easy_Digital_Downloads' )) {
        $of_options[] = array(
            'id'   => 'uxf_download',
            'desc' => 'Easy Digital Downloads',
            'std'  => 0,
            'type' => 'checkbox',
        );
    }

    $of_options[] = array(
        'name' => 'Performance',
        'id'   => 'uxf_issues',
        'desc' => 'Disable Flatsome issues',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_cdn',
        'desc' => 'Enable CDN jsDelivr (hover, animate, nprocess)',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_nprogress',
        'desc' => 'Enable Turbolinks',
        'std'  => 0,
        'type' => 'checkbox',
        'folds' => 1,
    );

    $of_options[] = array(
        'id'   => 'uxf_nprogress_bg',
        'std'  => '',
        'type' => 'color',
        'fold' => 'uxf_nprogress',
    );

    $of_options[] = array(
        'name' => 'Apperance',
        'id'   => 'uxf_lightbox_close',
        'desc' => 'Lightbox Close Inside',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_attachment_title',
        'desc' => 'Adding the Title Attribute to Image Tags',
        'std'  => 0,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'name' => 'WooCommerce Global',
        'id'   => 'uxf_product_title',
        'desc'    => 'Change Product Title to in WooCommerce Category Layout',
        'std'     => '',
        'type'    => 'select',
        'options' => array(
            ''  => 'Default (p)',
            'h3' => 'h3',
            'h4' => 'h4',
            'h5' => 'h5',
            'h6' => 'h6',
            'div' => 'div',
            'span' => 'span',
        ),
    );

    $of_options[] = array(
        'id'   => 'uxf_category_product',
        'desc' => 'Move category/product description to bottom',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'name'    => 'Post Refesh',
        'desc' => 'Defines a time interval for the document to refresh itself. E.g. 1200 seconds',
        'id'   => 'uxf_post_refresh',
        'type' => 'text',
    );


    $of_options[] = array(
        'name' => 'Category/post',
        'id'   => 'uxf_h1_hidden',
        'desc' => 'Enable Homepage H1 Title & Hidden Text',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_category_archives',
        'desc' => 'Remove "Category Archives:" Title',
        'std'  => 0,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'id'   => 'uxf_category_layout',
        'desc' => 'Category Custom Layout',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_category_post',
        'desc' => 'Move category/post description to bottom',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_scrollpost',
        'desc' => 'Infinite scroll for category/post.',
        'std'  => 0,
        'folds'  => 1,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'      => 'uxf_scroll_loader_type',
        'std'     => 'spinner',
        'fold'    => 'uxf_scrollpost',
        'type'    => 'select',
        'options' => array(
            'button'  => 'Button (On click)',
            'spinner' => 'Spinner',
            'image'   => 'Custom Image',
        ),
    );

    $of_options[] = array(
        'desc' => "Upload or choose a custom loader image (for loading type 'Custom Image').",
        'id'   => 'uxf_scroll_loader_img',
        'std'  => '',
        'fold' => 'uxf_scrollpost',
        'type' => 'upload',
    );

    $of_options[] = array(
        'id'   => 'uxf_blog_layout',
        'desc' => 'Post Layout List CSS',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_posted_on',
        'desc' => 'Icon Posted On',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'name'    => 'Related Post',
        'id'   => 'uxf_post_tags',
        'desc' => 'order by tags',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'desc' => 'order by category',
        'id'   => 'uxf_post_cats',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'desc' => 'order by latest',
        'id'   => 'uxf_post_latest',
        'std'  => 0,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'desc' => 'Title. E.g: <code>[title style="center" tag_name="h2" size="100" text="{title}"]</code>',
        'id'   => 'uxf_related_title',
        'std'  => '',
        'type' => 'textarea',
    );
    
    $of_options[] = array(
        'desc' => 'Content. E.g: <code>[blog_posts style="push" type="slider" slider_nav_style="simple" columns="3" posts="6" show_date="false" text_align="left" image_height="56.25%"]</code>',
        'id'   => 'uxf_related_posts',
        'std'  => '',
        'type' => 'textarea',
    );

    $of_options[] = array(
        'name'    => 'Fl Icons',
        'id'   => 'uxf_fl_icons',
        'desc' => 'Customize Default Icons',
        'std'  => 0,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'desc' => 'Add New Icons from a CDN URL',
        'id'   => 'uxf_cdn_icon',
        'std'  =>  0,
        'folds' => 1,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'desc' => 'E.g: https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        'id'   => 'uxf_cdn_iconurl',
        'fold' => 'uxf_cdn_icon',
        'type' => 'text',
    );
    
    $of_options[] = array(
        'name' => 'MCE Font Sizes',
        'id'   => 'uxf_text_size',
        'std'     => '',
        'type'    => 'select',
        'options' => array(
            ''  => '-- None --',
            'pixel' => 'Pixel (Px)',
            'point' => 'Point (Pt)',
        ),
    );

    $of_options[] = array(
        'id'   => 'uxf_view_page',
        'desc' => 'Preview button allows you to quickly view the page',
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'name' => 'Default Font Family',
        'id'   => 'uxf_font_family',
        'std'  =>  '',
        'type' => 'text',
    );

    $of_options[] = array(
        'name'    => 'Allow SVG & Webp',
        'id'   => 'uxf_allow_svg',
        'desc' => 'Enable SVG & Webp Support',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'name'    => 'Customize CSS',
        'id'   => 'back_to_top_progress',
        'desc' => 'Scroll To Top with Progress Indicator',
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_totop',
        'desc' => 'Back To Top',
        'std'  => 0,
        'folds' => 1,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'      => 'back_to_top_bg',
        'std'     => '',
        'fold' => 'uxf_totop',
        'type'    => 'select',
        'options' => array(
            ''  => '-- Background --',
            'primary'  => 'Primary',
            'secondary'  => 'Secondary',
            'white'  => 'White',
            'transparent'  => 'Transparent',
        ),
    );
    
    $of_options[] = array(
        'id'      => 'back_to_top_icon',
        'std'     => '',
        'fold' => 'uxf_totop',
        'type'    => 'select',
        'options' => array(
            ''  => '-- Color --',
            'light'  => 'Light',
            'dark'  => 'Dark',
        ),
    );
    
    $of_options[] = array(
        'id'      => 'back_to_top_size',
        'std'     => '',
        'fold' => 'uxf_totop',
        'type'    => 'select',
        'options' => array(
            ''  => '-- Size --',
            'is-large' => 'Large',
            'is-larger' => 'Larger',
            'is-xlarge' => 'X-Large',
            'is-xxlarge' => 'XX-Large',
        ),
    );
    
    $of_options[] = array(
        'id'   => 'uxf_social',
        'desc' => 'Social Icons Hover',
        'std'  => 0,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'id'   => 'uxf_btn',
        'desc' => 'Custom Button',
        'std'  => 0,
        'folds' => 1,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'id'   => 'uxf_btn_hover',
        'desc'  => 'Button Shadow Hover',
        'type' => 'color',
        'fold' => 'uxf_btn',
    );
    
    $of_options[] = array(
        'id'   => 'uxf_btn_gradient',
        'desc' => 'Button Gradient',
        'type' => 'color',
        'fold' => 'uxf_btn',
    );

    $of_options[] = array(
        'id'   => 'uxf_tag_hover',
        'desc' => 'Fix Tag Hover',
        'std'  => 0,
        'type' => 'checkbox',
    );

    $of_options[] = array(
        'id'   => 'uxf_transition',
        'desc' => 'Transition Hover',
        'std'  => 0,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'id'   => 'uxf_tooltips',
        'desc' => 'Tooltips (Hidden / Custom)',
        'std'  => 0,
        'folds' => 1,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'id'   => 'uxf_tooltips_hidden',
        'desc' => 'Tooltips Hidden',
        'std'  => 0,
        'type' => 'checkbox',
        'fold' => 'uxf_tooltips',
    );

    $of_options[] = array(
        'id'   => 'uxf_tooltips_color',
        'std'  => '',
        'type' => 'color',
        'fold' => 'uxf_tooltips',
    );
    
    $of_options[] = array(
        'id'   => 'uxf_contact_fixed',
        'desc' => 'Contact All in One',
        'std'  => 0,
        'type' => 'checkbox',
    );
    
    $of_options[] = array(
        'name' => 'Disable Header',
        'id'   => 'uxf_header_disable',
        'std'     => '',
        'type'    => 'select',
        'options' => array(
            ''  => '-- None --',
            'top' => 'Top Bar - Sticky on Scroll',
            'main' => 'Header Main - Sticky on Scroll',
            'bottom' => 'Header Bottom - Sticky on Scroll',
        ),
    );
 
    $of_options[] = array(
        'name' => 'Site Loader Image',
        'desc' => 'Upload or choose a custom loader image (GIF, SVG)',
        'id'   => 'site_loader_img',
        'std'  => '',
        'type' => 'upload',
    );
        
    $of_options[] = array(
        'name' => 'Search Typing Animation',
        'desc' => 'Change the search multiple field placeholder.',
        'id'   => 'search_typing',
        'std'  => '',
        'type' => 'textarea',
    );
    
    // Yoast options.
	if ( class_exists( 'WPSEO_Options' ) ) {
        $of_options[] = array(
            'name' => 'Yoast SEO',
            'id'   => 'wpseo_manages_post_layout_priority',
            'desc' => 'Manage custom post layout priority.',
            'std'  => 0,
            'type' => 'checkbox',
        );
        $of_options[] = array(
            'name' => '',
            'id'   => 'wpseo_breadcrumb_post_remove_last',
            'desc' => 'Remove the last static crumb on single post (post title).',
            'std'  => 1,
            'fold' => 'wpseo_breadcrumb',
            'type' => 'checkbox',
        );
        $of_options[] = array(
            'name' => '',
            'id'   => 'wpseo_title_shortcode',
            'desc' => 'Add shortcode [day] [month] [year] to title',
            'std'  => 0,
            'type' => 'checkbox',
        );
    }
    
    // Rank Math options.
	if ( class_exists( 'RankMath' ) ) {
        $of_options[] = array(
            'name' => 'Rank Math',
            'id'   => 'rank_math_manages_post_layout_priority',
            'desc' => 'Manage custom post layout priority.',
            'std'  => 0,
            'type' => 'checkbox',
        );
        $of_options[] = array(
            'name' => '',
            'id'   => 'rank_math_title_shortcode',
            'desc' => 'Add shortcode [day] [month] [year] to title',
            'std'  => 0,
            'type' => 'checkbox',
        );
    }

}