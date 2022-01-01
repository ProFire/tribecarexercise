<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

class FlatUnit extends Entity
{
    public $maxVisitors = 5;

    protected $_virtual = [
        "check_in_allowed",
        'visitors_count',
    ];

    protected function _getCheckInAllowed(): bool
    {
        if ($this->_getVisitorsCount() >= $this->maxVisitors) {
            return false;
        }
        return true;
    }

    protected function _getVisitorsCount(): int
    {
        if (!$this->has("id")) {
            return 0;
        }
        $visitorsTable = TableRegistry::getTableLocator()->get("Visitors");
        return $visitorsTable->getCheckInCount($this->id);
    }
}