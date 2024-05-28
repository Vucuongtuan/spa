<?php

// [downloads_slider]
function uxf_download_shortcode($atts, $content = null, $tag = '' ) {

  extract(shortcode_atts(array(
		"_id" => 'row-'.rand(),
		'style' => '',
		'class' => '',
		'visibility' => '',

		// Layout
		"columns" => '4',
		"columns__sm" => '1',
		"columns__md" => '',
		'col_spacing' => '',
		"type" => 'slider', // slider, row, masonery, grid
		'width' => '',
		'grid' => '1',
		'grid_height' => '600px',
		'grid_height__md' => '500px',
		'grid_height__sm' => '400px',
		'slider_nav_style' => 'reveal',
		'slider_nav_position' => '',
		'slider_nav_color' => '',
		'slider_bullets' => 'false',
	 	'slider_arrows' => 'true',
		'auto_slide' => 'false',
		'slide_style' => 'normal',
		'slide_width' => '',
		'slide_align' => 'left',
		'infinitive' => 'true',
		'depth' => '',
   		'depth_hover' => '',

		// posts
		'posts' => '8',
		'ids' => false, // Custom IDs
		'cat' => '',
		'category' => '', // Added for Flatsome v2 fallback
		'excerpt' => 'visible',
		'excerpt_length' => 15,
		'offset' => '',
		'orderby' => 'date',
		'order' => 'DESC',
		'author' => '',
		'tags' => '',

		// Read more
		'readmore' => '',
		'readmore_color' => '',
		'readmore_show_date' => 'badge', // badge, text
		'readmore_badge_style' => '',
		'readmore_style' => 'outline',
		'readmore_size' => 'small',

		// div meta
		'post_icon' => 'true',
		'comments' => 'true',
		'show_date' => 'badge', // badge, text
		'badge_style' => '',
		'show_category' => 'false',
		'show_author' => 'false',
		'show_avatar' => 'visible',
    'show_price' => '',

		//Title
		'title_size' => 'large',
        'title_tag' => 'h3',
		'title_style' => '',
        'title_color' => '',

		// Box styles
		'animate' => '',
		'text_pos' => 'bottom',
	  	'text_padding' => '',
	  	'text_bg' => '',
	  	'text_size' => '',
	 	'text_color' => '',
	 	'text_hover' => '',
	 	'text_align' => 'center',
	 	'image_size' => 'medium',
	 	'image_width' => '',
	 	'image_radius' => '',
	 	'image_height' => '56%',
	    'image_hover' => '',
	    'image_hover_alt' => '',
	    'image_overlay' => '',
	    'image_direction' => '',
	    'image_depth' => '',
	    'image_depth_hover' => '',
	  	'col_padding' => '',
	  	'col_bg' => '',
		'col_bg_radius' => '',
		'v_align' => '',
	  	'divider' => '',

	), $atts));

	// Stop if visibility is hidden
  if($visibility == 'hidden') return;

	ob_start();

	$classes_box = array();
	$classes_image = array();
	$classes_image_depth = array();
	$classes_text = array();
	$classes_repeater = array( $class );

	// Fix overlay color
    if($style == 'text-overlay'){
      $image_hover = 'zoom';
    }
    $style = str_replace('text-', '', $style);

	// Fix grids
	if($type == 'grid'){
	  if(!$text_pos) $text_pos = 'center';
	  $columns = 0;
	  $current_grid = 0;
	  $grid = uxf_get_posts($grid);
	  $grid_total = count($grid);
	  uxf_get_posts_height($grid_height, $_id);
	}

	// Fix overlay
	if($style == 'overlay' && !$image_overlay) $image_overlay = 'rgba(0,0,0,.25)';

	// Set box style
	if($style) $classes_box[] = 'box-'.$style;
	if($style == 'overlay') $classes_box[] = 'dark';
	if($style == 'shade') $classes_box[] = 'dark';
	if($style == 'badge') $classes_box[] = 'hover-dark';
	if($image_direction == 'reverse') $classes_box[] = 'flex row-reverse';
	if($text_pos) $classes_box[] = 'box-text-'.$text_pos;

	if($image_hover)  $classes_image[] = 'image-'.$image_hover;
	if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
	if($image_height) $classes_image[] = 'image-cover';
    
	if($image_depth)  $classes_image_depth[] = 'box-shadow-'.$image_depth;
	if($image_depth_hover)  $classes_image_depth[] = 'box-shadow-'.$image_depth_hover.'-hover';

	// Text classes
	if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
	if($text_align) $classes_text[] = 'text-'.$text_align;
	if($text_size) $classes_text[] = 'is-'.$text_size;
	if($text_color == 'dark') $classes_text[] = 'dark';

    if($image_depth)  {
        $css_args_img = array(
          array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => 'px' ),
          array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
          array( 'attribute' => '-webkit-mask-image', 'value' => 'unset' ),
        );
    } else {
        $css_args_img = array(
          array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => 'px' ),
          array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
        );
    }

	$css_image_height = array(
        array( 'attribute' => 'padding-top', 'value' => $image_height),
        array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => 'px' ), //Fix Vertical
  	);

	$css_args = array(
      array( 'attribute' => 'background-color', 'value' => $text_bg ),
      array( 'attribute' => 'padding', 'value' => $text_padding ),
  	);

	$css_args_col = array(
    array( 'attribute' => 'background-color', 'value' => $col_bg ),
    array( 'attribute' => 'border-radius', 'value' => $col_bg_radius, 'unit' => 'px' ),
      array( 'attribute' => 'padding', 'value' => $col_padding ),
  	);

    // Add Animations
	if($animate) {$animate = 'data-animate="'.$animate.'"';}

	$classes_text = implode(' ', $classes_text);
	$classes_image = implode(' ', $classes_image);
	$classes_image_depth = implode(' ', $classes_image_depth);
	$classes_box = implode(' ', $classes_box);

	// Repeater styles
	$repeater['id'] = $_id;
	$repeater['tag'] = $tag;
	$repeater['type'] = $type;
	$repeater['class'] = implode( ' ', $classes_repeater );
	//$repeater['class'] = $class;
	$repeater['visibility'] = $visibility;
	$repeater['style'] = $style;
	$repeater['slider_style'] = $slider_nav_style;
	$repeater['slider_nav_position'] = $slider_nav_position;
	$repeater['slider_nav_color'] = $slider_nav_color;
	$repeater['slider_bullets'] = $slider_bullets;
    $repeater['auto_slide'] = $auto_slide;
    $repeater['slide_style'] = $slide_style;
    $repeater['slide_width'] = $slide_width;
    $repeater['slide_align'] = $slide_align;
	$repeater['infinitive'] = $infinitive;
	$repeater['row_spacing'] = $col_spacing;
	$repeater['row_width'] = $width;
	$repeater['columns'] = $columns;
	if ( $v_align ) $repeater['columns'] .= ' align-equal';
	$repeater['columns__md'] = $columns__md;
	$repeater['columns__sm'] = $columns__sm;
	$repeater['depth'] = $depth;
	$repeater['depth_hover'] = $depth_hover;

	$args = array(
		'post_status' => 'publish',
		'post_type' => 'download',
		'offset' => $offset,
		'cat' => $cat,
		'author' => $author,
		'tag__in' => $tags ? array_filter( array_map( 'trim', explode( ',', $tags ) ) ) : '',
		'posts_per_page' => $posts,
		'ignore_sticky_posts' => true,
		'orderby'             => $orderby,
		'order'               => $order,
	);

	// Added for Flatsome v2 fallback
	if ( get_theme_mod('flatsome_fallback', 0) && $category ) {
		$args['category_name'] = $category;
	}

	// If custom ids
	if ( !empty( $ids ) ) {
		$ids = explode( ',', $ids );
		$ids = array_map( 'trim', $ids );

		$args = array(
			'post__in' => $ids,
      		'post_type' => 'download',
			'numberposts' => -1,
			'orderby' => 'post__in',
			'posts_per_page' => 9999,
			'ignore_sticky_posts' => true,
		);

		// Include for search archive listing.
		if ( is_search() ) {
			$args['post_type'][] = 'page';
		}
	}

