<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\KpiCategory;
use App\Domain\Initiative\Models\KpiCategoryModel;

interface IKpiCategoryRepository
{
    public function find($id);
    public function save(KpiCategory $kpi_category);
    public function remove(KpiCategory $kpi_category);
}