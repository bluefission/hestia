<?php

namespace App\Domain\Email\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class EmailModel extends Model
{
    protected $_table = 'emails';
    protected $_fields = [
        'email_id',
        'account_id',
        'from',
        'to',
        'cc',
        'bcc',
        'subject',
        'body',
        'headers',
        'status',
    ];

    public function attachments()
    {
        return $this->descendents('App\Domain\Email\Models\EmailAttachmentModel', 'email_id');
    }
}
