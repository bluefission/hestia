// import jQuery from 'jquery'
import DashboardUI from '../../modules/dashboard-ui/dashboard-ui.js'

$( document ).ready(function() {
	DashboardUI.menuClass = '#main-menu';
	DashboardUI.subMenuClass = 'sidebar-dropdown';
	DashboardUI.menuItemActiveClass = 'active';
	DashboardUI.panel = '.content';
	DashboardUI.root = 'admin/';
	DashboardUI.home = 'dashboard';
	DashboardUI.moduleDir = '/admin/modules/';
	DashboardUI.init();

	$('#logout-btn').click(function() {
		$('#logout-form').submit();
	});
});