<?php

namespace App\Domain\AddOn\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class AddOnModel extends Model
{
    protected $_table = ['addons'];
    protected $_fields = [
        'addon_id',
        'name',
        'version',
        'is_active',
        'primary_file',
        'namespace',
        'path',
    ];

    public function getActivatedAddOns()
    {
        $this->assign(['is_active' => 1]);
        return $this->all();
    }
}
