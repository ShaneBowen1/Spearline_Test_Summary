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

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Search.Prg', [
            'actions' => ['overallTests']
        ]);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Company']
        ];
        $summaryHourly = $this->paginate($this->SummaryHourly);

        $this->set(compact('summaryHourly'));
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

    public function overallTests()
    {
        $summaryHourly = $this->paginate($this->SummaryHourly);
        #Load Models
        $this->loadModel('Company');
        $this->loadModel('TestType');
        
        $companyNames = $this->Company->find('all')
        ->SELECT(['id'=>'id', 'name'=>'name'])
        ->order('name')
        ->toArray();

        $testTypes = $this->TestType->find('all')
        ->SELECT(['id'=>'id', 'test_type'=>'test_type'])
        ->order('test_type')
        ->toArray();

        /*If no daterange selected in filter then show results for current week only*/
        if(empty($this->request->query['date'])){
            // $startDate = date('Y-m-d H:i:s', strtotime("-1 month"));
            // $endDate = date('Y-m-d H:i:s');
            $startDate = date('Y-m-d 00:00:00', strtotime("-6 days"));
            $endDate = date('Y-m-d 23:59:59');
            $this->request->query['date'] = $startDate . " - ". $endDate;
        }else{
            /*If date range is selected then decode it*/
            $filter_date_range_decoded = json_decode($this->request->query['date']);
            /*If date range in query string contains start and end parameter then use them directly*/
            if(isset($filter_date_range_decoded->start) && isset($filter_date_range_decoded->end)){
                $startDate =  $filter_date_range_decoded->start." 00:00:00";
                $endDate = $filter_date_range_decoded->end." 23:59:59";
            }else{
                /*If date range in query string not contains start and end parameter then explode and use*/
                $filter_date_range_decoded = explode(" - ", $this->request->query['date']);
                $startDate =  $filter_date_range_decoded[0];
                $endDate = $filter_date_range_decoded[1];
            }
        }

        $drStartDate = date('Y-m-d 00:00:00', strtotime($startDate));
        $drEndDate = new \DateTime($endDate);
        $drEndDate = $drEndDate->format('Y-m-d 23:59:59');
        debug($drStartDate);
        debug($drEndDate);

        $diff = (new \DateTime($startDate))->diff(new \DateTime($endDate . '+1 day'));

        debug($diff);

        $previousStartDate = (new \DateTime($drStartDate . '-' . $diff->y . 'years -' . $diff->m . 'months -' . $diff->d . 'days'))->format('Y-m-d 00:00:00');
        $previousEndDate = (new \DateTime($drEndDate . '-' . $diff->y . 'years -' . $diff->m . 'months -' . $diff->d . 'days'))->format('Y-m-d 23:59:59');
        debug($previousStartDate);
        debug($previousEndDate);

        // $previousEndDate = date($drEndDate, strtotime("-1 month"));
        // debug($previousEndDate);

        $companyConditions = ['hour_timestamp >=' => $previousStartDate, 'hour_timestamp < ' => $previousEndDate];
        $currentTotalCondtions = ['hour_timestamp >=' => $startDate, 'hour_timestamp < ' => $endDate];
        $previousTotalCondtions = ['hour_timestamp >=' => $previousStartDate, 'hour_timestamp < ' => $previousEndDate];

        if(!empty($this->request->query['company'])){
            $companyConditions += ['company_id IN' => $this->request->query['company']];
        }
        if(!empty($this->request->query['test_type'])){
            $companyConditions += ['test_type_id IN' => $this->request->query['test_type']];
            $currentTotalCondtions += ['test_type_id IN' => $this->request->query['test_type']];
            $previousTotalCondtions += ['test_type_id IN' => $this->request->query['test_type']];
        }

        $currentCompanyTotals = $this->SummaryHourly->find('search', ['search' => $this->request->query])
            ->SELECT(['hour_timestamp'=>'hour_timestamp', 'company_id'=>'company_id', 'total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
            ->group(['company_id'])
            ->order('company_id')
            ->toArray();
        $previousCompanyTotals = $this->SummaryHourly->find('all')
            ->SELECT(['hour_timestamp'=>'hour_timestamp', 'company_id'=>'company_id', 'total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
            ->group(['company_id'])
            ->where([$companyConditions])
            ->order('company_id')
            ->toArray();

        $currentTotalTests = $this->SummaryHourly->find('all')
            ->SELECT(['hour_timestamp'=>'hour_timestamp', 'total_pstn_calls'=>'SUM(total_pstn_calls)', 'total_gsm_calls'=>'SUM(total_gsm_calls)'])
            ->where([$currentTotalCondtions]);
        $previousTotalTests = $this->SummaryHourly->find('all')
            ->SELECT(['hour_timestamp'=>'hour_timestamp', 'total_pstn_calls'=>'SUM(total_pstn_calls)', 'total_gsm_calls'=>'SUM(total_gsm_calls)'])
            ->where([$previousTotalCondtions]);

        #Hourly
        if($diff->y == 0 && $diff->m == 0 && $diff->d <= 7){
            $totalTestsBreakdown = $this->SummaryHourly->find('search', ['search' => $this->request->query])
                ->SELECT(['hour_timestamp'=>'hour_timestamp', 'total_pstn_calls'=>'SUM(total_pstn_calls)', 'total_gsm_calls'=>'SUM(total_gsm_calls)'])
                ->group(['hour_timestamp'])
                ->order('hour_timestamp')
                ->toArray();
            $companyBreakdown = $this->SummaryHourly->find('search', ['search' => $this->request->query])
                ->SELECT(['hour_timestamp'=>'hour_timestamp', 'company_id'=>'company_id', 'total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
                ->group(['hour_timestamp', 'company_id'])
                ->order('hour_timestamp')
                ->toArray();
            $totalTestCount = $this->SummaryHourly->find('all')
                ->select(['total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
                ->group(['hour_timestamp'])
                ->where(['hour_timestamp >=' => $startDate, 'hour_timestamp < ' => $endDate]);
        }

        #Daily
        elseif ($diff->y == 0 && (($diff->m >=0 && $diff->m < 3) || ($diff->m == 3 && $diff->d == 0))) {
            $totalTestsBreakdown = $this->SummaryHourly->find('search', ['search' => $this->request->query])
                ->SELECT(['hour_timestamp'=>"DATE_FORMAT(`hour_timestamp`, '%Y-%m-%d 00:00:00')", 'total_pstn_calls'=>'SUM(total_pstn_calls)', 'total_gsm_calls'=>'SUM(total_gsm_calls)'])
                ->group(["DATE_FORMAT(`hour_timestamp`, '%Y-%m-%d')"])
                ->order('hour_timestamp')
                ->toArray();
            $companyBreakdown = $this->SummaryHourly->find('search', ['search' => $this->request->query])
                ->SELECT(['hour_timestamp'=>"DATE_FORMAT(`hour_timestamp`, '%Y-%m-%d 00:00:00')", 'company_id'=>'company_id', 'total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
                ->group(["DATE_FORMAT(`hour_timestamp`, '%Y-%m-%d')", 'company_id'])
                ->order('hour_timestamp')
                ->toArray();
            $totalTestCount = $this->SummaryHourly->find('all')
                ->select(['total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
                ->group(["DATE_FORMAT(`hour_timestamp`, '%Y-%m-%d')"])
                ->where(['hour_timestamp >=' => $startDate, 'hour_timestamp < ' => $endDate]);
        }

        #Weekly
        elseif ($diff->m >= 3 || $diff->y >= 1) {
            $totalTestsBreakdown = $this->SummaryHourly->find('search', ['search' => $this->request->query])
                ->SELECT(['hour_timestamp'=>"DATE_FORMAT(`hour_timestamp` - INTERVAL (DAYOFWEEK(`hour_timestamp`) - 1) DAY, '%Y-%m-%d 00:00:00')", 'total_pstn_calls'=>'SUM(total_pstn_calls)', 'total_gsm_calls'=>'SUM(total_gsm_calls)'])
                ->group(["WEEK(DATE_FORMAT('hour_timestamp', '%Y-%m-%d'))", 'DATE_FORMAT(`hour_timestamp` - INTERVAL (DAYOFWEEK(`hour_timestamp`) - 1) DAY, "%Y-%m-%d 00:00:00")'])
                ->order('hour_timestamp')
                ->toArray();
            $companyBreakdown = $this->SummaryHourly->find('search', ['search' => $this->request->query])
                ->SELECT(['hour_timestamp'=>"DATE_FORMAT(`hour_timestamp` - INTERVAL (DAYOFWEEK(`hour_timestamp`) - 1) DAY, '%Y-%m-%d 00:00:00')", 'company_id'=>'company_id', 'total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
                ->group(["WEEK(DATE_FORMAT('hour_timestamp', '%Y-%m-%d'))", 'DATE_FORMAT(`hour_timestamp` - INTERVAL (DAYOFWEEK(`hour_timestamp`) - 1) DAY, "%Y-%m-%d 00:00:00")', 'company_id'])
                ->order('hour_timestamp')
                ->toArray();
            $totalTestCount = $this->SummaryHourly->find('all')
                ->select(['total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
                ->group(["WEEK(DATE_FORMAT('hour_timestamp', '%Y-%m-%d'))", 'DATE_FORMAT(`hour_timestamp` - INTERVAL (DAYOFWEEK(`hour_timestamp`) - 1) DAY, "%Y-%m-%d 00:00:00")'])
                ->where(['hour_timestamp >=' => $startDate, 'hour_timestamp < ' => $endDate]);
        }

        // #Monthly
        // elseif ($diff->y > 0) {
        //     $totalTestsBreakdown = $this->SummaryHourly->find('search', ['search' => $this->request->query])
        //     ->SELECT(['hour_timestamp'=>"DATE_FORMAT(`hour_timestamp`, '%Y-%m-01 00:00:00')", 'total_pstn_calls'=>'SUM(total_pstn_calls)', 'total_gsm_calls'=>'SUM(total_gsm_calls)'])
        //     ->group(["DATE_FORMAT(`hour_timestamp`, '%Y-%m')"])
        //     ->toArray();
        //     $companyBreakdown = $this->SummaryHourly->find('search', ['search' => $this->request->query])
        //         ->SELECT(['hour_timestamp'=>"DATE_FORMAT(`hour_timestamp`, '%Y-%m-01 00:00:00')", 'company_id'=>'company_id', 'total'=>'(SUM(total_pstn_calls) + SUM(total_gsm_calls))'])
        //         ->group(["DATE_FORMAT(`hour_timestamp`, '%Y-%m')", 'company_id'])
        //         ->toArray();
        // }

        $totalCompanyTests = 0;
        $totalPSTN = 0;
        $totalGSM = 0;
        foreach($totalTestsBreakdown as $key => $value ){
            $totalCompanyTests += $value->total_pstn_calls + $value->total_gsm_calls;
            $totalPSTN += $value->total_pstn_calls;
            $totalGSM += $value->total_gsm_calls;
        }

        $avgTests = (sizeof($totalTestsBreakdown) > 0 ? $totalCompanyTests / sizeof($totalTestsBreakdown) : 0);

        $filters = $this->SummaryHourly->getFilters();
        $this->set(compact('summaryHourly', 'totalTestsBreakdown', 'companyBreakdown', 'companyNames', 'totalTestCount', 'totalCompanyTests', 'totalPSTN', 'totalGSM', 'avgTests', 'filters', 'drStartDate', 'drEndDate', 'testTypes', 'currentCompanyTotals', 'previousCompanyTotals', 'currentTotalTests', 'previousTotalTests'));
    }
}