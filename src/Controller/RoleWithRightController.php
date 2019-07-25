<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RoleWithRight Controller
 *
 * @property \App\Model\Table\RoleWithRightTable $RoleWithRight
 *
 * @method \App\Model\Entity\RoleWithRight[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoleWithRightController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Role', 'Right']
        ];
        $roleWithRight = $this->paginate($this->RoleWithRight);

        $this->set(compact('roleWithRight'));
    }

    /**
     * View method
     *
     * @param string|null $id Role With Right id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roleWithRight = $this->RoleWithRight->get($id, [
            'contain' => ['Role', 'Right']
        ]);

        $this->set('roleWithRight', $roleWithRight);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roleWithRight = $this->RoleWithRight->newEntity();
        if ($this->request->is('post')) {
            $roleWithRight = $this->RoleWithRight->patchEntity($roleWithRight, $this->request->getData());
            if ($this->RoleWithRight->save($roleWithRight)) {
                $this->Flash->success(__('The role with right has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role with right could not be saved. Please, try again.'));
        }
        $role = $this->RoleWithRight->Role->find('list', ['limit' => 200]);
        $right = $this->RoleWithRight->Right->find('list', ['limit' => 200]);
        $this->set(compact('roleWithRight', 'role', 'right'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role With Right id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roleWithRight = $this->RoleWithRight->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roleWithRight = $this->RoleWithRight->patchEntity($roleWithRight, $this->request->getData());
            if ($this->RoleWithRight->save($roleWithRight)) {
                $this->Flash->success(__('The role with right has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role with right could not be saved. Please, try again.'));
        }
        $role = $this->RoleWithRight->Role->find('list', ['limit' => 200]);
        $right = $this->RoleWithRight->Right->find('list', ['limit' => 200]);
        $this->set(compact('roleWithRight', 'role', 'right'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role With Right id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roleWithRight = $this->RoleWithRight->get($id);
        if ($this->RoleWithRight->delete($roleWithRight)) {
            $this->Flash->success(__('The role with right has been deleted.'));
        } else {
            $this->Flash->error(__('The role with right could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
