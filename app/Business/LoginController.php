<?php
namespace App\Business;

use BlueFission\Services\Service;
use BlueFission\Services\Request;

class LoginController extends Service {

	public function index( ) 
    {
        // Whatever is there to do here?
	}

    public function login( )
    {
        return template('login.html');
    }

    public function register( )
    {
        return template('register.html');
    }

    public function forgotPassword( )
    {
        return template('forgotpassword.html');
    }
}