$recentPosts = new WP_Query( $args );

// Get repeater HTML.
get_uxf_repeater_start($repeater);

while ( $recentPosts->have_posts() ) : $recentPosts->the_post();

			$col_class    = array( 'post-item' );
			$show_excerpt = $excerpt;

			if(get_post_format() == 'video') $col_class[] = 'has-post-icon';

			if($type == 'grid'){
	        if($grid_total > $current_grid) $current_grid++;
	        $current = $current_grid-1;

	        $col_class[] = 'grid-col';
	        if($grid[$current]['height']) $col_class[] = 'grid-col-'.$grid[$current]['height'];

	        if($grid[$current]['span']) $col_class[] = 'large-'.$grid[$current]['span'];
	        if($grid[$current]['md']) $col_class[] = 'medium-'.$grid[$current]['md'];

	        // Set image size
	        if($grid[$current]['size']) $image_size = $grid[$current]['size'];

	        // Hide excerpt for small sizes
	        if($grid[$current]['size'] == 'thumbnail') $show_excerpt = 'false';
	    }

		?><div class="col <?php echo implode(' ', $col_class); ?>" <?php echo $animate;?>>
			<div class="col-inner" <?php echo get_shortcode_inline_css($css_args_col); ?>>
				<div class="box <?php echo esc_attr($classes_box); ?> box-blog-post has-hover">
          <?php if(has_post_thumbnail() && $image_height !== "0px") { ?>
  					<div class="box-image <?php echo esc_attr($classes_image_depth); ?>" <?php echo get_shortcode_inline_css($css_args_img); ?>>
  						<div class="<?php echo esc_attr($classes_image); ?>" <?php echo get_shortcode_inline_css($css_image_height); ?>>
                            <a href="<?php the_permalink() ?>" class="plain" aria-label="<?php echo esc_attr( the_title() ); ?>">
								<?php the_post_thumbnail( $image_size ); ?>
							</a>
  							<?php if($image_overlay){ ?><div class="overlay" style="background-color: <?php echo esc_attr($image_overlay);?>"></div><?php } ?>
  							<?php if($style == 'shade'){ ?><div class="shade"></div><?php } ?>
  						</div>
                        <?php if($show_category == 'badge') { ?>
                            <div class="absolute no-click x95 y5 md-x95 md-y5 lg-x95 lg-y5">
                                <div class="cat-label tag-label is-small is-bold">
                                <?php
                                    foreach((get_the_category()) as $cat) {
                                    echo $cat->cat_name . ' ';
                                }
                                ?>
                                </div>
  				            </div>
                        <?php } ?>
                        <?php if($show_author == 'badge') { ?>
                            <div class="absolute no-click x5 y95 md-x5 md-y95 lg-x5 lg-y95">
                                <div class="author-box tag-label lowercase is-smaller" style="border-radius:99px;">
                                    <div class="flex-row align-center">
                                    <?php if($show_avatar == 'visible') { ?>
                                        <div class="flex-col circle">
                                            <div class="blog-author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'flatsome_author_bio_avatar_size', 30 ) ); ?></div>
                                        </div>
                                        <div class="flex-col flex-grow badge-circle-inside mr-half">
                                            <?php the_author_meta( 'display_name' ); ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="flex-col flex-grow">
                                            <?php the_author_meta( 'display_name' ); ?>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
  				            </div>
                        <?php } ?>
  						<?php if($post_icon && get_post_format()) { ?>
  							<div class="absolute no-click x50 y50 md-x50 md-y50 lg-x50 lg-y50">
  				            	<div class="overlay-icon">
  				                    <i class="icon-play"></i>
  				                </div>
  				            </div>
  						<?php } ?>
  					</div>
          <?php } ?>
					<div class="box-text <?php echo esc_attr($classes_text); ?>" <?php echo get_shortcode_inline_css($css_args); ?>>
					<div class="box-text-inner blog-post-inner">
					<?php do_action('flatsome_blog_post_before'); ?>
					<?php if($show_category == 'label') { ?>
					<div class="cat-label tag-label is-small is-bold">
					<?php
						foreach((get_the_category()) as $cat) {
						echo $cat->cat_name . ' ';
					}
					?>
					</div>
					<?php } ?>
					<<?php echo esc_attr($title_tag); ?> class="post-title is-<?php echo $title_size; ?> <?php echo $title_style;?>">
						<a href="<?php the_permalink() ?>" class="plain"><?php the_title(); ?></a>
					</<?php echo esc_attr($title_tag); ?>>
                    <div>
                    
                    <?php if($show_author == 'text') { ?>
                        <div class="inline-block author-box" style="border-radius:99px;">
                            <div class="flex-row align-center">
                            <?php if($show_avatar == 'visible') { ?>
                                <div class="flex-col circle">
                                    <div class="blog-author-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'flatsome_author_bio_avatar_size', 22 ) ); ?></div>
                                </div>
                                <div class="flex-col flex-grow badge-circle-inside is-small is-bold">
                                    <?php the_author_meta( 'display_name' ); ?>
                                </div>
                            <?php } else { ?>
                                <div class="flex-col flex-grow is-small is-bold">
                                    <?php the_author_meta( 'display_name' ); ?>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    
					<?php if($show_category == 'text') { ?>
					<div class="cat-label inline-block is-small is-bold">
					<?php
						foreach((get_the_category()) as $cat) {
						echo $cat->cat_name . ' ';
					}
					?>
					</div>
					<?php } ?>
					<?php if((!has_post_thumbnail() && $show_date !== 'false') || $show_date == 'text') {?>
                    <div class="post-meta inline is-small op-8"><?php echo get_the_date(); ?></div><?php } ?>
                    </div>
					<?php if($divider !== 'false') { ?>
					<div class="is-divider"></div>
					<?php } ?>
					<?php if($show_excerpt !== 'false' && get_the_excerpt()) { ?>
					<p class="from_the_blog_excerpt op-8 <?php if($show_excerpt !== 'visible'){ echo 'show-on-hover hover-'.esc_attr($show_excerpt); } ?>"><?php
					  $the_excerpt  = get_the_excerpt();
					  $excerpt_more = apply_filters( 'excerpt_more', ' ...' );
					  echo flatsome_string_limit_words($the_excerpt, $excerpt_length) . $excerpt_more;
					?>
					</p>
					<?php } ?>
					<?php if($show_price !== 'false') { ?>
					<?php if ( ! edd_has_variable_prices( get_the_ID() ) ) : ?>
						<div>
						<div class="edd_price">
							<?php edd_price( get_the_ID() ); ?>
						</div>
						</div>
					<?php endif; ?>
					<div class="edd_download_buy_button">
						<?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
					</div>
					<?php } ?>
                    <?php if ( $comments == 'true' && comments_open() && '0' != get_comments_number() ) { ?>
                        <p class="from_the_blog_comments uppercase is-xsmall">
                            <?php
                                $comments_number = get_comments_number( get_the_ID() );
                            	/* translators: %s: comment count */
                                printf( _n( '%s Comment', '%s Comments', $comments_number, 'flatsome' ),
                                    number_format_i18n( $comments_number ) )
                            ?>
                        </p>
                    <?php } ?>

					<?php if($readmore) { ?>
						<a href="<?php echo get_the_permalink(); ?>" class="button <?php echo $readmore_color; ?> is-<?php echo $readmore_style; ?> is-<?php echo $readmore_size; ?> mb-0">
							<?php echo $readmore ;?>
						</a>
					<?php } ?>

					<?php do_action('flatsome_blog_post_after'); ?>

					</div>
					</div>
					<?php if(has_post_thumbnail() && ($show_date == 'badge' || $show_date == 'true')) {?>
					<?php if(!$badge_style) $badge_style = get_theme_mod('blog_badge_style', 'outline'); ?>
						<div class="badge absolute top post-date badge-<?php echo esc_attr($badge_style); ?>">
							<div class="badge-inner">
								<span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span><br>
								<span class="post-date-month is-xsmall"><?php echo get_the_time('M', get_the_ID()); ?></span>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div><?php endwhile;
wp_reset_query();
// Get repeater end.
get_flatsome_repeater_end($atts);

$content = ob_get_contents();
ob_end_clean();
return $content;
}
add_shortcode("downloads_slider", "uxf_download_shortcode");
add_shortcode("downloads_grid", "uxf_download_shortcode");
add_shortcode("ux_download", "uxf_download_shortcode");
