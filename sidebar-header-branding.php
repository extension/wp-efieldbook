<?php
/**
 * The masthead widget area for partnership branding
 */

if ( ! is_active_sidebar( 'sidebar-header-branding' ) ) {
	return;
}
?>

<!-- header-sidebar -->
<div id="header-branding-widget-wrapper">
<div id="header-branding-widget">
	<?php dynamic_sidebar( 'sidebar-header-branding' ); ?>
</div>
</div>
<!-- header-sidebar END -->
