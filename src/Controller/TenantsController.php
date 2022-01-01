<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class TenantsController extends AppController
{
    public function view(int $id): ?Response
    {
        $tenantEntity = $this->Tenants->get($id, [
            "contain" => [
                "FlatUnits" => [
                    "FlatBlocks"
                ],
            ],
        ]);
        $this->set("tenantEntity", $tenantEntity);
        return $this->render();
    }

    public function add(int $flatUnitId): ?Response
    {
        $tenantEntity = $this->Tenants->newEmptyEntity();

        if ($this->request->is('post')) {
            $tenantEntity = $this->Tenants->patchEntity($tenantEntity, $this->request->getData());

            if ($this->Tenants->save($tenantEntity)) {
                $this->Flash->success(__("Tenant added successfully"));
                return $this->redirect(["controller" => "FlatUnits", "action" => "view", $flatUnitId]);
            }
            $this->Flash->error(__("Tenant could not be added"));
        }

        $this->set("flatUnitId", $flatUnitId);
        $this->set("tenantEntity", $tenantEntity);

        return $this->render();
    }

    public function edit(int $id): ?Response
    {
        $tenantEntity = $this->Tenants->get($id, [
            "contain" => [
                "FlatUnits",
            ],
        ]);

        if ($this->request->is(["post", "put"])) {
            $tenantEntity = $this->Tenants->patchEntity($tenantEntity, $this->request->getData());

            if ($this->Tenants->save($tenantEntity)) {
                $this->Flash->success(__("Tenant edited successfully"));
                return $this->redirect(["controller" => "FlatUnits", "action" => "view", $tenantEntity->flat_unit->id]);
            }
            $this->Flash->error(__("Tenant could not be edited"));
        }

        $this->set("tenantEntity", $tenantEntity);

        return $this->render();
    }

    public function delete(int $id): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);

        $tenantEntity = $this->Tenants->get($id, [
            "contain" => [
                "FlatUnits",
            ],
        ]);
        
        if ($this->Tenants->delete($tenantEntity)) {
            $this->Flash->success(__('Tenant {0} have been deleted.', $tenantEntity->name));
            return $this->redirect(["controller" => "FlatUnits", 'action' => 'view', $tenantEntity->flat_unit->id]);
        }
    }
}