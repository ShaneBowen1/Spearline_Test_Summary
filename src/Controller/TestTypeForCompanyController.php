<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TestTypeForCompany Controller
 *
 * @property \App\Model\Table\TestTypeForCompanyTable $TestTypeForCompany
 *
 * @method \App\Model\Entity\TestTypeForCompany[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestTypeForCompanyController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Company', 'TestType']
        ];
        $testTypeForCompany = $this->paginate($this->TestTypeForCompany);

        $this->set(compact('testTypeForCompany'));
    }

    /**
     * View method
     *
     * @param string|null $id Test Type For Company id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testTypeForCompany = $this->TestTypeForCompany->get($id, [
            'contain' => ['Company', 'TestType']
        ]);

        $this->set('testTypeForCompany', $testTypeForCompany);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testTypeForCompany = $this->TestTypeForCompany->newEntity();
        if ($this->request->is('post')) {
            $testTypeForCompany = $this->TestTypeForCompany->patchEntity($testTypeForCompany, $this->request->getData());
            if ($this->TestTypeForCompany->save($testTypeForCompany)) {
                $this->Flash->success(__('The test type for company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test type for company could not be saved. Please, try again.'));
        }
        $company = $this->TestTypeForCompany->Company->find('list', ['limit' => 200]);
        $testType = $this->TestTypeForCompany->TestType->find('list', ['limit' => 200]);
        $this->set(compact('testTypeForCompany', 'company', 'testType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Test Type For Company id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testTypeForCompany = $this->TestTypeForCompany->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testTypeForCompany = $this->TestTypeForCompany->patchEntity($testTypeForCompany, $this->request->getData());
            if ($this->TestTypeForCompany->save($testTypeForCompany)) {
                $this->Flash->success(__('The test type for company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test type for company could not be saved. Please, try again.'));
        }
        $company = $this->TestTypeForCompany->Company->find('list', ['limit' => 200]);
        $testType = $this->TestTypeForCompany->TestType->find('list', ['limit' => 200]);
        $this->set(compact('testTypeForCompany', 'company', 'testType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Test Type For Company id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testTypeForCompany = $this->TestTypeForCompany->get($id);
        if ($this->TestTypeForCompany->delete($testTypeForCompany)) {
            $this->Flash->success(__('The test type for company has been deleted.'));
        } else {
            $this->Flash->error(__('The test type for company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
