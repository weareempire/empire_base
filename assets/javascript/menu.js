/* ============================================================================

  SLIDE IN MENU

===============================================================================

  - Pass options to the empire Menu function

============================================================================ */

if ( 'querySelector' in document && 'addEventListener' in window && Array.prototype.forEach ) {


/* ============================================================================

  WHEN READY

============================================================================ */
	document.addEventListener( 'DOMContentLoaded' , function() {

		var body = document.body;

		if ( body.classList.contains( 'inc-menu' ) ) {

			empireMenu( {

				emp_menu_location		: false,
				emp_wp_menu				: 'wp_menu',
				emp_menu_control		: 'empireMenu',
				emp_alt_class			: true,
				emp_alt_sub_class		: true,
				emp_clean_menu			: true,
				emp_keep_original		: false,
				emp_control_push		: true,
				emp_brand_hide			: true,
				emp_page_push			: false,
				emp_z_index				: false

			} );

		}

	} );

}





