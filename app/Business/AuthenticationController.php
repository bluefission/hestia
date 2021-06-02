<?php
namespace App\Business;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use BlueFission\Connections\Database\MysqlLink;
use BlueFission\Data\Storage\Mysql;
use BlueFission\Services\Authenticator;

class AuthenticationController extends Service {

    public function __construct( MysqlLink $link )
    {
        parent::__construct();
        $link->open();
    }

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
            if ( $remember ) {
                $auth->config('duration', 3600 * 24 * 7 * 4);
            }

            $authResult = $auth->authenticate( $username, $password );
            if ( $authResult ) {
                $setSession = $auth->setSession();
            }

            $status = $auth->status();

            $response = array( 'status'=>$status, 'data' => empty($status) ? 'true' : 'false' );
            
            return response($response);
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