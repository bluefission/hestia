<?php
namespace App\Business;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
// use App\Domain\User\Repositories\IUserRepository;
use BlueFission\Data\Storage\Mysql;
use BlueFission\Services\Authenticator;

class AuthenticationController extends Service {

	public function login( Request $request, Mysql $datasource ) {
        $auth = new Authenticator( $datasource );

		$login = $request->login;

        if ( $login !== false ) {

            if ( $auth->isAuthenticated() ) {
                $setSession = $auth->setSession();
                $status = $auth->status();
                
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

            $status = $auth->status();

            $response = array( 'status'=>$status, 'data' => empty($status));
            
            return json_encode($response);
        }
	}

	public function logout( Request $request, Mysql $datasource )
    {
        $auth = new Authenticator( $datasource );

        $logout = $request->logout;

        if ( $logout !== false ) {
            $auth->destroySession();
            return header("location: ".ROOT_URL);
        }
    }
}