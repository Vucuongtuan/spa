<?php
/**
 * Flatsome Engine Room.
 * This is where all Theme Functions runs.
 *
 * @package flatsome
 */
 
if(get_theme_mod('uxf_elements', 0)){
    add_action('wp_enqueue_scripts', 'uxf_scripts', 100);
    add_action( 'init', 'uxf_replace_shortcode' ); //after_setup_theme
    function uxf_replace_shortcode() {
        remove_shortcode('sections');
        require UXF_PATH . '/inc/shortcodes/sections.php';
        remove_shortcode('ux_banner');
        require UXF_PATH . '/inc/shortcodes/ux_banner.php';
        remove_shortcode('title');
        require UXF_PATH . '/inc/shortcodes/title.php';
        remove_shortcode('divider');
        require UXF_PATH . '/inc/shortcodes/divider.php';
        remove_shortcode('ux_image');
        require UXF_PATH . '/inc/shortcodes/ux_image.php';
        remove_shortcode('button');
        require UXF_PATH . '/inc/shortcodes/button.php';
        remove_shortcode('gallery');
        remove_shortcode('ux_gallery');
        require UXF_PATH . '/inc/shortcodes/ux_gallery.php';
        remove_shortcode('ux_slider');
        require UXF_PATH . '/inc/shortcodes/ux_slider.php';
        remove_shortcode( 'blog_posts' );
        require UXF_PATH . '/inc/shortcodes/blog_posts.php';
        remove_shortcode( 'featured_box' );
        require UXF_PATH . '/inc/shortcodes/featured_box.php';
        if(is_portfolio_activated()){
            remove_shortcode( 'portfolio' );
            remove_shortcode( 'featured_items_slider' );
            remove_shortcode( 'featured_items_grid' );
            require UXF_PATH . '/inc/shortcodes/portfolio.php';
        }
    }
    //require UXF_PATH . '/inc/shortcodes/post_type.php';
    require UXF_PATH . '/inc/helpers/helpers-shortcode.php';
    require UXF_PATH . '/inc/helpers/helpers-grid.php';
}
 
if(get_theme_mod('uxf_tables', 0)){
    require UXF_PATH . '/inc/shortcodes/ux_table.php';
}
if(get_theme_mod('uxf_icons', 0)){
    require UXF_PATH . '/inc/shortcodes/icon.php';
}
if(get_theme_mod('uxf_module', 0)){
    require UXF_PATH . '/inc/shortcodes/module.php';
}
if ( class_exists( 'Easy_Digital_Downloads' ) && get_theme_mod('uxf_download', 0)) {
    require UXF_PATH . '/inc/shortcodes/download.php';
}

// Templates
add_action( 'ux_builder_setup', function () {
    require_once UXF_PATH . '/inc/builder/helpers.php';
    if(get_theme_mod('uxf_elements', 0)){
        include UXF_PATH . '/inc/builder/shortcodes/section.php';
        include UXF_PATH . '/inc/builder/shortcodes/ux_banner.php';
        include UXF_PATH . '/inc/builder/shortcodes/title.php';
        include UXF_PATH . '/inc/builder/shortcodes/divider.php';
        include UXF_PATH . '/inc/builder/shortcodes/button.php';
        include UXF_PATH . '/inc/builder/shortcodes/ux_image.php';
        include UXF_PATH . '/inc/builder/shortcodes/ux_gallery.php';
        include UXF_PATH . '/inc/builder/shortcodes/ux_slider.php';
        include UXF_PATH . '/inc/builder/shortcodes/blog_posts.php';
        include UXF_PATH . '/inc/builder/shortcodes/featured_box.php';
        if(is_portfolio_activated()){
            include UXF_PATH . '/inc/builder/shortcodes/portfolio.php';
        }
    }
    if(get_theme_mod('uxf_icons', 0)){
        include UXF_PATH . '/inc/builder/shortcodes/icon.php';
    }
    if(get_theme_mod('uxf_module', 0)){
        include UXF_PATH . '/inc/builder/shortcodes/module.php';
    }
    if(get_theme_mod('uxf_tables', 0)){
        include UXF_PATH . '/inc/builder/shortcodes/ux_table.php';
    }
    if(get_theme_mod('uxf_lightbox', 0)){
        include UXF_PATH . '/inc/builder/shortcodes/lightbox.php';
    }
    
    if ( class_exists( 'Easy_Digital_Downloads' ) && get_theme_mod('uxf_download', 0)) {
        include UXF_PATH . '/inc/builder/shortcodes/download.php';
    }
} );

