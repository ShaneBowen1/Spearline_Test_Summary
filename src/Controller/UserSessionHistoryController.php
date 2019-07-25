<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserSessionHistory Controller
 *
 * @property \App\Model\Table\UserSessionHistoryTable $UserSessionHistory
 */
class UserSessionHistoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['User', 'SpearlineApplication']
        ];
        $userSessionHistory = $this->paginate($this->UserSessionHistory);

        $this->set(compact('userSessionHistory'));
        $this->set('_serialize', ['userSessionHistory']);
    }

    /**
     * View method
     *
     * @param string|null $id User Session History id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        /*$userSessionHistory = $this->UserSessionHistory->get($id, [
            'contain' => ['User', 'SpearlineApplication']
        ]);

        $this->set('userSessionHistory', $userSessionHistory);
        $this->set('_serialize', ['userSessionHistory']);*/

        $ids = explode('*', $id);
        $userId = $ids[0];
        $appId = $ids[1];
        $login = $ids[2];

        $query = $this->UserSessionHistory->find('all', ['contain' => ['User', 'SpearlineApplication']])->where(['User.id' => $userId,'SpearlineApplication.id' => $appId]);

        $userSessionHistory = $query->first();
        if(!$userSessionHistory){
            $this->Flash->error(__('What you search is not here!'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set('userSessionHistory', $userSessionHistory);
        $this->set('_serialize', ['userSessionHistory']);

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userSessionHistory = $this->UserSessionHistory->newEntity();
        if ($this->request->is('post')) {
            $userSessionHistory = $this->UserSessionHistory->patchEntity($userSessionHistory, $this->request->data);
            if ($this->UserSessionHistory->save($userSessionHistory)) {
                $this->Flash->success(__('The user session history has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user session history could not be saved. Please, try again.'));
            }
        }
        $user = $this->UserSessionHistory->User->find('list', ['limit' => 200]);
        $spearlineApplication = $this->UserSessionHistory->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('userSessionHistory', 'user', 'spearlineApplication'));
        $this->set('_serialize', ['userSessionHistory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Session History id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        /*$userSessionHistory = $this->UserSessionHistory->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userSessionHistory = $this->UserSessionHistory->patchEntity($userSessionHistory, $this->request->data);
            if ($this->UserSessionHistory->save($userSessionHistory)) {
                $this->Flash->success(__('The user session history has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user session history could not be saved. Please, try again.'));
            }
        }
        $user = $this->UserSessionHistory->User->find('list', ['limit' => 200]);
        $spearlineApplication = $this->UserSessionHistory->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('userSessionHistory', 'user', 'spearlineApplication'));
        $this->set('_serialize', ['userSessionHistory']);*/

        $ids = explode('*', $id);
        $userId = $ids[0];
        $appId = $ids[1];
        $login = $ids[2];

        $query = $this->UserSessionHistory->find('all', ['contain' => ['User', 'SpearlineApplication']])->where(['User.id' => $userId,'SpearlineApplication.id' => $appId]);

        $userSessionHistory = $query->first();
        if(!$userSessionHistory){
            $this->Flash->error(__('What you search is not here!'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $userSessionHistory = $this->UserSessionHistory->patchEntity($userSessionHistory, $this->request->data);
            if ($this->UserSessionHistory->save($userSessionHistory)) {
                $this->Flash->success(__('The user session history has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user session history could not be saved. Please, try again.'));
            }
        }
        $user = $this->UserSessionHistory->User->find('list', ['limit' => 200]);
        $spearlineApplication = $this->UserSessionHistory->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('userSessionHistory', 'user', 'spearlineApplication'));
        $this->set('_serialize', ['userSessionHistory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Session History id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        /*$this->request->allowMethod(['post', 'delete']);
        $userSessionHistory = $this->UserSessionHistory->get($id);
        if ($this->UserSessionHistory->delete($userSessionHistory)) {
            $this->Flash->success(__('The user session history has been deleted.'));
        } else {
            $this->Flash->error(__('The user session history could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);*/

        $ids = explode('*', $id);
        $userId = $ids[0];
        $appId = $ids[1];
        $login = $ids[2];

        $query = $this->UserSessionHistory->find('all', ['contain' => ['User', 'SpearlineApplication']])->where(['User.id' => $userId,'SpearlineApplication.id' => $appId]);

        $userSessionHistory = $query->first();
        if(!$userSessionHistory){
            $this->Flash->error(__('What you search is not here!'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->UserSessionHistory->delete($userSessionHistory)) {
            $this->Flash->success(__('The user session history has been deleted.'));
        } else {
            $this->Flash->error(__('The user session history could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
