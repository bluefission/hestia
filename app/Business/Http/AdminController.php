<?php
namespace App\Business\Http;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use BlueFission\Framework\Auth as Authenticator;

use BlueFission\Data\Storage\Storage;

class AdminController extends Service {

	public function index( Storage $datasource ) 
    {
        $auth = new Authenticator( $datasource );

        if ( $auth->isAuthenticated() ) {
            // globals('sideNav', $navMenuManager->renderMenu('sideNav'));
            $navMenuManager = instance('nav');
            $sideNav = $navMenuManager->renderMenu('sidebar');
            return template('default', 'admin/default.html', ['csrf_token'=>store('_token'), 'side-nav'=>$sideNav, 'title'=>env('APP_NAME')." Admin"]);
        } else {
            return template('default', 'admin/login.html', ['csrf_token'=>store('_token')]);
        }
    }

    public function dashboard( ) 
    {
        return template('default', 'admin/panels/dashboard.html');
    }

    public function users( ) 
    {
        return template('default', 'admin/panels/users.html', ['realname'=>'System Admin']);
    }

    public function addons( ) 
    {
        return template('default', 'admin/panels/addons.html');
    }

    public function content( ) 
    {
        return template('default', 'admin/panels/content.html');
    }

    public function terminal( ) 
    {
        return template('default', 'admin/panels/terminal.html');
    }

    public function registration( ) 
    {
        return template('default', 'admin/register.html');
    }

    public function forgotpassword( ) 
    {
        return template('default', 'admin/forgotpassword.html');
    }
}