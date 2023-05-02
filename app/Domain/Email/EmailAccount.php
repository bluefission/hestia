<?php

namespace App\Domain\Email;

class EmailAccount
{
    public $account_id;
    public $email_address;
    public $name;
    public $smtp_host;
    public $smtp_port;
    public $smtp_user;
    public $smtp_pass;
    public $smtp_encryption;
}
