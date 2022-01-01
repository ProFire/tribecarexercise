<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Visitor extends Entity
{
    public function isCheckedOut(): bool
    {
        if ($this->check_out === null)
        {
            return false;
        }
        return true;
    }
}