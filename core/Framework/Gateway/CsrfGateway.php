<?php
namespace BlueFission\Framework\Gateway;

use BlueFission\Services\Gateway;
use BlueFission\Services\Request;

class CsrfGateway extends Gateway {

    public function __construct() {}

    public function process(Request $request, &$arguments) {
        \App::instance()->validateCsrf();
    }
}
