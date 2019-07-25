<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PlatformController Controller
 *
 * @property \App\Model\Table\PlatformControllerTable $PlatformController
 *
 * @method \App\Model\Entity\PlatformController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlatformControllerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $platformController = $this->paginate($this->PlatformController);

        $this->set(compact('platformController'));
    }

    /**
     * View method
     *
     * @param string|null $id Platform Controller id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $platformController = $this->PlatformController->get($id, [
            'contain' => ['PlatformAction']
        ]);

        $this->set('platformController', $platformController);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $platformController = $this->PlatformController->newEntity();
        if ($this->request->is('post')) {
            $platformController = $this->PlatformController->patchEntity($platformController, $this->request->getData());
            if ($this->PlatformController->save($platformController)) {
                $this->Flash->success(__('The platform controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The platform controller could not be saved. Please, try again.'));
        }
        $this->set(compact('platformController'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Platform Controller id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $platformController = $this->PlatformController->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $platformController = $this->PlatformController->patchEntity($platformController, $this->request->getData());
            if ($this->PlatformController->save($platformController)) {
                $this->Flash->success(__('The platform controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The platform controller could not be saved. Please, try again.'));
        }
        $this->set(compact('platformController'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Platform Controller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $platformController = $this->PlatformController->get($id);
        if ($this->PlatformController->delete($platformController)) {
            $this->Flash->success(__('The platform controller has been deleted.'));
        } else {
            $this->Flash->error(__('The platform controller could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
