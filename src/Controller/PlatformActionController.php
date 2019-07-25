<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PlatformAction Controller
 *
 * @property \App\Model\Table\PlatformActionTable $PlatformAction
 *
 * @method \App\Model\Entity\PlatformAction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlatformActionController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PlatformController']
        ];
        $platformAction = $this->paginate($this->PlatformAction);

        $this->set(compact('platformAction'));
    }

    /**
     * View method
     *
     * @param string|null $id Platform Action id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $platformAction = $this->PlatformAction->get($id, [
            'contain' => ['PlatformController', 'RightWithAction']
        ]);

        $this->set('platformAction', $platformAction);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $platformAction = $this->PlatformAction->newEntity();
        if ($this->request->is('post')) {
            $platformAction = $this->PlatformAction->patchEntity($platformAction, $this->request->getData());
            if ($this->PlatformAction->save($platformAction)) {
                $this->Flash->success(__('The platform action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The platform action could not be saved. Please, try again.'));
        }
        $platformController = $this->PlatformAction->PlatformController->find('list', ['limit' => 200]);
        $this->set(compact('platformAction', 'platformController'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Platform Action id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $platformAction = $this->PlatformAction->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $platformAction = $this->PlatformAction->patchEntity($platformAction, $this->request->getData());
            if ($this->PlatformAction->save($platformAction)) {
                $this->Flash->success(__('The platform action has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The platform action could not be saved. Please, try again.'));
        }
        $platformController = $this->PlatformAction->PlatformController->find('list', ['limit' => 200]);
        $this->set(compact('platformAction', 'platformController'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Platform Action id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $platformAction = $this->PlatformAction->get($id);
        if ($this->PlatformAction->delete($platformAction)) {
            $this->Flash->success(__('The platform action has been deleted.'));
        } else {
            $this->Flash->error(__('The platform action could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