//Change Icons
if(get_theme_mod('uxf_fl_icons', 0)){
    require UXF_PATH . '/inc/helpers/helpers-icons.php';
}

// Register Scripts
function uxf_scripts() {
    if(get_theme_mod('uxf_cdn', 0)){
        wp_register_style( 'uxf-hover', '//cdn.jsdelivr.net/npm/hover.css@2.3.2/css/hover.min.css', array(), null, 'all' );
        wp_enqueue_style( 'uxf-hover' );
        wp_register_style( 'uxf-animate', '//cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css', array(), null, 'all' );
        wp_enqueue_style( 'uxf-animate' );
    } else {
        wp_register_style( 'uxf-hover', UXF_URL . 'assets/css/hover.min.css', array(), '2.3.2', 'all' );
        wp_enqueue_style( 'uxf-hover' );
        wp_register_style( 'uxf-animate', UXF_URL . 'assets/css/animate.min.css', array(), '4.1.1', 'all' );
        wp_enqueue_style( 'uxf-animate' );
    }
    wp_register_style( 'uxf-effect', UXF_URL . 'assets/css/effect.min.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'uxf-effect' );
    wp_enqueue_script( 'uxf-anidynamic', UXF_URL . 'assets/js/animate.min.js', array('jquery') );
    
    if(get_theme_mod('uxf_cdn_icon', 0)){
        $cdn_icons = get_theme_mod('uxf_cdn_iconurl');
        wp_enqueue_style('cdn-icons', $cdn_icons, array(), null, false );
    }
    
}

// Typing Search
if (get_theme_mod('search_typing')) {
    add_action('wp_enqueue_scripts', 'uxf_typed_script');
    add_action('wp_footer', 'uxf_typed_init');
    function uxf_typed_script() {
        $script_src = get_theme_mod('uxf_cdn', 0)
            ? '//cdn.jsdelivr.net/npm/mattboldt.typed.js@1.1.4/dist/typed.min.js'
            : UXF_URL . 'assets/js/typed.min.js';
        wp_enqueue_script('typed', $script_src, array('jquery'), null, false);
    }
    function uxf_typed_init() {
        $s_typing = get_theme_mod('search_typing');
        $s_arr = explode(PHP_EOL, $s_typing);
        $s_list = array_map('trim', $s_arr);
        $s_list = array_map(function ($s_text) {
            return "'{$s_text}'";
        }, $s_list);
        $s_list_str = implode(',', $s_list);
        echo "<script>jQuery(function($){ $('.search-field').typed({strings: [$s_list_str], typeSpeed: 60, backSpeed: 50, startDelay: 1200, backDelay: 400, loop: true, attr: 'placeholder'});});</script>";
    }
}

if ( get_theme_mod( 'site_loader_img' )) {
	remove_action( 'flatsome_before_header', 'flatsome_add_page_loader', 1 );
    if(!function_exists('uxf_custom_loader_img')){
        function uxf_custom_loader_img() {
            include UXF_PATH . 'template-parts/header/page-loader.php';
        }
    }
    add_action( 'flatsome_before_header', 'uxf_custom_loader_img', 0 );
}

// Add Top Link
if(get_theme_mod('uxf_totop')){
    function uxf_hide_gototop() {
        remove_action( 'flatsome_footer', 'flatsome_go_to_top');
    }
    add_action( 'init', 'uxf_hide_gototop' );
    function uxf_go_to_top(){
        include UXF_PATH . 'template-parts/footer/back-to-top.php';
    }
    add_action( 'flatsome_footer', 'uxf_go_to_top');
    
}

if (get_theme_mod( 'back_to_top_progress', 0 )) {
    function uxf_back_to_top_css() {
        $uxf_btt_css = "
        .back-to-top.button.icon {
            padding: 0 !important;
        }
        .back-to-top.button.is-outline{
            border: none !important;
        }
        .back-to-top.button i{
            top: 0 !important;
        }
        .back-to-top {
          height: 50px;
          width: 50px;
          display: none;
          place-items: center;
          border-radius: 50%;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
          cursor: pointer;
        }
        .back-to-top .icon-angle-up {
          display: block;
          height: calc(100% - 5px);
          width: calc(100% - 5px);
          background-color: #ffffff;
          border-radius: 50%;
          display: grid;
          place-items: center;
          color: #001a2e;
        }";
        wp_add_inline_style( 'flatsome-main', flatsome_minify_css($uxf_btt_css) );
    }
    add_action( 'wp_enqueue_scripts', 'uxf_back_to_top_css', 150 );
    
    function uxf_back_to_top_js() {
        wp_enqueue_script( 'scroll', UXF_URL. 'assets/js/scroll.min.js', array('jquery') );
    }
    add_action('wp_footer', 'uxf_back_to_top_js');
}


if (get_theme_mod( 'uxf_social', 0 )) {
    function uxf_social_css() {
        $ufx_so_css = ".social-icons a {
            width: 38px;
            background-color: #f6f6f6;
            height: 38px;
            line-height: 38px;
            text-align: center;
            display: inline-block;
            border-radius: 100%;
            transition: 0.3s;
            color: #6b7385;
            z-index: 2;
            position: relative;
            background: #f6f6f6;
        }
        .social-icons a::after {
            position: absolute;
            content: '';
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-color: var(--primary-color);
            transform: scale(0.5);
            opacity: 0;
            transition: 0.3s;
            border-radius: 100%;
        }
        .social-icons a:hover {
            color: #ffffff;
        }
        .social-icons a:hover::after {
            transform: scale(1);
            opacity: 1;
        }";
        wp_add_inline_style( 'flatsome-main', flatsome_minify_css($ufx_so_css) );
    }
    add_action( 'wp_enqueue_scripts', 'uxf_social_css', 150 );
}


