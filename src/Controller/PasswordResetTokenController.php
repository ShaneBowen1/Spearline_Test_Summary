<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PasswordResetToken Controller
 *
 * @property \App\Model\Table\PasswordResetTokenTable $PasswordResetToken
 *
 * @method \App\Model\Entity\PasswordResetToken[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PasswordResetTokenController extends AppController
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
        $passwordResetToken = $this->paginate($this->PasswordResetToken);

        $this->set(compact('passwordResetToken'));
    }

    /**
     * View method
     *
     * @param string|null $id Password Reset Token id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $passwordResetToken = $this->PasswordResetToken->get($id, [
            'contain' => ['User']
        ]);

        $this->set('passwordResetToken', $passwordResetToken);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $passwordResetToken = $this->PasswordResetToken->newEntity();
        if ($this->request->is('post')) {
            $passwordResetToken = $this->PasswordResetToken->patchEntity($passwordResetToken, $this->request->getData());
            if ($this->PasswordResetToken->save($passwordResetToken)) {
                $this->Flash->success(__('The password reset token has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password reset token could not be saved. Please, try again.'));
        }
        $user = $this->PasswordResetToken->User->find('list', ['limit' => 200]);
        $this->set(compact('passwordResetToken', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Password Reset Token id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $passwordResetToken = $this->PasswordResetToken->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $passwordResetToken = $this->PasswordResetToken->patchEntity($passwordResetToken, $this->request->getData());
            if ($this->PasswordResetToken->save($passwordResetToken)) {
                $this->Flash->success(__('The password reset token has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password reset token could not be saved. Please, try again.'));
        }
        $user = $this->PasswordResetToken->User->find('list', ['limit' => 200]);
        $this->set(compact('passwordResetToken', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Password Reset Token id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $passwordResetToken = $this->PasswordResetToken->get($id);
        if ($this->PasswordResetToken->delete($passwordResetToken)) {
            $this->Flash->success(__('The password reset token has been deleted.'));
        } else {
            $this->Flash->error(__('The password reset token could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
