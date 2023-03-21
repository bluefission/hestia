<?php

namespace App\Domain\Communication\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class CommunicationTypeModel extends Model
{
    protected $_table = ['communication_types'];
    protected $_fields = [
        'communication_type_id',
        'name',
        'label',
    ];
}
