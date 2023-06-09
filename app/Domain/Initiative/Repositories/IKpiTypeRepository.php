<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\KpiType;
use App\Domain\Initiative\Models\KpiTypeModel;

interface IKpiTypeRepository
{
    public function find($id);
    public function save(KpiType $kpi_type);
    public function remove(KpiType $kpi_type);
}