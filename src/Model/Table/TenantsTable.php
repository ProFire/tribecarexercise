<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TenantsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior("Timestamp");

        $this->belongsTo("FlatUnits");
    }

    public function validationDefault(Validator $validator): Validator
    {
        // name
        $validator
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add("name", "maxLength", [
                "rule" => ["maxLength", 200]
            ])
        ;

        // contact
        $validator
            ->requirePresence('contact', 'create')
            ->notEmptyString('contact')
            ->add("contact", "maxLength", [
                "rule" => ["maxLength", 20]
            ])
        ;

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(
            ["flat_unit_id", 'name', 'contact'],
            "This tenant with the same name and contact number already exist for the unit."
        ));

        $rules->add($rules->existsIn('flat_unit_id', 'FlatUnits'));

        return $rules;
    }
}