<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Rule\IsUnique;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class FlatBlocksTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior("Timestamp");

        $this->hasMany("FlatUnits")
            ->setDependent(true)
        ;
    }

    public function validationDefault(Validator $validator): Validator
    {
        // block
        $validator
            ->requirePresence('block', 'create')
            ->notEmptyString('block')
            ->add("block", "maxLength", [
                "rule" => ["maxLength", 20]
            ])
        ;

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Add a rule that is applied for create and update operations
        $rules->add($rules->isUnique(['block']));

        return $rules;
    }
}