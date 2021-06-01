$( document ).ready(function() {
	DashboardUI.menuClass = '#main-menu';
	DashboardUI.subMenuClass = 'sidenav-second-level';
	DashboardUI.menuItemActiveClass = 'active';
	DashboardUI.root = 'admin/',
	DashboardUI.home = 'dashboard',
	DashboardUI.moduleDir = '/admin/modules/',
	DashboardUI.init();

	$('#logout-btn').click(function() {
		$('#logout-form').submit();
	});
});