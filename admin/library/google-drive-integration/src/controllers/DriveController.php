<?php

namespace App\Controllers;

use App\Models\DriveModel;

class DriveController
{
    protected $driveModel;

    public function __construct()
    {
        $this->driveModel = new DriveModel();
    }

    public function fetchFiles()
    {
        $files = $this->driveModel->getFiles();
        $this->renderView($files);
    }

    protected function renderView($files)
    {
        include '../views/index.php';
    }
}