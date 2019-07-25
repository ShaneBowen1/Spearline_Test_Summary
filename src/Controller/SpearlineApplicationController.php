<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SpearlineApplication Controller
 *
 * @property \App\Model\Table\SpearlineApplicationTable $SpearlineApplication
 *
 * @method \App\Model\Entity\SpearlineApplication[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SpearlineApplicationController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $spearlineApplication = $this->paginate($this->SpearlineApplication);

        $this->set(compact('spearlineApplication'));
    }

    /**
     * View method
     *
     * @param string|null $id Spearline Application id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $spearlineApplication = $this->SpearlineApplication->get($id, [
            'contain' => []
        ]);

        $this->set('spearlineApplication', $spearlineApplication);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $spearlineApplication = $this->SpearlineApplication->newEntity();
        if ($this->request->is('post')) {
            $spearlineApplication = $this->SpearlineApplication->patchEntity($spearlineApplication, $this->request->getData());
            if ($this->SpearlineApplication->save($spearlineApplication)) {
                $this->Flash->success(__('The spearline application has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The spearline application could not be saved. Please, try again.'));
        }
        $this->set(compact('spearlineApplication'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Spearline Application id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $spearlineApplication = $this->SpearlineApplication->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $spearlineApplication = $this->SpearlineApplication->patchEntity($spearlineApplication, $this->request->getData());
            if ($this->SpearlineApplication->save($spearlineApplication)) {
                $this->Flash->success(__('The spearline application has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The spearline application could not be saved. Please, try again.'));
        }
        $this->set(compact('spearlineApplication'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Spearline Application id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $spearlineApplication = $this->SpearlineApplication->get($id);
        if ($this->SpearlineApplication->delete($spearlineApplication)) {
            $this->Flash->success(__('The spearline application has been deleted.'));
        } else {
            $this->Flash->error(__('The spearline application could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
