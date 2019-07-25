<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RemembermeToken Controller
 *
 * @property \App\Model\Table\RemembermeTokenTable $RemembermeToken
 *
 * @method \App\Model\Entity\RemembermeToken[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RemembermeTokenController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['User']
        ];
        $remembermeToken = $this->paginate($this->RemembermeToken);

        $this->set(compact('remembermeToken'));
    }

    /**
     * View method
     *
     * @param string|null $id Rememberme Token id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $remembermeToken = $this->RemembermeToken->get($id, [
            'contain' => ['User']
        ]);

        $this->set('remembermeToken', $remembermeToken);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $remembermeToken = $this->RemembermeToken->newEntity();
        if ($this->request->is('post')) {
            $remembermeToken = $this->RemembermeToken->patchEntity($remembermeToken, $this->request->getData());
            if ($this->RemembermeToken->save($remembermeToken)) {
                $this->Flash->success(__('The rememberme token has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rememberme token could not be saved. Please, try again.'));
        }
        $user = $this->RemembermeToken->User->find('list', ['limit' => 200]);
        $this->set(compact('remembermeToken', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rememberme Token id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $remembermeToken = $this->RemembermeToken->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $remembermeToken = $this->RemembermeToken->patchEntity($remembermeToken, $this->request->getData());
            if ($this->RemembermeToken->save($remembermeToken)) {
                $this->Flash->success(__('The rememberme token has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rememberme token could not be saved. Please, try again.'));
        }
        $user = $this->RemembermeToken->User->find('list', ['limit' => 200]);
        $this->set(compact('remembermeToken', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rememberme Token id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $remembermeToken = $this->RemembermeToken->get($id);
        if ($this->RemembermeToken->delete($remembermeToken)) {
            $this->Flash->success(__('The rememberme token has been deleted.'));
        } else {
            $this->Flash->error(__('The rememberme token could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
