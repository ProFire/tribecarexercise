<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class FlatUnitsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior("Timestamp");

        $this->belongsTo("FlatBlocks");

        $this->hasMany("Tenants")
            ->setDependent(true)
        ;
        $this->hasMany("Visitors")
            ->setDependent(true)
        ;
    }

    /**
     * Validation
     */
    public function validationDefault(Validator $validator): Validator
    {
        // unit
        $validator
            ->requirePresence('unit', 'create')
            ->notEmptyString('unit')
            ->add("unit", "maxLength", [
                "rule" => ["maxLength", 20]
            ])
        ;

        return $validator;
    }

    /**
     * Rules
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(
            ['unit', 'flat_block_id'],
            "This unit for the block already exist in database."
        ));

        $rules->add($rules->existsIn('flat_block_id', 'FlatBlocks'));

        return $rules;
    }
}