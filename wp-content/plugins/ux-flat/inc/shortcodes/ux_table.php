<?php
// [table]
function ux_table( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'id' => 'table-'.rand(),
		'class'				=> '',
		'visibility'	=> '',
		'thead'         => 'false',
		'thead_bg_color'  => '',
		'thead_text_color'   => '',
		'sticky'         => 'false',
		'sticky_bg_color'  => '',
		'sticky_text_color'   => '',
		'tfoot'         => 'false',
		'tfoot_bg_color'  => '',
		'tfoot_text_color'   => '',
		'letter_case'   => '',
		'text_padding'   => '',
		'border_color'   => '',
		'border_width'   => '1px',
		'table_height'   => '',
		'table_width'   => '',
		'odd_bg_color'   => '',
		), $atts )
	);

	if($visibility == 'hidden') return;

	$classes     = array( 'table-scroll' );
	
	if( $class ) $classes[] = $class;
	if( $visibility ) $classes[] = $visibility;
	$classes    = implode( ' ', $classes );
	ob_start();
	?>
	<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>

<style>
<?php echo '#'.esc_attr($id); ?> {
    position: relative;
    width: 100%;
    z-index: 1;
    margin: auto;
    overflow: auto;
}
<?php echo '#'.esc_attr($id); ?> table {
    width: 100%;
    margin: auto;
    border-collapse: separate;
    border-spacing: 0
}
<?php if($text_padding){ ?>
<?php echo '#'.esc_attr($id); ?> table td,
<?php echo '#'.esc_attr($id); ?> table th {
    padding: <?php echo esc_attr($text_padding); ?>;
    border-style: solid;
    vertical-align: middle;
}
<?php } ?>
<?php if($border_color){ ?>
<?php echo '#'.esc_attr($id); ?> table td,
<?php echo '#'.esc_attr($id); ?> table th {
    border-color: <?php echo esc_attr($border_color); ?>;
}
<?php } ?>
<?php if($border_width){ ?>
<?php echo '#'.esc_attr($id); ?> table td,
<?php echo '#'.esc_attr($id); ?> table th {
    border-width: <?php echo esc_attr($border_width); ?>;
}
<?php } ?>
<?php if($table_height){ ?>
<?php echo '#'.esc_attr($id); ?> {
    height: <?php echo esc_attr($table_height); ?>
}
<?php } ?>
<?php if($table_width){ ?>
<?php echo '#'.esc_attr($id); ?> table {
    min-width: <?php echo esc_attr($table_width); ?>;
}
<?php } ?>
<?php if($letter_case){ ?>
<?php echo '#'.esc_attr($id); ?> table thead th, <?php echo '#'.esc_attr($id); ?> table tfoot th, <?php echo '#'.esc_attr($id); ?> table td:nth-child(1) {
    text-transform: <?php echo esc_attr($letter_case); ?>;
}
<?php } ?>
<?php if($odd_bg_color){ ?>
<?php echo '#'.esc_attr($id); ?> table tr:nth-child(odd) {
    background: <?php echo esc_attr($odd_bg_color); ?>;
}
<?php } ?>
<?php if($thead == "true"){ ?>
<?php echo '#'.esc_attr($id); ?> table thead th {
    background: <?php echo esc_attr($thead_bg_color); ?>;
    color: <?php echo esc_attr($thead_text_color); ?>;
}
<?php echo '#'.esc_attr($id); ?> table thead th {
    top: 0;
    position: -webkit-sticky;
    position: sticky;
    z-index: 2;
}
<?php } ?>
<?php if($sticky == "true"){ ?>
<?php echo '#'.esc_attr($id); ?> table tfoot th:nth-child(1),
<?php echo '#'.esc_attr($id); ?> table thead th:nth-child(1) {
    z-index: 3 !important;
    left: 0 !important;
    background: <?php echo esc_attr($sticky_bg_color); ?> !important;
    color: <?php echo esc_attr($sticky_text_color); ?> !important;
    position: -webkit-sticky;
    position: sticky;
}
<?php echo '#'.esc_attr($id); ?> table td:nth-child(1) {
    position: -webkit-sticky;
    position: sticky;
    left: 0;
    z-index: 2;
}
<?php echo '#'.esc_attr($id); ?> table td:nth-child(1) {
    background: <?php echo esc_attr($sticky_bg_color); ?>;
    color: <?php echo esc_attr($sticky_text_color); ?>;
}
<?php } ?>
<?php if($tfoot == "true"){ ?>
<?php echo '#'.esc_attr($id); ?> table tfoot th {
    background: <?php echo esc_attr($tfoot_bg_color); ?>;
    color: <?php echo esc_attr($tfoot_text_color); ?>;
}
<?php echo '#'.esc_attr($id); ?> table tfoot th {
    bottom: 0;
    position: -webkit-sticky;
    position: sticky;
    z-index: 2;
}
<?php } ?>
</style>
    
	<?php
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode( 'ux_table', 'ux_table' );
