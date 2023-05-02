<?php

namespace App\Domain\Email;

class Email
{
    public $email_id;
    public $account_id;
    public $from;
    public $to;
    public $cc;
    public $bcc;
    public $subject;
    public $body;
    public $attachments;
    public $headers;
    public $status;

    const DRAFT = 0;
    const SENT = 1;
}
