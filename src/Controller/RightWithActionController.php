<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RightWithAction Controller
 *
 * @property \App\Model\Table\RightWithActionTable $RightWithAction
 *
 * @method \App\Model\Entity\RightWithAction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RightWithActionController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Right', 'PlatformAction']
        ];
        $rightWithAction = $this->paginate($this->RightWithAction);

        $this->set(compact('rightWithAction'));
    }

    /**
     * View method
     *
     * @param string|null $id Right With Action id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rightWithAction = $this->RightWithAction->get($id, [
            'contain' => ['Right', 'PlatformAction']
        ]);

        $this->set('rightWithAction', $rightWithAction);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rightWithAction = $this->RightWithAction->newEntity();
        if ($this->request->is('post')) {
            $rightWithAction = $this->RightWithAction->patchEntity($rightWithAction, $this->request->getData());
            if ($this->RightWithAction->save($rightWithAction)) {
                $this->Flash->success(__('The right with action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The right with action could not be saved. Please, try again.'));
        }
        $right = $this->RightWithAction->Right->find('list', ['limit' => 200]);
        $platformAction = $this->RightWithAction->PlatformAction->find('list', ['limit' => 200]);
        $this->set(compact('rightWithAction', 'right', 'platformAction'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Right With Action id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rightWithAction = $this->RightWithAction->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rightWithAction = $this->RightWithAction->patchEntity($rightWithAction, $this->request->getData());
            if ($this->RightWithAction->save($rightWithAction)) {
                $this->Flash->success(__('The right with action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The right with action could not be saved. Please, try again.'));
        }
        $right = $this->RightWithAction->Right->find('list', ['limit' => 200]);
        $platformAction = $this->RightWithAction->PlatformAction->find('list', ['limit' => 200]);
        $this->set(compact('rightWithAction', 'right', 'platformAction'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Right With Action id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rightWithAction = $this->RightWithAction->get($id);
        if ($this->RightWithAction->delete($rightWithAction)) {
            $this->Flash->success(__('The right with action has been deleted.'));
        } else {
            $this->Flash->error(__('The right with action could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
