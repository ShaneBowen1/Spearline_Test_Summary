<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserSession Controller
 *
 * @property \App\Model\Table\UserSessionTable $UserSession
 */
class UserSessionController extends AppController
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
        $userSession = $this->paginate($this->UserSession);

        $this->set(compact('userSession'));
        $this->set('_serialize', ['userSession']);
    }

    /**
     * View method
     *
     * @param string|null $id User Session id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // $userSession = $this->UserSession->get($id, [
        //     'contain' => ['User', 'SpearlineApplication']
        // ]);

        // $this->set('userSession', $userSession);
        // $this->set('_serialize', ['userSession']);

        $ids = explode('-', $id);
        $userId = $ids[0];
        $appId = $ids[1];

        $query = $this->UserSession->find('all', ['contain' => ['User', 'SpearlineApplication']])->where(['User.id' => $userId,'SpearlineApplication.id' => $appId]);

        $userSession = $query->first();
        if(!$userSession){
            $this->Flash->error(__('What you search is not here!'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set('userSession', $userSession);
        $this->set('_serialize', ['userSession']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userSession = $this->UserSession->newEntity();
        if ($this->request->is('post')) {
            $userSession = $this->UserSession->patchEntity($userSession, $this->request->data);
            if ($this->UserSession->save($userSession)) {
                $this->Flash->success(__('The user session has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user session could not be saved. Please, try again.'));
            }
        }
        $user = $this->UserSession->User->find('list', ['limit' => 200]);
        $spearlineApplication = $this->UserSession->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('userSession', 'user', 'spearlineApplication'));
        $this->set('_serialize', ['userSession']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Session id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        /*$userSession = $this->UserSession->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userSession = $this->UserSession->patchEntity($userSession, $this->request->data);
            if ($this->UserSession->save($userSession)) {
                $this->Flash->success(__('The user session has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user session could not be saved. Please, try again.'));
            }
        }
        $user = $this->UserSession->User->find('list', ['limit' => 200]);
        $spearlineApplication = $this->UserSession->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('userSession', 'user', 'spearlineApplication'));
        $this->set('_serialize', ['userSession']);*/

        $ids = explode('-', $id);
        $userId = $ids[0];
        $appId = $ids[1];

        $query = $this->UserSession->find('all', ['contain' => ['User', 'SpearlineApplication']])->where(['User.id' => $userId,'SpearlineApplication.id' => $appId]);

        $userSession = $query->first();
        if(!$userSession){
            $this->Flash->error(__('What you search is not here!'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userSession = $this->UserSession->patchEntity($userSession, $this->request->data);
            if ($this->UserSession->save($userSession)) {
                $this->Flash->success(__('The user session has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user session could not be saved. Please, try again.'));
            }
        }
        $user = $this->UserSession->User->find('list', ['limit' => 200]);
        $spearlineApplication = $this->UserSession->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('userSession', 'user', 'spearlineApplication'));
        $this->set('_serialize', ['userSession']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Session id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        /*$this->request->allowMethod(['post', 'delete']);
        $userSession = $this->UserSession->get($id);
        if ($this->UserSession->delete($userSession)) {
            $this->Flash->success(__('The user session has been deleted.'));
        } else {
            $this->Flash->error(__('The user session could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);*/


        $ids = explode('-', $id);
        $userId = $ids[0];
        $appId = $ids[1];

        $query = $this->UserSession->find('all', ['contain' => ['User', 'SpearlineApplication']])->where(['User.id' => $userId,'SpearlineApplication.id' => $appId]);

        $userSession = $query->first();
        if(!$userSession){
            $this->Flash->error(__('What you search is not here!'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->UserSession->delete($userSession)) {
            $this->Flash->success(__('The user session has been deleted.'));
        } else {
            $this->Flash->error(__('The user session could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
        
    }
}