if (get_theme_mod( 'uxf_tooltips', 0 )) {
    function uxf_tooltips_css() {
        if (get_theme_mod( 'uxf_tooltips_color')) {
        $color = get_theme_mod( 'uxf_tooltips_color' );
        $ufx_too_css = ".tooltipster-sidetip.tooltipster-default .tooltipster-box{
                background:{$color}; 
                border:2px solid {$color}; 
                box-shadow: 1px 1px 20px rgba(0, 0, 0, 0.3);
            }
            .tooltipster-content{font-family:Helvetica,Arial,sans-serif;font-size:12px;}
            .tooltipster-sidetip.tooltipster-default.tooltipster-bottom .tooltipster-arrow-background, 
            tooltipster-sidetip.tooltipster-default.tooltipster-bottom .tooltipster-arrow-border{border-bottom-color:{$color};}
            .tooltipster-sidetip.tooltipster-default.tooltipster-left .tooltipster-arrow-background, 
            .tooltipster-sidetip.tooltipster-default.tooltipster-left .tooltipster-arrow-border{border-left-color:{$color};}
            .tooltipster-sidetip.tooltipster-default.tooltipster-right .tooltipster-arrow-background,
            .tooltipster-sidetip.tooltipster-default.tooltipster-right .tooltipster-arrow-border {border-right-color:{$color};}
            .tooltipster-sidetip.tooltipster-default.tooltipster-top .tooltipster-arrow-background, 
            .tooltipster-sidetip.tooltipster-default.tooltipster-top .tooltipster-arrow-border{border-top-color:{$color};}";
        wp_add_inline_style( 'flatsome-main', flatsome_minify_css($ufx_too_css) );
        }
    }
    add_action( 'wp_enqueue_scripts', 'uxf_tooltips_css', 150 );
}

if (get_theme_mod( 'uxf_tooltips_hidden', 0 )) {
    add_filter( 'flatsome_follow_links', function ( $links, $args ) {
        foreach ( $links as $key => $link ) {
            if ( ! empty( $link['atts']['title'] ) ) {
                $links[ $key ]['atts']['title'] = null;
            }
            if ( empty( $link['atts']['class'] ) ) continue;
            $links[ $key ]['atts']['class'] = implode( ' ', array_diff( explode( ' ', $link['atts']['class'] ), array( 'tooltip' ) ) );
        }
        return $links;
    }, 10, 2 );
}

