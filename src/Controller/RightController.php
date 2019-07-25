<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Right Controller
 *
 * @property \App\Model\Table\RightTable $Right
 *
 * @method \App\Model\Entity\Right[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RightController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $right = $this->paginate($this->Right);

        $this->set(compact('right'));
    }

    /**
     * View method
     *
     * @param string|null $id Right id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $right = $this->Right->get($id, [
            'contain' => ['RightWithAction', 'RoleWithRight']
        ]);

        $this->set('right', $right);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $right = $this->Right->newEntity();
        if ($this->request->is('post')) {
            $right = $this->Right->patchEntity($right, $this->request->getData());
            if ($this->Right->save($right)) {
                $this->Flash->success(__('The right has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The right could not be saved. Please, try again.'));
        }
        $this->set(compact('right'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Right id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $right = $this->Right->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $right = $this->Right->patchEntity($right, $this->request->getData());
            if ($this->Right->save($right)) {
                $this->Flash->success(__('The right has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The right could not be saved. Please, try again.'));
        }
        $this->set(compact('right'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Right id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $right = $this->Right->get($id);
        if ($this->Right->delete($right)) {
            $this->Flash->success(__('The right has been deleted.'));
        } else {
            $this->Flash->error(__('The right could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
