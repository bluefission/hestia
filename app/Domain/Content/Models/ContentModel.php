<?php

namespace App\Domain\Content\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class ContentModel extends Model
{
    protected $_table = ['content'];
    protected $_fields = [
        'content_id',
        'title',
        'slug',
        'uri',
        'keywords',
        'description',
        'theme',
        'template',
        'body',
        'is_autogenerated',
        'is_published',
    ];
}