if (get_theme_mod( 'uxf_contact_fixed')) {
    function uxf_contact_fixed_css() {
        $uxf_contact_css = ".header-contact-wrapper {
                position: fixed !important;
                right: 10px;
                top: 200px;
                z-index: 9999;
            }
            .header-contact-wrapper .tooltipster-sidetip {
                pointer-events: none;
                display: none !important;
            }
            .header-contact-wrapper ul {
                display: flex;
                flex-direction: column;
                align-items: center;
                list-style: none;
                padding: 0.5rem !important;
                margin:0;
                border-radius: 3rem;
                background: #333;
            }
            .header-contact-wrapper li:not(:last-child) {
                margin-bottom: 5px;
            }
            .header-contact-wrapper li a:after {
                border-left: none !important;
            }
            .header-contact-wrapper li {
                position: relative;
                margin-left:0 !important;
                margin-right:0 !important;
            }
            .header-contact-wrapper li a img {
                width: 25px;
            }
            .header-contact-wrapper li a {
                display: flex;
                align-items: center;
                transition: color 0.3s,background 0.3s;
                border-radius: 50%;
                color: #fff;
                perspective: 200px;
                padding: 0;
                text-transform: none;
            }
            .header-contact-wrapper li i {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                font-size: 20px !important;
            }
            .header-contact-wrapper a.zalo {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .header-contact-wrapper span {
                position: absolute;
                display: block;
                padding: 10px 20px;
                right: 140%;
                top: 50%;
                transform: translate(0%,-50%) rotateY(-60deg);
                transform-origin: right;
                border-radius: 7px;
                background-color: #333;
                color: #fff;
                perspective: 300px;
                transform-style: preserve-3d;
                z-index: 1;
                opacity: 0;
                transition: opacity 0.3s,visibility 0.3s,transform 0.3s cubic-bezier(.22,.61,.36,1);
                visibility: hidden;
                backface-visibility: hidden;
                white-space: nowrap;
            }
            .header-contact-wrapper span:after {
                content: '';
                position: absolute;
                border: 10px solid transparent;
                border-left-color: #333;
                top: 50%;
                margin-top: -10px;
                right: -15px;
            }
            .header-contact-wrapper li a:focus, .header-contact-wrapper li a:hover {
                text-decoration: none;
                background: var(--primary-color);
                color: #FFF;
            }
            .header-contact-wrapper a:hover>span {
                transform: translate(0,-50%);
                opacity: 1;
                visibility: visible;
                transition: opacity 0.3s,transform 0.3s cubic-bezier(.22,.61,.36,1);
            }";
        wp_add_inline_style( 'flatsome-main', flatsome_minify_css($uxf_contact_css) );
    }
    add_action( 'wp_enqueue_scripts', 'uxf_contact_fixed_css', 150 ); 
}


function uxf_custom_css() {
    $ux_header = get_theme_mod('uxf_header_disable');
    if ($ux_header) {
        $ux_header_css = ".header-{$ux_header} {display: none;}.stuck .header-{$ux_header} {display: block;}";
        wp_add_inline_style('flatsome-main', flatsome_minify_css($ux_header_css));
    }
    $ux_family = get_theme_mod('uxf_font_family');
    if ($ux_family) {
        $ux_family_css = "body,h1,h2,h3,h4,h5,h6,.heading-font,.off-canvas-center .nav-sidebar.nav-vertical>li>a,.nav>li>a,.mobile-sidebar-levels-2 .nav>li>ul>li>a {font-family: {$font_family}}";
        wp_add_inline_style('flatsome-main', flatsome_minify_css($ux_family_css));
    }
    if (get_theme_mod('uxf_tag_hover')) {
        $ux_tag_css = ".has-hover:hover .tag-label{background-color:var(--primary-color)}";
        wp_add_inline_style('flatsome-main', flatsome_minify_css($ux_tag_css));
    }
    if (get_theme_mod('uxf_transition')) {
        $ux_transition_css = "a, .btn, button, span, p, i, input, select, textarea, li, img, *::after, *::before, h1, h2, h3, h4, h5, h6 {
            -webkit-transition: all 0.3s ease-out 0s;
            -moz-transition: all 0.3s ease-out 0s;
            -ms-transition: all 0.3s ease-out 0s;
            -o-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
        }";
        wp_add_inline_style('flatsome-main', flatsome_minify_css($ux_transition_css));
    }
    if (get_theme_mod('uxf_btn')) {
        $ux_button_css = '';
        if (get_theme_mod('uxf_btn_hover')) {
            $ux_shadow = get_theme_mod('uxf_btn_hover');
            $ux_button_css .= ".button:hover,.dark .button.is-form:hover,input[type=button]:hover,input[type=reset]:hover,input[type=submit]:hover,.is-outline:hover {
                -webkit-box-shadow: 0px 14px 20px 0px {$ux_shadow};
                -moz-box-shadow: 0px 14px 20px 0px {$ux_shadow};
                box-shadow: 0px 14px 20px 0px {$ux_shadow};
            }";
        }
        if (get_theme_mod('uxf_btn_gradient')) {
            $ux_gradient = get_theme_mod('uxf_btn_gradient');
            $ux_button_css .= ".button.primary:not(.is-outline) {
                background: linear-gradient(to right, var(--primary-color), {$ux_gradient});
                border: unset;
            } .is-outline.primary {
                background: linear-gradient(to right, var(--primary-color), {$ux_gradient});
                background-origin: border-box;
                box-shadow: inset 0 1000px white;
                border: 2px solid transparent;
              }";
        }
        wp_add_inline_style('flatsome-main', flatsome_minify_css($ux_button_css));
    }
}
add_action('wp_enqueue_scripts', 'uxf_custom_css', 150);

