<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitorsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior("Timestamp");

        $this->belongsTo("FlatUnits");
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('flat_unit_id', 'FlatUnits'));

        return $rules;
    }
}