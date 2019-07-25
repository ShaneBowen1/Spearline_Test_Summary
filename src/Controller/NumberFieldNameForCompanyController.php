<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NumberFieldNameForCompany Controller
 *
 * @property \App\Model\Table\NumberFieldNameForCompanyTable $NumberFieldNameForCompany
 *
 * @method \App\Model\Entity\NumberFieldNameForCompany[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NumberFieldNameForCompanyController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Company', 'SpearlineApplication', 'TestType']
        ];
        $numberFieldNameForCompany = $this->paginate($this->NumberFieldNameForCompany);

        $this->set(compact('numberFieldNameForCompany'));
    }

    /**
     * View method
     *
     * @param string|null $id Number Field Name For Company id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $numberFieldNameForCompany = $this->NumberFieldNameForCompany->get($id, [
            'contain' => ['Company', 'SpearlineApplication', 'TestType']
        ]);

        $this->set('numberFieldNameForCompany', $numberFieldNameForCompany);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $numberFieldNameForCompany = $this->NumberFieldNameForCompany->newEntity();
        if ($this->request->is('post')) {
            $numberFieldNameForCompany = $this->NumberFieldNameForCompany->patchEntity($numberFieldNameForCompany, $this->request->getData());
            if ($this->NumberFieldNameForCompany->save($numberFieldNameForCompany)) {
                $this->Flash->success(__('The number field name for company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The number field name for company could not be saved. Please, try again.'));
        }
        $company = $this->NumberFieldNameForCompany->Company->find('list', ['limit' => 200]);
        $spearlineApplication = $this->NumberFieldNameForCompany->SpearlineApplication->find('list', ['limit' => 200]);
        $testType = $this->NumberFieldNameForCompany->TestType->find('list', ['limit' => 200]);
        $this->set(compact('numberFieldNameForCompany', 'company', 'spearlineApplication', 'testType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Number Field Name For Company id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $numberFieldNameForCompany = $this->NumberFieldNameForCompany->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $numberFieldNameForCompany = $this->NumberFieldNameForCompany->patchEntity($numberFieldNameForCompany, $this->request->getData());
            if ($this->NumberFieldNameForCompany->save($numberFieldNameForCompany)) {
                $this->Flash->success(__('The number field name for company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The number field name for company could not be saved. Please, try again.'));
        }
        $company = $this->NumberFieldNameForCompany->Company->find('list', ['limit' => 200]);
        $spearlineApplication = $this->NumberFieldNameForCompany->SpearlineApplication->find('list', ['limit' => 200]);
        $testType = $this->NumberFieldNameForCompany->TestType->find('list', ['limit' => 200]);
        $this->set(compact('numberFieldNameForCompany', 'company', 'spearlineApplication', 'testType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Number Field Name For Company id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $numberFieldNameForCompany = $this->NumberFieldNameForCompany->get($id);
        if ($this->NumberFieldNameForCompany->delete($numberFieldNameForCompany)) {
            $this->Flash->success(__('The number field name for company has been deleted.'));
        } else {
            $this->Flash->error(__('The number field name for company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