if(get_theme_mod('uxf_allow_svg', 0)){
    // Allow SVG
	function uxf_ignore_upload_ext($checked, $file, $filename, $mimes){
		if(!$checked['type']){
			$wp_filetype = wp_check_filetype( $filename, $mimes );
			$ext = $wp_filetype['ext'];
			$type = $wp_filetype['type'];
			$proper_filename = $filename;
			if($type && 0 === strpos($type, 'image/') && $ext !== 'svg'){
				$ext = $type = false;
			}
			$checked = compact('ext','type','proper_filename');
		}
		return $checked;
	}
	add_filter('wp_check_filetype_and_ext', 'uxf_ignore_upload_ext', 10, 4);
    
    // Allow WEBP
    function uxf_webp_upload_mimes($existing_mimes) {
        $existing_mimes['webp'] = 'image/webp';
        return $existing_mimes;
    }
    add_filter('mime_types', 'uxf_webp_upload_mimes');
    function uxf_webp_is_displayable($result, $path) {
        if ($result === false) {
            $displayable_image_types = array( IMAGETYPE_WEBP );
            $info = @getimagesize( $path );
            if (empty($info)) {
                $result = false;
            } elseif (!in_array($info[2], $displayable_image_types)) {
                $result = false;
            } else {
                $result = true;
            }
        }
        return $result;
    }
    add_filter('file_is_displayable_image', 'uxf_webp_is_displayable', 10, 2);
}

// Change Woocommerce heading tag
if(get_theme_mod('uxf_product_title')){
    add_action('woocommerce_shop_loop_item_title', 'uxf_woo_template_loop_product_title', 9 );
    function uxf_woo_template_loop_product_title() {
    	remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
        echo '<'.get_theme_mod('uxf_product_title').' class="name product-title ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">';
        woocommerce_template_loop_product_link_open();
        echo get_the_title();
        woocommerce_template_loop_product_link_close();
        echo '</'.get_theme_mod('uxf_product_title').'>';
    }
}

// Hide Category Archives
if(get_theme_mod('uxf_category_archives', 0)){
    function uxf_category_archives_text( $category_archives_text ) {
        if ( $category_archives_text == 'Category Archives: %s' ) {
            $category_archives_text = '%s';
        }
        return $category_archives_text;
    }
    add_filter( 'gettext', 'uxf_category_archives_text', 20 );
}

// Manage custom post layout priority
if(get_theme_mod('wpseo_manages_post_layout_priority', 0) || get_theme_mod('rank_math_manages_post_layout_priority', 0)){
    function get_flatsome_blog_breadcrumbs() { 
        if ( is_singular( 'post' ) || is_archive() || is_search() ) {
        ?>
            <div class="page-title-inner flex-row medium-flex-wrap container">
                <?php flatsome_breadcrumb(); ?>
            </div><?php
        }
	}
    add_action( 'flatsome_before_blog' , 'get_flatsome_blog_breadcrumbs', 10 ); 
}

// Remove the last static crumb on single post 
if(get_theme_mod('wpseo_breadcrumb_post_remove_last', 0)){
    function remove_last_crumb_blog( $crumbs ) {
        if ( is_single () && count( $crumbs ) > 1 ) {
            array_pop( $crumbs );
        }
        return $crumbs;
    }
    add_filter( 'wpseo_breadcrumb_links', 'remove_last_crumb_blog' );
}

// move category description to bottom of pages
if(get_theme_mod('uxf_category_product', 0)){
    add_action('woocommerce_archive_description', 'custom_archive_description', 2);
    function custom_archive_description(){ 
      if ( is_product_category() ){
        remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
        add_action('woocommerce_after_main_content', 'woocommerce_taxonomy_archive_description', 5 );
      }
    }
}

