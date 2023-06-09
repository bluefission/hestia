<?php

use BlueFission\Framework\Datasource\Delta;
use BlueFission\Data\Storage\Structure\MysqlStructure as Structure;
use BlueFission\Data\Storage\Structure\MysqlScaffold as Scaffold;

class ScaffoldPageTable extends Delta
{
    public function change()
    {
        Scaffold::create('pages', function (Structure $entity) {
            $entity->incrementer('page_id');
            $entity->text('title');
            $entity->text('slug');
            $entity->text('uri');
            $entity->text('keywords')->null();
            $entity->text('description')->null();
            $entity->numeric('is_published', 1)->default(0);
            $entity->numeric('is_autogenerated', 1)->default(0);
            $entity->text('template');
            $entity->text('content', 10240)->null();
            $entity->timestamps();
            $entity->comment("The table containing web page content.");
        });
    }

    public function revert()
    {
        Scaffold::delete('pages');
    }
}