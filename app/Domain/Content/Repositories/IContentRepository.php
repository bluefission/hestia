<?php
namespace App\Domain\Content\Repositories;

use App\Domain\Content\Content;

interface IContentRepository
{
    public function find($id);
    public function save(Content $addon);
    public function remove($id);
}