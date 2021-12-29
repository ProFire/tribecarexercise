<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class FlatBlocksController extends AppController
{
    public function index(): ?Response
    {
        $this->loadComponent('Paginator');
        $flatBlockEntities = $this->Paginator->paginate($this->FlatBlocks->find());
        $this->set(compact("flatBlockEntities"));
        return $this->render();
    }

    public function view(int $id): ?Response
    {
        $flatBlockEntity = $this->FlatBlocks->get($id, [
            "contain" => [
                "FlatUnits",
            ],
        ]);
        $this->set("flatBlockEntity", $flatBlockEntity);
        return $this->render();
    }

    public function add(): ?Response
    {
        $flatBlockEntity = $this->FlatBlocks->newEmptyEntity();
        if ($this->request->is('post')) {
            $flatBlockEntity = $this->FlatBlocks->patchEntity($flatBlockEntity, $this->request->getData());

            if ($this->FlatBlocks->save($flatBlockEntity)) {
                $this->Flash->success(__("Block added successfully"));
                return $this->redirect(["action" => "index"]);
            }
            $this->Flash->error(__("Block could not be added"));
        }
        $this->set("flatBlockEntity", $flatBlockEntity);
        return $this->render();
    }

    public function edit(int $id): ?Response
    {
        $flatBlockEntity = $this->FlatBlocks->get($id);
        if ($this->request->is(['post', 'put'])) {
            $flatBlockEntity = $this->FlatBlocks->patchEntity($flatBlockEntity, $this->request->getData());

            if ($this->FlatBlocks->save($flatBlockEntity)) {
                $this->Flash->success(__("Block edited successfully"));
                return $this->redirect(["action" => "index"]);
            }
            $this->Flash->error(__("Block could not be edited"));
        }
        $this->set("flatBlockEntity", $flatBlockEntity);
        return $this->render();
    }

    public function delete(int $id): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);

        $flatBlockEntity = $this->FlatBlocks->get($id);
        if ($this->FlatBlocks->delete($flatBlockEntity)) {
            $this->Flash->success(__('Block {0} and its units, tenants, and visitors has been deleted.', $flatBlockEntity->block));
            return $this->redirect(['action' => 'index']);
        }
    }
}