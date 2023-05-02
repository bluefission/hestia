<?php
namespace App\Domain\Communication;

use BlueFission\Framework\ValueObject;

class CommunicationAttachment extends ValueObject
{
    public $communication_attachment_id;
    public $communication_id;
    public $file_path;
    public $file_type;
}

