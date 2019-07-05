<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TestType Controller
 *
 * @property \App\Model\Table\TestTypeTable $TestType
 *
 * @method \App\Model\Entity\TestType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TestTypeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SpearlineApplication']
        ];
        $testType = $this->paginate($this->TestType);

        $this->set(compact('testType'));
    }

    /**
     * View method
     *
     * @param string|null $id Test Type id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testType = $this->TestType->get($id, [
            'contain' => ['SpearlineApplication', 'AlertCall', 'AlertCallNoPort', 'AlertIgnore', 'AlertPolicyForExternalCallHistory', 'AlertPolicyForFailCallHistory', 'AlertPolicyForFollowupTestHistory', 'AlertPolicyForQualityHistory', 'AutoRerunTest', 'BelowThresholdScore', 'BillingSummaryDaily', 'BillingSummaryMonthly', 'CallDescriptionGroupForTestType', 'CallDescriptionHistory', 'Campaign', 'CampaignForIvr', 'CliForTestType', 'CliForTestTypeForCompany', 'CompanyBillingIncludedTestType', 'CompanyFollowupTest', 'CompanyJobtesterStyle', 'CompanyOutageNotificationHistory', 'CompanyOutageRestoreHistory', 'CompanyOwnedRoute', 'CompanyRerunTestLimit', 'CompanyRouteForTestType', 'DeferredEmail', 'DidForCompany', 'EtoJobProcessing', 'FailedPesqPolqa', 'FailedTestReview', 'FollowupTestHistory', 'FullRecordingForCompany', 'InvalidTestRecording', 'IvrNextTestForOption', 'IvrTranscriptionHistory', 'IvrTypeTagHistory', 'Job', 'JobForIvr', 'JobProcessing', 'JobProcessing2way', 'JobProcessing2wayRerun', 'JobProcessingAgentConnection', 'JobProcessingAgentConnectionRerun', 'JobProcessingAudioLatency', 'JobProcessingAudioLatencyRerun', 'JobProcessingConf', 'JobProcessingConfDynamicPrompt', 'JobProcessingConfDynamicPromptRerun', 'JobProcessingConfInternational', 'JobProcessingConfInternationalRerun', 'JobProcessingConfLongCall', 'JobProcessingConfLongCallRerun', 'JobProcessingConfRerun', 'JobProcessingConfSingleCall', 'JobProcessingConfSingleCallRerun', 'JobProcessingConfSip', 'JobProcessingConfSipRerun', 'JobProcessingConfWithTone', 'JobProcessingConfWithToneRerun', 'JobProcessingConnection', 'JobProcessingConnectionRerun', 'JobProcessingDtmf', 'JobProcessingDtmfRerun', 'JobProcessingEcho', 'JobProcessingEchoRerun', 'JobProcessingEmail', 'JobProcessingEmailRerun', 'JobProcessingExternal', 'JobProcessingFailover', 'JobProcessingFailoverRerun', 'JobProcessingFax', 'JobProcessingFaxRerun', 'JobProcessingGoogleAgent', 'JobProcessingGoogleLoadBalance', 'JobProcessingIdial', 'JobProcessingInboundEcho', 'JobProcessingInboundEchoRerun', 'JobProcessingInternational', 'JobProcessingInternationalRerun', 'JobProcessingIvr', 'JobProcessingIvrMap', 'JobProcessingIvrMapRerun', 'JobProcessingIvrRerun', 'JobProcessingIvrType', 'JobProcessingIvrTypePhase2', 'JobProcessingIvrTypePhase2Rerun', 'JobProcessingIvrTypeRerun', 'JobProcessingIvrTypeT', 'JobProcessingLatency', 'JobProcessingLatencyRerun', 'JobProcessingLink', 'JobProcessingLinkRerun', 'JobProcessingManual', 'JobProcessingMultiPrompt', 'JobProcessingMultiPromptRerun', 'JobProcessingOutboundConf', 'JobProcessingOutboundConfRerun', 'JobProcessingOutboundEcho', 'JobProcessingPatrickConnection', 'JobProcessingPatrickConnectionRerun', 'JobProcessingRecordingOnly', 'JobProcessingRerun', 'JobProcessingSip', 'JobProcessingSipRerun', 'JobProcessingSkype', 'JobProcessingSkypeRerun', 'JobProcessingUserInput', 'JobProcessingUserInputRerun', 'LatestJpId', 'NumberFieldNameForCompany', 'NumberWithOverrideRoute', 'PatrickConnectionJob', 'PopulationRequestHistory', 'PossibleAlert', 'RerunHistory', 'RouteForTestType', 'ScoreCondition', 'SipTest', 'SnmpTrapHistory', 'TempAlertPolicyForFailCallHistory', 'TempAlertPolicyForQualityHistory', 'TempDidForCompany', 'TempInfo', 'TempJobProcessingGoogleAgent', 'TestApprovalHistory', 'TestPosting', 'TestTypeCallForwarding', 'TestTypeExtra', 'TestTypeForCompany']
        ]);

        $this->set('testType', $testType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testType = $this->TestType->newEntity();
        if ($this->request->is('post')) {
            $testType = $this->TestType->patchEntity($testType, $this->request->getData());
            if ($this->TestType->save($testType)) {
                $this->Flash->success(__('The test type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test type could not be saved. Please, try again.'));
        }
        $spearlineApplication = $this->TestType->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('testType', 'spearlineApplication'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Test Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testType = $this->TestType->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testType = $this->TestType->patchEntity($testType, $this->request->getData());
            if ($this->TestType->save($testType)) {
                $this->Flash->success(__('The test type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The test type could not be saved. Please, try again.'));
        }
        $spearlineApplication = $this->TestType->SpearlineApplication->find('list', ['limit' => 200]);
        $this->set(compact('testType', 'spearlineApplication'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Test Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testType = $this->TestType->get($id);
        if ($this->TestType->delete($testType)) {
            $this->Flash->success(__('The test type has been deleted.'));
        } else {
            $this->Flash->error(__('The test type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
