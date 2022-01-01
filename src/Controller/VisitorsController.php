<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class VisitorsController extends AppController
{
    /**
     * CRUD op: Listing of Visitors
     */
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

    /**
     * CRUD op: Viewing a single Visitor
     */
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

    /**
     * CRUD op: Adding a new Visitor
     */
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
                $this->set("success", true);
                $this->set("visitorEntity", $visitorEntity);
                return $this->render();
            }
            if (!$this->request->is('ajax')) {
                $this->Flash->error(__("Visitor could not be added"));
            }
        }

        $this->set("success", false);
        $this->set("flatUnitId", $flatUnitId);
        $this->set("visitorEntity", $visitorEntity);

        return $this->render();
    }

    /**
     * CRUD op: Editing an existing Visitor
     */
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

    /**
     * CRUD op: Deleting a Visitor
     * Warning: This is a destruction act
     * Security: Only POST and DELETE methods are allowed to prevent web crawler from deleting Visitors
     */
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

    /**
     * This is a single action to check out a visitor
     */
    public function checkOut(int $id): ?Response
    {
        $visitorEntity = $this->Visitors->get($id);
        $visitorEntity = $this->Visitors->checkOut($visitorEntity);
        return $this->redirect($this->referer(["action" => "index", $visitorEntity->flat_unit_id]));
    }

    /**
     * This is the visitor's portal to show the incoming visitors to check in or out
     * This is a single page application for the visitor
     */
    public function visitorPortal(): ?Response
    {
        return $this->render();
    }

    /**
     * A single ajax action to checkout visitors based on NRIC and contact
     * 
     * @param string contact The POST must contain contact
     * @param string nric The POST must contain nric
     */
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