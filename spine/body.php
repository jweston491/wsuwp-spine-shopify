<?php

if ( true == spine_get_option( 'crop' ) && is_front_page() ) {
	$cropping = ' cropped';
} else {
	$cropping = '';
}

?>

<div id="spine" class="spine-column <?php echo esc_attr( spine_get_option( 'spine_color' ) ); echo $cropping; echo esc_attr( spine_get_option( 'bleed' ) ); ?> shelved">
<div id="glue" class="spine-glue">

<?php get_template_part( 'spine/header' ); ?>

<?php get_template_part( 'spine/navigation' ); ?>
		
<?php get_template_part( 'spine/footer' ); ?>

</div><!--/glue-->
</div><!--/spine-->