<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserEmailAccount Controller
 *
 * @property \App\Model\Table\UserEmailAccountTable $UserEmailAccount
 *
 * @method \App\Model\Entity\UserEmailAccount[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserEmailAccountController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['User', 'EmailServerType']
        ];
        $userEmailAccount = $this->paginate($this->UserEmailAccount);

        $this->set(compact('userEmailAccount'));
    }

    /**
     * View method
     *
     * @param string|null $id User Email Account id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userEmailAccount = $this->UserEmailAccount->get($id, [
            'contain' => ['User', 'EmailServerType']
        ]);

        $this->set('userEmailAccount', $userEmailAccount);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userEmailAccount = $this->UserEmailAccount->newEntity();
        if ($this->request->is('post')) {
            $userEmailAccount = $this->UserEmailAccount->patchEntity($userEmailAccount, $this->request->getData());
            if ($this->UserEmailAccount->save($userEmailAccount)) {
                $this->Flash->success(__('The user email account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user email account could not be saved. Please, try again.'));
        }
        $user = $this->UserEmailAccount->User->find('list', ['limit' => 200]);
        $emailServerType = $this->UserEmailAccount->EmailServerType->find('list', ['limit' => 200]);
        $this->set(compact('userEmailAccount', 'user', 'emailServerType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Email Account id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userEmailAccount = $this->UserEmailAccount->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userEmailAccount = $this->UserEmailAccount->patchEntity($userEmailAccount, $this->request->getData());
            if ($this->UserEmailAccount->save($userEmailAccount)) {
                $this->Flash->success(__('The user email account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user email account could not be saved. Please, try again.'));
        }
        $user = $this->UserEmailAccount->User->find('list', ['limit' => 200]);
        $emailServerType = $this->UserEmailAccount->EmailServerType->find('list', ['limit' => 200]);
        $this->set(compact('userEmailAccount', 'user', 'emailServerType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Email Account id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userEmailAccount = $this->UserEmailAccount->get($id);
        if ($this->UserEmailAccount->delete($userEmailAccount)) {
            $this->Flash->success(__('The user email account has been deleted.'));
        } else {
            $this->Flash->error(__('The user email account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
