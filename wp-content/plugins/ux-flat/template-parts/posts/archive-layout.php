<?php
/**
 * Category layout.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

get_header();
// Lấy thông tin category hiện tại
$current_category = get_queried_object();
if ($current_category) {
    $layout = get_term_meta($current_category->term_id, 'layout', true);
} else {
    $layout = '';
}
?>
<div id="content" class="blog-wrapper blog-archive page-wrapper">
<?php
do_action('flatsome_before_blog');
?>
<?php if(!is_single() && get_theme_mod('blog_featured', '') == 'top'){ get_template_part('template-parts/posts/featured-posts'); } ?>
<div class="row align-center">
	<div class="large-12 col">
	<?php if(!is_single() && get_theme_mod('blog_featured', '') == 'content'){ get_template_part('template-parts/posts/featured-posts'); } ?>
	<?php get_template_part( 'template-parts/posts/archive', $layout ); ?>
	</div>

</div>
<?php do_action('flatsome_after_blog'); ?>
</div>
<?php get_footer(); ?>

