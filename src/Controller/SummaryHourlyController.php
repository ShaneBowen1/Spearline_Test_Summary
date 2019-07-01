<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SummaryHourly Controller
 *
 * @property \App\Model\Table\SummaryHourlyTable $SummaryHourly
 *
 * @method \App\Model\Entity\SummaryHourly[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SummaryHourlyController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $this->paginate = [
        //     'contain' => ['Company']
        // ];
        $summaryHourly = $this->paginate($this->SummaryHourly);


        $totalTestsBreakdown = $this->SummaryHourly->find('all')
            ->SELECT(['hour_timestamp'=>'hour_timestamp', 'total_pstn_calls'=>'SUM(total_pstn_calls)', 'total_gsm_calls'=>'SUM(total_gsm_calls)'])
            ->where(['updated' == 1])
            ->group(['hour_timestamp'])
            ->toArray();

        $this->set(compact('summaryHourly', 'totalTestsBreakdown'));
    }

    /**
     * View method
     *
     * @param string|null $id Summary Hourly id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $summaryHourly = $this->SummaryHourly->get($id, [
            'contain' => ['Company']
        ]);

        $this->set('summaryHourly', $summaryHourly);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $summaryHourly = $this->SummaryHourly->newEntity();
        if ($this->request->is('post')) {
            $summaryHourly = $this->SummaryHourly->patchEntity($summaryHourly, $this->request->getData());
            if ($this->SummaryHourly->save($summaryHourly)) {
                $this->Flash->success(__('The summary hourly has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The summary hourly could not be saved. Please, try again.'));
        }
        $company = $this->SummaryHourly->Company->find('list', ['limit' => 200]);
        $this->set(compact('summaryHourly', 'company'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Summary Hourly id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $summaryHourly = $this->SummaryHourly->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $summaryHourly = $this->SummaryHourly->patchEntity($summaryHourly, $this->request->getData());
            if ($this->SummaryHourly->save($summaryHourly)) {
                $this->Flash->success(__('The summary hourly has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The summary hourly could not be saved. Please, try again.'));
        }
        $company = $this->SummaryHourly->Company->find('list', ['limit' => 200]);
        $this->set(compact('summaryHourly', 'company'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Summary Hourly id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $summaryHourly = $this->SummaryHourly->get($id);
        if ($this->SummaryHourly->delete($summaryHourly)) {
            $this->Flash->success(__('The summary hourly has been deleted.'));
        } else {
            $this->Flash->error(__('The summary hourly could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
