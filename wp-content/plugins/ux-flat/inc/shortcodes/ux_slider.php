<?php // [ux_slider]
function shortcode_uxf_slider($atts, $content=null) {

    extract( shortcode_atts( array(
        '_id' => 'slider-'.rand(),
        'timer' => '6000',
        'bullets' => 'true',
        'visibility' => '',
        'class' => '',
        'type' => 'slide',
        'bullet_style' => '',
        'auto_slide' => 'true',
        'auto_height' => 'true',
        'bg_color' => '',
        'slide_align' => 'center',
        'style' => 'normal',
        'slide_width' => '',
        'slide_width__md' => null,
        'slide_width__sm' => null,
        'arrows' => 'true',
        'pause_hover' => 'true',
        'hide_nav' => '',
        'nav_style' => 'circle',
        'nav_color' => 'light',
        'nav_size' => 'large',
        'nav_pos' => '',
        'infinitive' => 'true',
        'freescroll' => 'false',
        'parallax' => '0',
        'margin' => '',
        'margin__md' => '',
        'margin__sm' => '',
        'columns' => '1',
        'height' => '',
        'rtl' => 'false',
        'draggable' => 'true',
        'friction' => '0.6',
        'selectedattraction' => '0.1',
        'threshold' => '10',

        // Derpicated
        'mobile' => 'true',

        // UXF Option
        'ken_burns' => '',
        'slide_radius' => '',
        'slide_overflow' => '',
        'nav_position' => '',
        'nav_invert' => '',
        'nav_radius' => '',
        'arrow_shape' => '',
        'asnavfor' => '',
        'thumb_col' => '4',
        'thumb_row' => 'small',
        'thumb_align' => 'center',
        'verticle' => '',
        'verticle_width' => '20',

    ), $atts ) );

    // Stop if visibility is hidden
    if($visibility == 'hidden') return;
    if($mobile !==  'true' && !$visibility) {$visibility = 'hide-for-small';}

    ob_start();

    $wrapper_classes = array('slider-wrapper', 'relative');
    if( $class ) $wrapper_classes[] = $class;
    if( $visibility ) $wrapper_classes[] = $visibility;
    $wrapper_classes = implode(" ", $wrapper_classes);

    $classes = array('slider');

    if ($type == 'fade') $classes[] = 'slider-type-'.$type;

    // Bullet style
    if($bullet_style) $classes[] = 'slider-nav-dots-'.$bullet_style;

    // Nav style
    if($nav_style) $classes[] = 'slider-nav-'.$nav_style;

    // Nav size
    if($nav_size) $classes[] = 'slider-nav-'.$nav_size;

    // Nav Color
    if($nav_color) $classes[] = 'slider-nav-'.$nav_color;

    // Nav Position
    if($nav_pos) $classes[] = 'slider-nav-'.$nav_pos;

    // Add timer
    if($auto_slide == 'true') $auto_slide = $timer;

    // Add Slider style
    if($style) $classes[] = 'slider-style-'.$style;

    // Always show Nav if set
    if($hide_nav ==  'true') {$classes[] = 'slider-show-nav';}
    

    // Slider Nav visebility
    $is_arrows = 'true';
    $is_bullets = 'true';

    if($arrows == 'false') $is_arrows = 'false';
    if($bullets == 'false') $is_bullets = 'false';
    
    
    $is_shape = 'M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z';
    if($arrow_shape == 'style1') {
        $is_shape = 'M 10,50 L 60,100 L 60,95 L 15,50  L 60,5 L 60,0 Z';
    } elseif($arrow_shape == 'style2') {
        $is_shape = 'M 0,50 L 60,00 L 50,30 L 80,30 L 80,70 L 50,70 L 60,100 Z';
    }

    if(is_rtl()) $rtl = 'true';

    if($asnavfor ==  'true') {$classes[] = 'mb-half';}
    
    $classes_thumb = array('');
    if ($thumb_align == 'left') $classes_thumb[] = 'large-col-first';
    if ($verticle) $classes_thumb[] = 'vertical-thumbnails';
    if ($thumb_row) $classes_thumb[] = 'row-'.$thumb_row;
    

    $classes = implode(" ", $classes);
    $classes_thumb = implode(" ", $classes_thumb);

    // Inline CSS.
	$css_args = array(
		'bg_color' => array(
			'attribute' => 'background-color',
			'value'     => $bg_color,
		),
	);

	$args = array(
		'margin'      => array(
			'selector' => '',
			'property' => 'margin-bottom',
		),
		'slide_width' => array(
			'selector'  => '.ux-slider .flickity-slider > *',
			'property'  => 'max-width',
			'important' => true,
		),
        'slide_radius'     => array(
            'selector' => '.img-inner, .banner',
            'property' => 'border-radius',
            'unit'     => 'px',
        ),
        'slide_overflow'     => array(
            'selector' => '.banner',
            'property' => 'overflow',
        ),
        'nav_invert' => array(
            'selector' => '.flickity-prev-next-button svg',
			'property' => 'background-color',
        ),
        'nav_radius'     => array(
            'selector' => '.flickity-prev-next-button svg',
            'property' => 'border-radius',
            'unit'     => 'px',
        ),
	);
?>
<div class="<?php echo $wrapper_classes; ?>" id="<?php echo $_id; ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
    <div class="ux-slider <?php echo $classes; ?> <?php echo $_id; ?>"
        data-flickity-options='{
            "cellAlign": "<?php echo $slide_align; ?>",
            "imagesLoaded": true,
            "lazyLoad": 1,
            "freeScroll": <?php echo $freescroll; ?>,
            "wrapAround": <?php echo $infinitive; ?>,
            "autoPlay": <?php echo $auto_slide;?>,
            "pauseAutoPlayOnHover" : <?php echo $pause_hover; ?>,
            "prevNextButtons": <?php echo $is_arrows; ?>,
            "contain" : true,
            "adaptiveHeight" : <?php echo $auto_height;?>,
            "dragThreshold" : <?php echo $threshold ;?>,
            "percentPosition": true,
            "pageDots": <?php echo $is_bullets; ?>,
            "rightToLeft": <?php echo $rtl; ?>,
            "draggable": <?php echo $draggable; ?>,
            "selectedAttraction": <?php echo $selectedattraction; ?>,
            "parallax" : <?php echo $parallax; ?>,
            "friction": <?php echo $friction; ?>,
            "arrowShape": "<?php echo $is_shape; ?>"
        }'
        >
        <?php echo do_shortcode( $content ); ?>
    </div>
    <?php if($asnavfor ==  'true') { ?>
    <div class="ux-thumbnails <?php echo $classes_thumb; ?>"
        data-flickity-options='{
            "cellAlign": "<?php echo $thumb_align; ?>",
            "wrapAround": <?php echo $infinitive; ?>,
            "autoPlay": false,
            "prevNextButtons": false,
            "asNavFor": "<?php echo '.'.$_id;?>",
            "percentPosition": true,
            "imagesLoaded": true,
            "pageDots": false,
            "rightToLeft": <?php echo $rtl; ?>,
            "contain" : true
        }'
        >
        <?php echo do_shortcode($content); ?>
     </div>
    <?php } ?>
    <div class="loading-spin dark large centered"></div>
