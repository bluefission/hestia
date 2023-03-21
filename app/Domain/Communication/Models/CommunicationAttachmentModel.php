<?php

namespace App\Domain\Communication\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class CommunicationAttachmentModel extends Model
{
    protected $_table = ['communication_attachments'];
    protected $_fields = [
        'communication_attachment_id',
        'communication_id',
        'file_path',
        'file_type',
    ];
}
