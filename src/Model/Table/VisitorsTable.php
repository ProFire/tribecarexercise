<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Visitor;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VisitorsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior("Timestamp", [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                    'check_in' => 'new',
                ],
                'Visitor.checkIn' => [
                    'check_out' => 'always',
                ],
            ]
        ]);

        $this->belongsTo("FlatUnits");
    }

    /**
     * Validation
     */
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

        // nric
        $validator
            ->requirePresence('nric', 'create')
            ->notEmptyString('nric')
            ->add("nric", "minLength", [
                "rule" => ["minLength", 3]
            ])
            ->add("nric", "maxLength", [
                "rule" => ["maxLength", 3]
            ])
        ;

        return $validator;
    }

    /**
     * Rules
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('flat_unit_id', 'FlatUnits'));

        $rules->add($rules->isUnique(
            ['contact', 'nric', "check_out"],
            'You are already checked in.'
        ));

        return $rules;
    }

    /**
     * Get the check in counter of a specific units
     * 
     * @param int $flatUnitId The ID of FlatUnit
     * @return int The count of check ins of the $flatUnitId
     */
    public function getCheckInCount(int $flatUnitId): int
    {
        return $this->find("all", [
            "conditions" => [
                "Visitors.check_out IS NULL",
                "Visitors.flat_unit_id" => $flatUnitId,
            ]
        ])->count();
    }

    /**
     * Check out a visitor
     * 
     * @param Visitor $entity The Visitor entity to check out
     * @return Visitor The checked out Visitor entity
     */
    public function checkOut(Visitor $entity): Visitor
    {
        $this->touch($entity, "Visitor.checkIn");
        return $this->save($entity);
    }
}