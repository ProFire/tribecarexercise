<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class VisitorsController extends AppController
{
    public function index(int $flatUnitId): ?Response
    {
        $this->paginate = [
            'contain' => ['FlatUnits']
        ];
        $this->loadComponent('Paginator');

        $visitorEntities = $this->Paginator->paginate($this->Visitors->find()->where([
            "flat_unit_id" => $flatUnitId,
        ]));
        $this->set(compact("visitorEntities"));
        
        $flatUnitEntity = $this->Visitors->FlatUnits->get($flatUnitId, [
            "contain" => [
                "FlatBlocks"
            ],
        ]);
        $this->set("flatUnitEntity", $flatUnitEntity);

        return $this->render();
    }

    public function view(int $id): ?Response
    {
        $visitorEntity = $this->Visitors->get($id, [
            "contain" => [
                "FlatUnits" => [
                    "FlatBlocks"
                ],
            ],
        ]);
        $this->set("visitorEntity", $visitorEntity);
        return $this->render();
    }

    public function add(int $flatUnitId = null): ?Response
    {
        if ($flatUnitId === null) {
            $params = $this->request->getAttribute("params");
            $flatUnitId = $params["flat_unit_id"];
        }

        $visitorEntity = $this->Visitors->newEmptyEntity();

        if ($this->request->is('post')) {
            $visitorEntity = $this->Visitors->patchEntity($visitorEntity, $this->request->getData());

            if ($this->Visitors->save($visitorEntity)) {
                if (!$this->request->is('ajax')) {
                    $this->Flash->success(__("Visitor added successfully"));
                    return $this->redirect(["action" => "index", $flatUnitId]);
                }
                $visitorEntity = $this->Visitors->get($visitorEntity->id, [
                    "contain" => [
                        "FlatUnits",
                    ],
                ]);
                $this->set("visitorEntity", $visitorEntity);
                return $this->render();
            }
            $this->Flash->error(__("Visitor could not be added"));
        }

        $this->set("flatUnitId", $flatUnitId);
        $this->set("visitorEntity", $visitorEntity);

        return $this->render();
    }

    public function edit(int $id): ?Response
    {
        $visitorEntity = $this->Visitors->get($id, [
            "contain" => [
                "FlatUnits",
            ],
        ]);

        if ($this->request->is(["post", "put"])) {
            $visitorEntity = $this->Visitors->patchEntity($visitorEntity, $this->request->getData());

            if ($this->Visitors->save($visitorEntity)) {
                $this->Flash->success(__("Visitor edited successfully"));
                return $this->redirect(["action" => "index", $visitorEntity->flat_unit->id]);
            }
            $this->Flash->error(__("Visitor could not be edited"));
        }

        $this->set("visitorEntity", $visitorEntity);

        return $this->render();
    }

    public function delete(int $id): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);

        $visitorEntity = $this->Visitors->get($id, [
            "contain" => [
                "FlatUnits",
            ],
        ]);
        
        if ($this->Tenants->delete($visitorEntity)) {
            $this->Flash->success(__('Visitor {0} have been deleted.', $visitorEntity->name));
            return $this->redirect(['action' => 'index', $visitorEntity->flat_unit->id]);
        }
    }

    public function checkOut(int $id): ?Response
    {
        $visitorEntity = $this->Visitors->get($id);
        $visitorEntity = $this->Visitors->checkOut($visitorEntity);
        return $this->redirect($this->referer(["action" => "index", $visitorEntity->flat_unit_id]));
    }

    public function visitorPortal(): ?Response
    {
        return $this->render();
    }

    public function visitorCheckOut(): ?Response
    {
        $this->request->allowMethod(['post']);

        if ($this->request->is('post')) {
            $visitorEntities = $this->Visitors->find("all")->where([
                "Visitors.contact" => $this->request->getData("contact"),
                "Visitors.nric" => $this->request->getData("nric"),
            ]);

            foreach ($visitorEntities as $visitorEntity) {
                $visitorEntity = $this->Visitors->checkOut($visitorEntity);
            }
        }

        return $this->render();
    }
}