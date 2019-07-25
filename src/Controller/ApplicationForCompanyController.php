<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApplicationForCompany Controller
 *
 * @property \App\Model\Table\ApplicationForCompanyTable $ApplicationForCompany
 *
 * @method \App\Model\Entity\ApplicationForCompany[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicationForCompanyController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Company', 'SpearlineApplication']
        ];
        $applicationForCompany = $this->paginate($this->ApplicationForCompany);

        $this->set(compact('applicationForCompany'));
    }

    /**
     * View method
     *
     * @param string|null $id Application For Company id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $applicationForCompany = $this->ApplicationForCompany->get($id, [
            'contain' => ['Company', 'SpearlineApplication']
        ]);

        $this->set('applicationForCompany', $applicationForCompany);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $applicationForCompany = $this->ApplicationForCompany->newEntity();
        if ($this->request->is('post')) {
            $applicationForCompany = $this->ApplicationForCompany->patchEntity($applicationForCompany, $this->request->getData());
            if ($this->ApplicationForCompany->save($applicationForCompany)) {
                $this->Flash->success(__('The application for company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application for company could not be saved. Please, try again.'));
        }
        $company = $this->ApplicationForCompany->Company->find('list', ['limit' => 200]);
        $spearlineApplication = $this->ApplicationForCompany->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('applicationForCompany', 'company', 'spearlineApplication'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Application For Company id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $applicationForCompany = $this->ApplicationForCompany->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $applicationForCompany = $this->ApplicationForCompany->patchEntity($applicationForCompany, $this->request->getData());
            if ($this->ApplicationForCompany->save($applicationForCompany)) {
                $this->Flash->success(__('The application for company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application for company could not be saved. Please, try again.'));
        }
        $company = $this->ApplicationForCompany->Company->find('list', ['limit' => 200]);
        $spearlineApplication = $this->ApplicationForCompany->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('applicationForCompany', 'company', 'spearlineApplication'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Application For Company id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $applicationForCompany = $this->ApplicationForCompany->get($id);
        if ($this->ApplicationForCompany->delete($applicationForCompany)) {
            $this->Flash->success(__('The application for company has been deleted.'));
        } else {
            $this->Flash->error(__('The application for company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
