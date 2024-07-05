<?php

namespace App\Domain\Email\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class EmailAccountModel extends Model
{
    protected $_table = 'email_accounts';
    protected $_fields = [
        'account_id',
        'email_address',
        'name',
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_pass',
        'smtp_encryption',
        'imap_host',
        'imap_port',
        'imap_user',
        'imap_pass',
        'imap_encryption',
    ];
}
