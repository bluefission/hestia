<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\InitiativePrivacyType;
use App\Domain\Initiative\Models\InitiativePrivacyTypeModel;

interface IInitiativePrivacyTypeRepository
{
    public function find($id);
    public function save(InitiativePrivacyType $initiative_privacy_type);
    public function remove(InitiativePrivacyType $initiative_privacy_type);
}