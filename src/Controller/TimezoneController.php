<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Timezone Controller
 *
 * @property \App\Model\Table\TimezoneTable $Timezone
 *
 * @method \App\Model\Entity\Timezone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimezoneController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $timezone = $this->paginate($this->Timezone);

        $this->set(compact('timezone'));
    }

    /**
     * View method
     *
     * @param string|null $id Timezone id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timezone = $this->Timezone->get($id, [
            'contain' => ['Campaign', 'CompanyWithUdial', 'EtoCountryDefaultSetting', 'EtoUser', 'MrepReportSchedule', 'MrepReportScheduleHistory', 'NumberForIvr', 'NumberForIvrType', 'NumberTimeGroup', 'ReportSchedule', 'TempUsers', 'TimezoneOffset', 'User', 'UserForUdial']
        ]);

        $this->set('timezone', $timezone);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $timezone = $this->Timezone->newEntity();
        if ($this->request->is('post')) {
            $timezone = $this->Timezone->patchEntity($timezone, $this->request->getData());
            if ($this->Timezone->save($timezone)) {
                $this->Flash->success(__('The timezone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timezone could not be saved. Please, try again.'));
        }
        $this->set(compact('timezone'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Timezone id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $timezone = $this->Timezone->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timezone = $this->Timezone->patchEntity($timezone, $this->request->getData());
            if ($this->Timezone->save($timezone)) {
                $this->Flash->success(__('The timezone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timezone could not be saved. Please, try again.'));
        }
        $this->set(compact('timezone'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Timezone id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timezone = $this->Timezone->get($id);
        if ($this->Timezone->delete($timezone)) {
            $this->Flash->success(__('The timezone has been deleted.'));
        } else {
            $this->Flash->error(__('The timezone could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
