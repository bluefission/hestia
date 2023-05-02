<?php

namespace App\Business\Managers;

use BlueFission\Connections\Database\MysqlLink;
use BlueFission\Services\Service;
use App\Domain\AddOn\Models\AddOnModel;
use App\Domain\AddOn\AddOn;

class AddOnManager extends Service
{
    protected $model;

    public function __construct(MysqlLink $link)
    {
        $link->open();
        $this->model = new AddOnModel();
        parent::__construct();
    }

    public function install(AddOn $addOn)
    {
        $this->callHook($addOn, 'install');
        $this->model->write($addOn);
    }

    public function uninstall($addOnId)
    {
        $addOn = $this->getAddOnById($addOnId);

        // Check for and call the `uninstall` function hook
        $this->callHook($addOn, 'uninstall');

        $this->model->delete(['addon_id' => $addOnId]);
    }

    public function activate($addOnId)
    {
        $this->model->update(['addon_id' => $addOnId, 'is_active' => 1]);
    }

    public function deactivate($addOnId)
    {
        $this->model->update(['addon_id' => $addOnId, 'is_active' => 0]);
    }

    public function loadActivatedAddOns()
    {
        $addOns = $this->model->getActivatedAddOns();
        foreach ($addOns as $addOn) {
            $this->loadAddOn($addOn);
        }
    }

    protected function loadAddOn(AddOn $addOn)
    {
        $primaryFile = $addOn->path . DIRECTORY_SEPARATOR . $addOn->primaryFile;
        if (file_exists($primaryFile)) {
            require_once($primaryFile);
        }
    }

    protected function callHook(AddOn $addOn, $hook)
    {
        $primaryFile = $addOn->path . DIRECTORY_SEPARATOR . $addOn->primaryFile;
        if (file_exists($primaryFile)) {
            require_once($primaryFile);

            $hookFunction = "{$addOn->name}_{$hook}";
            if (function_exists($hookFunction)) {
                $hookFunction();
            }
        }
    }

    public function uploadAddonFile($file, $destination)
    {
        $fileSystem = new FileSystem();
        $fileSystem->upload($file, $destination);
    }

    public function moveAddonFile($source, $destination)
    {
        $fileSystem = new FileSystem();
        $fileSystem->move($source, $destination);
    }

    public function copyAddonFile($source, $destination)
    {
        $fileSystem = new FileSystem();
        $fileSystem->copy($source, $destination);
    }

    public function deleteAddonFile($path)
    {
        $fileSystem = new FileSystem();
        $fileSystem->delete($path);
    }

    public function deleteAddonDirectory($path)
    {
        $fileSystem = new FileSystem();
        $fileSystem->deleteDirectory($path);
    }

    protected function getAddOnById($addOnId)
    {
        return $this->model->read(['addon_id'=>$addOnId]);
    }
}
