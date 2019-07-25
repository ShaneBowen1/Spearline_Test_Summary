<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompanyExtension Controller
 *
 * @property \App\Model\Table\CompanyExtensionTable $CompanyExtension
 *
 * @method \App\Model\Entity\CompanyExtension[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompanyExtensionController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CompanyTypes', 'User']
        ];
        $companyExtension = $this->paginate($this->CompanyExtension);

        $this->set(compact('companyExtension'));
    }

    /**
     * View method
     *
     * @param string|null $id Company Extension id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $companyExtension = $this->CompanyExtension->get($id, [
            'contain' => ['CompanyTypes', 'User']
        ]);

        $this->set('companyExtension', $companyExtension);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $companyExtension = $this->CompanyExtension->newEntity();
        if ($this->request->is('post')) {
            $companyExtension = $this->CompanyExtension->patchEntity($companyExtension, $this->request->getData());
            if ($this->CompanyExtension->save($companyExtension)) {
                $this->Flash->success(__('The company extension has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company extension could not be saved. Please, try again.'));
        }
        $companyTypes = $this->CompanyExtension->CompanyTypes->find('list', ['limit' => 200]);
        $user = $this->CompanyExtension->User->find('list', ['limit' => 200]);
        $this->set(compact('companyExtension', 'companyTypes', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Company Extension id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $companyExtension = $this->CompanyExtension->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $companyExtension = $this->CompanyExtension->patchEntity($companyExtension, $this->request->getData());
            if ($this->CompanyExtension->save($companyExtension)) {
                $this->Flash->success(__('The company extension has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company extension could not be saved. Please, try again.'));
        }
        $companyTypes = $this->CompanyExtension->CompanyTypes->find('list', ['limit' => 200]);
        $user = $this->CompanyExtension->User->find('list', ['limit' => 200]);
        $this->set(compact('companyExtension', 'companyTypes', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Company Extension id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companyExtension = $this->CompanyExtension->get($id);
        if ($this->CompanyExtension->delete($companyExtension)) {
            $this->Flash->success(__('The company extension has been deleted.'));
        } else {
            $this->Flash->error(__('The company extension could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
