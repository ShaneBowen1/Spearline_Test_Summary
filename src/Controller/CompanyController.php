<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Company Controller
 *
 * @property \App\Model\Table\CompanyTable $Company
 *
 * @method \App\Model\Entity\Company[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompanyController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CountryCode', 'Company', 'CompanyStyle', 'CurrencyCode', 'IvrTraversals', 'Olds']
        ];
        $company = $this->paginate($this->Company);

        $this->set(compact('company'));
    }

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $company = $this->Company->get($id, [
            'contain' => ['CountryCode', 'Company', 'CompanyStyle', 'CurrencyCode', 'IvrTraversals', 'Olds', 'Role', 'RouteForTestType', 'AgentConfirmationPrompt', 'AlertContactForCompany', 'AlertLevelForCompany', 'AlertMediumForCompany', 'AlertPolicyForDidHealth', 'AlertPolicyForExternalCall', 'AlertPolicyForFailCall', 'AlertPolicyForFollowupTest', 'AlertPolicyForFollowupTestOld', 'AlertPolicyForQuality', 'AlertPolicyForScoreDrop', 'ApiLogs', 'ApplicationForCompany', 'AutoRerunExcludeCountry', 'AutostopCondition', 'BillingCompanyRelation', 'BillingHistory', 'BillingSummaryDaily', 'BillingSummaryMonthly', 'Bridge', 'CallDescriptionGroupForCompany', 'Campaign', 'CampaignArchive', 'CampaignForIvr', 'CampaignTimeGroup', 'CliForTestTypeForCompany', 'ClicktodialPrompt', 'CompanyAutoRerunCondition', 'CompanyAutoRerunScoreThreshold', 'CompanyBilling', 'CompanyBillingWithCallBundle', 'CompanyBillingWithCountryBand', 'CompanyBillingWithTestType', 'CompanyCarrier', 'CompanyDepartment', 'CompanyExtension', 'CompanyExtraField', 'CompanyFollowupTest', 'CompanyJobtesterStyle', 'CompanyNumberCustomer', 'CompanyNumberDepartment', 'CompanyNumberLocation', 'CompanyOutageNotification', 'CompanyOwnedRoute', 'CompanyPrepayBilling', 'CompanyRegion', 'CompanyRerunTestLimit', 'CompanyWithUdial', 'ConferencePromptForCompany', 'CountryForCompany', 'CustomCompanyBenchmark', 'Dashboard', 'DidForCompany', 'EtoUser', 'FailedCallDescriptionForCompany', 'FilterDropdownForCompany', 'FullRecordingForCompany', 'HourlyTestReport', 'InternationalRouteForCompany', 'IvrTagForCompany', 'IvrTraversal', 'IvrTraversalActionForCompany', 'IvrTraversalPromptForCompany', 'IvrTypeAgentPrompt', 'Job', 'JobCreationForCompany', 'JobForIvr', 'JobProcessingExternal', 'JobProcessingOutboundEcho', 'MrepReportSchedule', 'Number', 'NumberExtraFieldForCompany', 'NumberFieldNameForCompany', 'NumberTag', 'NumberTimeGroup', 'OutageSuperTicket', 'PatrickConnectionCompany', 'PatrickConnectionCountry', 'PesqFieldsForCompany', 'Phonegroup', 'PolqaFieldsForCompany', 'PopulationRequestHistory', 'ProdialNumberSchema', 'ProviderPortForCompany', 'ScoreCondition', 'SpearlineUserWithCompany', 'SupportAssignGroupForCompany', 'SupportDeskCompany', 'TempInfo', 'TempUsers', 'TestTypeCallForwarding', 'TestTypeForCompany', 'ToneAudioForCompany', 'UdialGroup', 'UnableToTestJob', 'User', 'UserInPhonegroup']
        ]);

        $this->set('company', $company);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $company = $this->Company->newEntity();
        if ($this->request->is('post')) {
            $company = $this->Company->patchEntity($company, $this->request->getData());
            if ($this->Company->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }
        $countryCode = $this->Company->CountryCode->find('list', ['limit' => 200]);
        $company = $this->Company->Company->find('list', ['limit' => 200]);
        $companyStyle = $this->Company->CompanyStyle->find('list', ['limit' => 200]);
        $currencyCode = $this->Company->CurrencyCode->find('list', ['limit' => 200]);
        $ivrTraversals = $this->Company->IvrTraversals->find('list', ['limit' => 200]);
        $olds = $this->Company->Olds->find('list', ['limit' => 200]);
        $role = $this->Company->Role->find('list', ['limit' => 200]);
        $routeForTestType = $this->Company->RouteForTestType->find('list', ['limit' => 200]);
        $this->set(compact('company', 'countryCode', 'company', 'companyStyle', 'currencyCode', 'ivrTraversals', 'olds', 'role', 'routeForTestType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $company = $this->Company->get($id, [
            'contain' => ['Role', 'RouteForTestType']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $company = $this->Company->patchEntity($company, $this->request->getData());
            if ($this->Company->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }
        $countryCode = $this->Company->CountryCode->find('list', ['limit' => 200]);
        $company = $this->Company->Company->find('list', ['limit' => 200]);
        $companyStyle = $this->Company->CompanyStyle->find('list', ['limit' => 200]);
        $currencyCode = $this->Company->CurrencyCode->find('list', ['limit' => 200]);
        $ivrTraversals = $this->Company->IvrTraversals->find('list', ['limit' => 200]);
        $olds = $this->Company->Olds->find('list', ['limit' => 200]);
        $role = $this->Company->Role->find('list', ['limit' => 200]);
        $routeForTestType = $this->Company->RouteForTestType->find('list', ['limit' => 200]);
        $this->set(compact('company', 'countryCode', 'company', 'companyStyle', 'currencyCode', 'ivrTraversals', 'olds', 'role', 'routeForTestType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Company->get($id);
        if ($this->Company->delete($company)) {
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
