<?php

namespace App\Domain\Communication\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class CommunicationStatusModel extends Model
{
    protected $_table = ['communication_statuses'];
    protected $_fields = [
        'communication_status_id',
        'name',
        'label',
    ];
}
