<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class FlatUnitsController extends AppController
{
    public function view(int $id): ?Response
    {
        $flatUnitEntity = $this->FlatUnits->get($id, [
            "contain" => [
                "FlatBlocks",
                "Tenants",
                "Visitors",
            ],
        ]);
        $this->set("flatUnitEntity", $flatUnitEntity);
        return $this->render();
    }

    public function add(int $flatBlockId): ?Response
    {
        $flatUnitEntity = $this->FlatUnits->newEmptyEntity();

        if ($this->request->is('post')) {
            $flatUnitEntity = $this->FlatUnits->patchEntity($flatUnitEntity, $this->request->getData());

            if ($this->FlatUnits->save($flatUnitEntity)) {
                $this->Flash->success(__("Unit added successfully"));
                return $this->redirect(["controller" => "FlatBlocks", "action" => "view", $flatBlockId]);
            }
            $this->Flash->error(__("Unit could not be added"));
        }

        $this->set("flatBlockId", $flatBlockId);
        $this->set("flatUnitEntity", $flatUnitEntity);

        return $this->render();
    }

    public function edit(int $id): ?Response
    {
        $flatUnitEntity = $this->FlatUnits->get($id, [
            "contain" => [
                "FlatBlocks",
                "Tenants",
                "Visitors",
            ],
        ]);

        if ($this->request->is(["post", "put"])) {
            $flatUnitEntity = $this->FlatUnits->patchEntity($flatUnitEntity, $this->request->getData());

            if ($this->FlatUnits->save($flatUnitEntity)) {
                $this->Flash->success(__("Unit edited successfully"));
                return $this->redirect(["controller" => "FlatBlocks", "action" => "view", $flatUnitEntity->flat_block->id]);
            }
            $this->Flash->error(__("Unit could not be edited"));
        }

        $this->set("flatUnitEntity", $flatUnitEntity);

        return $this->render();
    }

    public function delete(int $id): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);

        $flatUnitEntity = $this->FlatUnits->get($id, [
            "contain" => [
                "FlatBlocks",
                "Tenants",
                "Visitors",
            ],
        ]);
        
        if ($this->FlatUnits->delete($flatUnitEntity)) {
            $this->Flash->success(__('Unit {0} and its tenants and visitors have been deleted.', $flatUnitEntity->unit));
            return $this->redirect(["controller" => "FlatBlocks", 'action' => 'view', $flatUnitEntity->flat_block->id]);
        }
    }
}