<style>
    <?php if ($nav_position == "top-left") { ?>
    #<?php echo $_id; ?> .flickity-prev-next-button { top: 5%; bottom: unset; } 
    #<?php echo $_id; ?> .flickity-prev-next-button.next { left: 5%; }
    <?php } elseif ($nav_position == "top-right") { ?>
    #<?php echo $_id; ?> .flickity-prev-next-button { top: 5%; bottom: unset; } 
    #<?php echo $_id; ?> .flickity-prev-next-button.previous { left: unset; right: 5%; }
    <?php } elseif($nav_position == "bottom-right") { ?>
    #<?php echo $_id; ?> .flickity-prev-next-button { top: unset; bottom: 5% } 
    #<?php echo $_id; ?> .flickity-prev-next-button.previous { left: unset; right: 5%; }
    <?php } elseif($nav_position == "bottom-center") { ?>
    #<?php echo $_id; ?> .flickity-prev-next-button { top: unset; bottom: 5%; left: 50%; } 
    #<?php echo $_id; ?> .flickity-prev-next-button, .slider-nav-outside .flickity-prev-next-button.next { left: 50%; } 
    #<?php echo $_id; ?> .flickity-prev-next-button.previous, .slider-nav-outside .flickity-prev-next-button.previous { left: 47%; }
    #<?php echo $_id; ?> .slider-nav-outside .flickity-prev-next-button { bottom: -50px; }
    <?php } elseif($nav_position == "bottom-left") { ?>
    #<?php echo $_id; ?> .flickity-prev-next-button { top: unset; bottom: 5% } 
    #<?php echo $_id; ?> .flickity-prev-next-button.next { left: 5%; }
    <?php } ?>
    <?php if($asnavfor ==  'true') { ?>
    <?php
    $flex_basis_values = [
        "4" => 25,
        "5" => 20,
        "6" => 16.6666666667,
        "7" => 14.2857142857,
        "8" => 12.5
    ];
    if (isset($thumb_col) && array_key_exists($thumb_col, $flex_basis_values)) {
        $flex_basis = $flex_basis_values[$thumb_col];
        ?>
        #<?php echo $_id; ?> .ux-thumbnails .flickity-slider .has-hover {
            flex-basis: <?php echo $flex_basis; ?>%;
            max-width: <?php echo $flex_basis; ?>%;
        }
    <?php } ?>

    <?php
    $row_spacing = [
        "collapse" => "0!important",
        "small" => "0 9.8px 19.6px",
        "xsmall" => "0 2px 3px",
        "large" => "0 30px 30px"
    ];
    if (isset($thumb_row) && array_key_exists($thumb_row, $row_spacing)) {
        $padding = $row_spacing[$thumb_row];
        ?>
        #<?php echo $_id; ?> .ux-thumbnails > .flickity-viewport > .flickity-slider > * {
            <?php if ($thumb_row == "collapse") { ?>
                padding: 0!important;
            <?php } else { ?>
                margin-bottom: 0;
                padding: <?php echo $padding; ?>;
            <?php } ?>
        }
        #<?php echo $_id; ?> .ux-thumbnails > .flickity-viewport > .flickity-slider > .banner {
            <?php if ($thumb_row != "collapse") { ?>
                margin: <?php echo $padding; ?>;
            <?php } ?>
        }
    <?php } ?>
    
    #<?php echo $_id; ?> .ux-thumbnails .img-inner, #<?php echo $_id; ?> .ux-thumbnails .banner-inner {
        background-color: #fff;
        display: block;
        overflow: hidden;
        transform: translateY(0);
    }
    #<?php echo $_id; ?> .ux-thumbnails img, #<?php echo $_id; ?> .ux-thumbnails .bg {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        margin-bottom: -5px;
        opacity: .5;
        transition: transform .6s, opacity .6s;
    }
    #<?php echo $_id; ?> .ux-thumbnails .is-nav-selected img,
    #<?php echo $_id; ?> .ux-thumbnails img:hover,
    #<?php echo $_id; ?> .ux-thumbnails .is-nav-selected .bg,
    #<?php echo $_id; ?> .ux-thumbnails .bg:hover {
        border-color: rgba(0, 0, 0, .3);
        opacity: 1;
    }
    @media screen and (min-width:850px) {
        #<?php echo $_id; ?> .vertical-thumbnails {
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        #<?php echo $_id; ?> .vertical-thumbnails .has-hover {
            left: 0 !important;
            margin-left: 1px;
            max-width: 100% !important;
            padding: 0 0 15px !important;
            position: relative !important;
            right: 0 !important;
            width: 95% !important;
        }
        #<?php echo $_id; ?> .vertical-thumbnails .img {
            min-height: 0 !important;
        }
        #<?php echo $_id; ?> .vertical-thumbnails .container { display: none; }
        #<?php echo $_id; ?> .vertical-thumbnails .banner {
            height: 150px !important;
        }
        #<?php echo $_id; ?> .vertical-thumbnails .flickity-slider,
        #<?php echo $_id; ?> .vertical-thumbnails .flickity-viewport {
            height: auto !important;
            overflow: visible !important;
            transform: none !important;
        }
    }
    <?php if ($verticle) { ?>
    #<?php echo $_id; ?> {
        display: flex;
        flex-flow: row wrap;
        width: 100%;
    }
    #<?php echo $_id; ?> .ux-slider,
    #<?php echo $_id; ?> .ux-thumbnails {
        flex-basis: <?= 100 - floatval($verticle_width) ?>%;
        max-width: <?= 100 - floatval($verticle_width) ?>%;
        padding: 0 9.8px 19.6px;
    }
    #<?php echo $_id; ?> .ux-thumbnails {
        flex-basis: <?= $verticle_width . '%' ?>;
        max-width: <?= $verticle_width . '%' ?>;
    }
    <?php } ?>
    <?php } ?>
    <?php if($ken_burns == "true") { ?>
    #<?php echo $_id; ?> .is-selected img, #<?php echo $_id; ?> .is-selected .bg {
        animation: flickity-move 20s ease;
        -ms-animation: flickity-move 20s ease;
        -webkit-animation: flickity-move 20s ease;
        -0-animation: flickity-move 20s ease;
        -moz-animation: flickity-move 20s ease;
    }
    @-webkit-keyframes flickity-move {
        0% {
        -webkit-transform-origin: bottom left;
        -moz-transform-origin: bottom left;
        -ms-transform-origin: bottom left;
        -o-transform-origin: bottom left;
        transform-origin: bottom left;
        transform: scale(1.0);
        -ms-transform: scale(1.0);
        -webkit-transform: scale(1.0);
        -o-transform: scale(1.0);
        -moz-transform: scale(1.0);
        }
        100% {
        transform: scale(1.2);
        -ms-transform: scale(1.2);
        -webkit-transform: scale(1.2);
        -o-transform: scale(1.2);
        -moz-transform: scale(1.2);
        }
    }
    <?php } ?>
</style>
    </div>
    <?php echo ux_builder_element_style_tag( $_id, $args, $atts ); ?>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode("ux_slider", "shortcode_uxf_slider");
