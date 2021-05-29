<?php
namespace App\Business\Api;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use BlueFission\Data\Storage\Mysql;
use BlueFission\Services\Authenticator;

class AuthenticationController extends Service {

	public function login( Request $request, IUserRepository $repository ) {
        $auth = new Authenticator( $datasource );

		$login = $request->login;

        if ( $login !== false ) {

            if ( $auth->isAuthenticated() ) {
                $setSession = $auth->setSession();
                $status = $auth->getStatus();
                
                $response = array( 'status'=>$status, 'data' => $setSession);
                return json_encode($response);
            }

            $username = $request->username;
            $password = $request->password;
            $remember = $request->remember;

            if ( $remember ){
                $auth->set('sessionDuration', 3600 * 24 * 7 * 4);
            }

            $authResult = $auth->authenticate( $username, $password );
            $setSession = $auth->setSession();

            $status = $auth->getStatus();

            $response = array( 'status'=>$status, 'data' => empty($status));
            
            return json_encode($response);
        }
	}

	public function logout( Request $request, Mysql $datasource  )
    {
        $auth = new Authenticator( $datasource );

        $logout = $request->logout;

        if ( $logout !== false ) {
            $auth->destroySession();
            header("location: ".ROOT_URL);
            
            return;
        }
    }
}