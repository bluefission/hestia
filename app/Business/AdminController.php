<?php
namespace App\Business;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use BlueFission\Services\Authenticator;

use BlueFission\Data\Storage\Storage;

class AdminController extends Service {

	public function index( Storage $datasource ) 
    {
        return template('admin/default.html'); // Temporary
        $auth = new Authenticator( $datasource );

        if ( $auth->isAuthenticated ) {
            return template('admin/default.html');
        } else {
            return template('admin/login.html');
        }
    }

    public function dashboard( ) 
    {
        return template('admin/panels/dashboard.html');
    }

    public function users( ) 
    {
        return template('admin/panels/users.html');
    }

    public function registration( ) 
    {
        return template('admin/register.html');
    }

    public function forgotpassword( ) 
    {
        return template('admin/forgotpassword.html');
    }
}