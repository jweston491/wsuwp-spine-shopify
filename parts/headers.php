<?php $spine_main_header_values = spine_get_main_header(); ?>

<?php /* Available Values

	'site_name'				=>	$site_name,
	'site_tagline'			=>	$site_tagline,
	'page_title'			=>	$page_title,
	'post_title'			=>	$post_title,
	'section_title'			=>	$section_title,
	'subsection_title'		=>	$subsection_title,
	'posts_page_title'		=>	$posts_page_title,
	'sup_header_default'	=>	$sup_header_default,
	'sub_header_default'	=>	$sub_header_default,
	'sup_header_alternate'	=>	$sup_header_alternate,
	'sub_header_alternate'	=>	$sub_header_alternate

*/ ?>

<header class="spine-bookmark main-header">
	<div class="header-group hgroup">
		
		<sup class="sup-header" data-section="<?php echo $spine_main_header_values['section_title']; ?>" data-pagetitle="<?php echo $spine_main_header_values['page_title']; ?>" data-posttitle="<?php echo $spine_main_header_values['post_title']; ?>" data-default="<?php echo esc_attr($spine_main_header_values['sup_header_default']); ?>" data-alternate="<?php echo esc_attr($spine_main_header_values['sup_header_alternate']); ?>"><span class="sup-header-default"><?php echo $spine_main_header_values['sup_header_default']; ?></span></sup>
		<sub class="sub-header" data-sitename="<?php echo $spine_main_header_values['site_name']; ?>" data-pagetitle="<?php echo $spine_main_header_values['page_title']; ?>" data-posttitle="<?php echo $spine_main_header_values['post_title']; ?>" data-default="<?php echo esc_attr($spine_main_header_values['sub_header_default']); ?>" data-alternate="<?php echo esc_attr($spine_main_header_values['sub_header_alternate']); ?>"><span class="sub-header-default"><?php echo strip_tags($spine_main_header_values['sub_header_default'], '<a>'); ?></span></sub>
		
	</div>
</header>