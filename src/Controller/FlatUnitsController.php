<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class FlatUnitsController extends AppController
{
    public function index(): ?Response
    {
        return $this->render();
    }
}