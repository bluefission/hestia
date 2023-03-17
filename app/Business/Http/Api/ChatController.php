<?php
namespace App\Business\Http\Api;

use BlueFission\Framework\BaseController;
use BlueFission\Services\Request;

class ChatController extends BaseController {

    public function __construct( )
    {
        parent::__construct();
    }
    
    public function send( Request $request )
    {
        $app = \App::instance();
        $botman = $app->service('bot');

        $botman->listen();
    }
}