if(get_theme_mod('uxf_category_post', 0)){
    add_action('flatsome_before_blog', 'custom_flatsome_archive_title', 10);
    function custom_flatsome_archive_title(){ 
        remove_action('flatsome_before_blog', 'flatsome_archive_title', 15 );
        if ( get_theme_mod( 'blog_archive_title', 1 ) && ( is_archive() || is_search() ) ) {
            require UXF_PATH . '/template-parts/posts/partials/archive-title.php';
        }
    }
    
    add_action( 'flatsome_after_blog', 'custom_flatsome_archive_description', 10 );
    function custom_flatsome_archive_description() {
        if ( get_theme_mod( 'blog_archive_title', 1 ) && ( is_archive() || is_search() ) ) {
            require UXF_PATH . '/template-parts/posts/partials/archive-description.php';
        }
    }
}

if ( get_theme_mod( 'uxf_scrollpost' ) ) {
    require UXF_PATH . '/inc/extensions/flatsome-infinite-scrollpost/class-flatsome-infinite-scrollpost.php';
}

if (get_theme_mod( 'uxf_blog_layout')) {
    function blog_layout_list_css() {
        $uxf_layout_list_css = ".blog-archive .post-item:nth-child(1) .box-image {width: 50%!important;}
.blog-archive .post-item:nth-child(2), .blog-archive .post-item:nth-child(3), .blog-archive .post-item:nth-child(4), .blog-archive .post-item:nth-child(5) {    max-width: 50%; flex-basis: 50%; display: block !important;}
.blog-archive .post-item:nth-child(2) .box-text p, .blog-archive .post-item:nth-child(3) .box-text p, .blog-archive .post-item:nth-child(4) .box-text p, .blog-archive .post-item:nth-child(5) .box-text p{display:none;}
.blog-archive .box-vertical.box-image, .blog-archive .box-vertical .box-text {display: inherit;}";
        wp_add_inline_style( 'flatsome-main', flatsome_minify_css($uxf_layout_list_css) );
    }
    add_action( 'wp_enqueue_scripts', 'blog_layout_list_css', 150 ); 
}

