<?php

namespace App\Domain\Email\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class EmailAttachmentModel extends Model
{
    protected $_table = 'email_attachments';
    protected $_fields = [
        'attachment_id',
        'email_id',
        'file_name',
        'file_type',
        'file_path',
    ];
}