if ( ! function_exists( 'flatsome_posted_on' )  && get_theme_mod( 'uxf_posted_on', 0 )) :

	function flatsome_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
 
        $posted_on = sprintf(
            esc_html_x( '%s', 'post date', 'flatsome' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );
 
        $byline = sprintf(
            esc_html_x( '%s', 'post author', 'flatsome' ),
            '<span class="meta-author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );
 
        /* $posted_view = sprintf(
            pvc_get_post_views()
        ); */
        
        echo '<span class="byline"><i class="icon icon-user"></i> ' . $byline . '</span> - <span class="posted-on"><i class="icon icon-clock"></i>' . $posted_on . '</span>';
	}
endif;
        
if ( get_theme_mod( 'wpseo_title_shortcode' ) || get_theme_mod( 'rank_math_title_shortcode' )) {
    add_filter( 'the_title', 'do_shortcode' );
    if ( class_exists( 'WPSEO_Options' ) ) {
        add_filter( 'wpseo_title', 'do_shortcode' );
        add_filter( 'wpseo_metadesc', 'do_shortcode' );
    }
    if ( class_exists( 'RankMath' ) ) {
        add_filter( 'rank_math/frontend/title', function( $title ) {
            $title = do_shortcode($title);
            return $title;
        });
        add_filter( 'rank_math/frontend/description', function( $description ) {
            $description = do_shortcode($description);
            return $description;
        });
    }
    add_shortcode ('year', 'get_year');
    function get_year () {
        $year= date ("Y");
        return "$year";
    }
    add_shortcode ('month', 'get_month');
    function get_month () {
        $month= date ("m");
        return "$month";
    }
    add_shortcode ('day', 'get_day');
    function get_day () {
        $day= date ("d");
        return "$day";
    }
}

if(get_theme_mod('uxf_categories', 0)){
    require UXF_PATH . '/inc/shortcodes/blog_categories.php';
    require UXF_PATH . '/inc/helpers/class.categories.php';
}

if(get_theme_mod('uxf_category_layout', 0)){
    require UXF_PATH . '/inc/helpers/class.categories-layout.php';
}
 
if(get_theme_mod('uxf_more', 0)){
    require UXF_PATH . '/inc/shortcodes/more.php';
    require UXF_PATH . '/inc/helpers/class.more.php';
}
 
if(get_theme_mod('uxf_menus', 0)){
    require UXF_PATH . '/inc/shortcodes/ux_menu.php';
}
 
if(get_theme_mod('uxf_faqs', 0)){
    require UXF_PATH . '/inc/shortcodes/faq.php';
}
 
if(get_theme_mod('uxf_iframe', 0)){
    require UXF_PATH . '/inc/shortcodes/iframe.php';
}

// Templates
add_action( 'ux_builder_setup', function () {
    if(get_theme_mod('uxf_categories', 0)){
        require UXF_PATH . '/inc/builder/shortcodes/blog_categories.php';
    }
    if(get_theme_mod('uxf_more', 0)){
        require UXF_PATH . '/inc/builder/shortcodes/more.php';
    }
    if(get_theme_mod('uxf_menus', 0)){
        require UXF_PATH . '/inc/builder/shortcodes/ux_menu.php';
    }
    if(get_theme_mod('uxf_faqs', 0)){
        require UXF_PATH . '/inc/builder/shortcodes/faq.php';
    }
    if(get_theme_mod('uxf_iframe', 0)){
        require UXF_PATH . '/inc/builder/shortcodes/iframe.php';
    }
} );

// Turbolinks
if(get_theme_mod('uxf_nprogress', 0)){
    add_action('wp_enqueue_scripts', 'uxf_nprogress_scripts');
    function uxf_nprogress_scripts() {
        if(get_theme_mod('uxf_cdn', 0)){
            wp_enqueue_style( 'nprogress-css', '//cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.css', array(), null , 'all');
            wp_enqueue_script( 'nprogress-js', '//cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.js', array('jquery'), null, false );
        } else {
            wp_enqueue_style( 'nprogress-css', UXF_URL . 'assets/css/nprogress.min.css', array(), '0.2.0', 'all');
            wp_enqueue_script( 'nprogress-js', UXF_URL . 'assets/js/nprogress.min.js', array( 'jquery' ), '0.2.0', false );
        }
    }
    add_action('wp_footer', 'uxf_nprogress_footer');
    function uxf_nprogress_footer() { ?>
        <script>NProgress.start();var interval=setInterval(function(){NProgress.inc()},1000);jQuery(window).on('load', function(){clearInterval(interval),NProgress.done()}),window.onbeforeunload=function(){console.log("triggered"),NProgress.start()};</script>
        <?php
    }
    add_action('wp_head', 'uxf_nprogress_admin_bar');
    function uxf_nprogress_admin_bar() {
        if (get_theme_mod('uxf_nprogress_bg')) {
            echo '<style>#nprogress .bar{background: '.get_theme_mod("uxf_nprogress_bg").';} #nprogress .spinner-icon {border-top-color: '.get_theme_mod("uxf_nprogress_bg").'; border-left-color: '.get_theme_mod("uxf_nprogress_bg").'; }</style>';
        }
    }
}

// Flatsome Issues
if(get_theme_mod('uxf_issues', 0)){
    add_action( 'init', 'uxf_fs_nag' );
    function uxf_fs_nag() {
        remove_action( 'admin_notices', 'flatsome_maintenance_admin_notice' );
    }
}

if(get_theme_mod('uxf_h1_hidden', 0)){
    add_action( 'flatsome_before_header', 'h1_front_page' );
    function h1_front_page() {
        if(is_front_page()){ 
            echo '<h1 class="hidden">'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</h1>';
        }
    }
}

if(get_theme_mod('uxf_post_refresh')){
    add_action('wp_head','uxf_meta_refresh', 1);
    function uxf_meta_refresh() {
        if (is_single()) {
            echo '<meta http-equiv="refresh" content="'.get_theme_mod('uxf_post_refresh').'">';
        }
    }
}

function uxf_post_after_blog() {
    if (is_single()) {
        $post_tags = get_theme_mod('uxf_post_tags');
        $post_cats = get_theme_mod('uxf_post_cats');
        $post_latest = get_theme_mod('uxf_post_latest');
        $related_title = get_theme_mod('uxf_related_title');
        $related_posts = get_theme_mod('uxf_related_posts');
        global $post;
        $tags = wp_get_post_tags($post->ID);
        if ($tags && $post_tags){
            $tag_ids = array();
            foreach($tags as $tag) $tag_ids[] = $tag->term_id;
            $args=array(
                'tag__in' => $tag_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => 12,
            );
            $tag_query = new WP_Query($args);
            if( $tag_query->have_posts() ):
                $ids = array();
                while ($tag_query->have_posts()): $tag_query->the_post();
                    array_push($ids, $post->ID);
                    endwhile; $ids = implode(',', $ids);
                    $tags_lang = __('Related Posts by Tags', 'uxflat');
                    $tags_title = str_replace("{title}", "{$tags_lang}", $related_title);
                    echo do_shortcode($tags_title);
                    $tags_posts = str_replace("]", " ids='{$ids}']", $related_posts);
                    echo do_shortcode($tags_posts);
                endif;
            wp_reset_query();
        }
        $cats = get_the_category($post->ID);
        if ($cats && $post_cats) {
            $cat_ids = array();
            foreach($cats as $cat) $cat_ids[] = $cat->term_id;
            $args=array(
                'category__in' => $cat_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=> 12,
            );
            $cat_query = new WP_Query($args);
            if( $cat_query->have_posts() ):
                $ids = array();
                while ($cat_query->have_posts()): $cat_query->the_post();
                    array_push($ids, $post->ID);
                    endwhile; $ids = implode(',', $ids);
                    $cats_lang = __('Related Posts by Category', 'uxflat');
                    $cats_title = str_replace("{title}", "{$cats_lang}", $related_title);
                    echo do_shortcode($cats_title);
                    $cats_posts = str_replace("]", " ids='{$ids}']", $related_posts);
                    echo do_shortcode($cats_posts);
                endif;
            wp_reset_query();
        }
        if ($post_latest) {
            $latest_lang = __('Latest Posts', 'uxflat');
            $latest_title = str_replace("{title}", "{$latest_lang}", $related_title);
            echo do_shortcode($latest_title);
            $ids = get_the_ID();
            $latest_posts = str_replace("]", " not_ids='{$ids}']", $related_posts);
            echo do_shortcode($latest_posts);
        }
    }
}
add_filter ('flatsome_after_blog', 'uxf_post_after_blog');

if(get_theme_mod('uxf_lightbox_close', 0)){
    add_filter( 'flatsome_lightbox_close_btn_inside', '__return_true' );
    add_filter( 'flatsome_lightbox_close_button', function ( $html ) {
        $html = '<button title="%title%" type="button" class="mfp-close">';
        $html .= '×';
        $html .= '</button>';
        return $html;
    } );
}

if(get_theme_mod('uxf_attachment_title', 0)){
    function uxf_attachment_image_titles($attr, $attachment = null){
        $attr['title'] = get_post($attachment->ID)->post_title;
        return $attr;
    }
    add_filter('wp_get_attachment_image_attributes', 'uxf_attachment_image_titles', 10, 2);
}

if (get_theme_mod( 'uxf_text_size')) {
    if ( ! function_exists( 'uxf_mce_text_sizes' ) ) {
        function uxf_mce_text_sizes( $initArray ){
            $text_size = get_theme_mod( 'uxf_text_size' );
            if ($text_size == "pixel") {
                $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 17px 18px 19px 20px 21px 24px 28px 32px 36px 40px 44px 48px 50px 56px 64px 72px";
            } elseif ($text_size == "point") {
                $initArray['fontsize_formats'] = "5pt 6pt 7pt 8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt 38pt";  
            }
            return $initArray;
        }
        add_filter( 'tiny_mce_before_init', 'uxf_mce_text_sizes', 99 );
    }
}


if(get_theme_mod('uxf_view_page', 0)){
    function custom_preview_button() {
        if ( ! isset( $_GET['app'] ) || ! isset( $_GET['type'] ) ) {
            return;
        }
        $type = sanitize_text_field( $_GET['type'] );
        if ( $type === 'editor' && isset( $_GET['post'] ) ) {
            $post_id = intval( $_GET['post'] );
            $permalink = get_permalink( $post_id );
            echo '<a style="padding: 10px 0; width: 40px; z-index: 12; position: absolute; right: 0; text-align: center;" href="' . esc_url( $permalink ) . '" target="_blank"><button type="button" class="button blank has-tooltip"><span class="dashicons dashicons-welcome-view-site"></span><div class="uxb-tooltip">' . __( 'View page' ) . '</div></button></a>';
        }
    }
    add_action( 'init', 'custom_preview_button' );
}