<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property int|null $country_code_id
 * @property string $phone
 * @property string $email
 * @property string $logo
 * @property string $report_logo
 * @property int|null $parent_company_id
 * @property int|null $style_id
 * @property string $url
 * @property int|null $currency_code_id
 * @property int $no_of_users_allowed
 * @property int $campaign_style
 * @property string $api_key
 * @property bool $show_benchmarks
 * @property int|null $ivr_traversal_id
 * @property bool $has_campaign_report
 * @property int $status
 * @property \Cake\I18n\FrozenTime $expire_on
 * @property int|null $created_by
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $old_id
 *
 * @property \App\Model\Entity\CountryCode $country_code
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\CompanyStyle $company_style
 * @property \App\Model\Entity\CurrencyCode $currency_code
 * @property \App\Model\Entity\IvrTraversal[] $ivr_traversal
 * @property \App\Model\Entity\Old $old
 * @property \App\Model\Entity\AgentConfirmationPrompt[] $agent_confirmation_prompt
 * @property \App\Model\Entity\AlertContactForCompany[] $alert_contact_for_company
 * @property \App\Model\Entity\AlertLevelForCompany[] $alert_level_for_company
 * @property \App\Model\Entity\AlertMediumForCompany[] $alert_medium_for_company
 * @property \App\Model\Entity\AlertPolicyForDidHealth[] $alert_policy_for_did_health
 * @property \App\Model\Entity\AlertPolicyForExternalCall[] $alert_policy_for_external_call
 * @property \App\Model\Entity\AlertPolicyForFailCall[] $alert_policy_for_fail_call
 * @property \App\Model\Entity\AlertPolicyForFollowupTest[] $alert_policy_for_followup_test
 * @property \App\Model\Entity\AlertPolicyForFollowupTestOld[] $alert_policy_for_followup_test_old
 * @property \App\Model\Entity\AlertPolicyForQuality[] $alert_policy_for_quality
 * @property \App\Model\Entity\AlertPolicyForScoreDrop[] $alert_policy_for_score_drop
 * @property \App\Model\Entity\ApiLog[] $api_logs
 * @property \App\Model\Entity\ApplicationForCompany[] $application_for_company
 * @property \App\Model\Entity\AutoRerunExcludeCountry[] $auto_rerun_exclude_country
 * @property \App\Model\Entity\AutostopCondition[] $autostop_condition
 * @property \App\Model\Entity\BillingCompanyRelation[] $billing_company_relation
 * @property \App\Model\Entity\BillingHistory[] $billing_history
 * @property \App\Model\Entity\BillingSummaryDaily[] $billing_summary_daily
 * @property \App\Model\Entity\BillingSummaryMonthly[] $billing_summary_monthly
 * @property \App\Model\Entity\Bridge[] $bridge
 * @property \App\Model\Entity\CallDescriptionGroupForCompany[] $call_description_group_for_company
 * @property \App\Model\Entity\Campaign[] $campaign
 * @property \App\Model\Entity\CampaignArchive[] $campaign_archive
 * @property \App\Model\Entity\CampaignForIvr[] $campaign_for_ivr
 * @property \App\Model\Entity\CampaignTimeGroup[] $campaign_time_group
 * @property \App\Model\Entity\CliForTestTypeForCompany[] $cli_for_test_type_for_company
 * @property \App\Model\Entity\ClicktodialPrompt[] $clicktodial_prompt
 * @property \App\Model\Entity\CompanyAutoRerunCondition[] $company_auto_rerun_condition
 * @property \App\Model\Entity\CompanyAutoRerunScoreThreshold[] $company_auto_rerun_score_threshold
 * @property \App\Model\Entity\CompanyBilling[] $company_billing
 * @property \App\Model\Entity\CompanyBillingWithCallBundle[] $company_billing_with_call_bundle
 * @property \App\Model\Entity\CompanyBillingWithCountryBand[] $company_billing_with_country_band
 * @property \App\Model\Entity\CompanyBillingWithTestType[] $company_billing_with_test_type
 * @property \App\Model\Entity\CompanyCarrier[] $company_carrier
 * @property \App\Model\Entity\CompanyDepartment[] $company_department
 * @property \App\Model\Entity\CompanyExtension[] $company_extension
 * @property \App\Model\Entity\CompanyExtraField[] $company_extra_field
 * @property \App\Model\Entity\CompanyFollowupTest[] $company_followup_test
 * @property \App\Model\Entity\CompanyJobtesterStyle[] $company_jobtester_style
 * @property \App\Model\Entity\CompanyNumberCustomer[] $company_number_customer
 * @property \App\Model\Entity\CompanyNumberDepartment[] $company_number_department
 * @property \App\Model\Entity\CompanyNumberLocation[] $company_number_location
 * @property \App\Model\Entity\CompanyOutageNotification[] $company_outage_notification
 * @property \App\Model\Entity\CompanyOwnedRoute[] $company_owned_route
 * @property \App\Model\Entity\CompanyPrepayBilling[] $company_prepay_billing
 * @property \App\Model\Entity\CompanyRegion[] $company_region
 * @property \App\Model\Entity\CompanyRerunTestLimit[] $company_rerun_test_limit
 * @property \App\Model\Entity\CompanyWithUdial[] $company_with_udial
 * @property \App\Model\Entity\ConferencePromptForCompany[] $conference_prompt_for_company
 * @property \App\Model\Entity\CountryForCompany[] $country_for_company
 * @property \App\Model\Entity\CustomCompanyBenchmark[] $custom_company_benchmark
 * @property \App\Model\Entity\Dashboard[] $dashboard
 * @property \App\Model\Entity\DidForCompany[] $did_for_company
 * @property \App\Model\Entity\EtoUser[] $eto_user
 * @property \App\Model\Entity\FailedCallDescriptionForCompany[] $failed_call_description_for_company
 * @property \App\Model\Entity\FilterDropdownForCompany[] $filter_dropdown_for_company
 * @property \App\Model\Entity\FullRecordingForCompany[] $full_recording_for_company
 * @property \App\Model\Entity\HourlyTestReport[] $hourly_test_report
 * @property \App\Model\Entity\InternationalRouteForCompany[] $international_route_for_company
 * @property \App\Model\Entity\IvrTagForCompany[] $ivr_tag_for_company
 * @property \App\Model\Entity\IvrTraversalActionForCompany[] $ivr_traversal_action_for_company
 * @property \App\Model\Entity\IvrTraversalPromptForCompany[] $ivr_traversal_prompt_for_company
 * @property \App\Model\Entity\IvrTypeAgentPrompt[] $ivr_type_agent_prompt
 * @property \App\Model\Entity\Job[] $job
 * @property \App\Model\Entity\JobCreationForCompany[] $job_creation_for_company
 * @property \App\Model\Entity\JobForIvr[] $job_for_ivr
 * @property \App\Model\Entity\JobProcessingExternal[] $job_processing_external
 * @property \App\Model\Entity\JobProcessingOutboundEcho[] $job_processing_outbound_echo
 * @property \App\Model\Entity\MrepReportSchedule[] $mrep_report_schedule
 * @property \App\Model\Entity\Number[] $number
 * @property \App\Model\Entity\NumberExtraFieldForCompany[] $number_extra_field_for_company
 * @property \App\Model\Entity\NumberFieldNameForCompany[] $number_field_name_for_company
 * @property \App\Model\Entity\NumberTag[] $number_tag
 * @property \App\Model\Entity\NumberTimeGroup[] $number_time_group
 * @property \App\Model\Entity\OutageSuperTicket[] $outage_super_ticket
 * @property \App\Model\Entity\PatrickConnectionCompany[] $patrick_connection_company
 * @property \App\Model\Entity\PatrickConnectionCountry[] $patrick_connection_country
 * @property \App\Model\Entity\PesqFieldsForCompany[] $pesq_fields_for_company
 * @property \App\Model\Entity\Phonegroup[] $phonegroup
 * @property \App\Model\Entity\PolqaFieldsForCompany[] $polqa_fields_for_company
 * @property \App\Model\Entity\PopulationRequestHistory[] $population_request_history
 * @property \App\Model\Entity\ProdialNumberSchema[] $prodial_number_schema
 * @property \App\Model\Entity\ProviderPortForCompany[] $provider_port_for_company
 * @property \App\Model\Entity\Role[] $role
 * @property \App\Model\Entity\ScoreCondition[] $score_condition
 * @property \App\Model\Entity\SpearlineUserWithCompany[] $spearline_user_with_company
 * @property \App\Model\Entity\SupportAssignGroupForCompany[] $support_assign_group_for_company
 * @property \App\Model\Entity\SupportDeskCompany[] $support_desk_company
 * @property \App\Model\Entity\TempInfo[] $temp_info
 * @property \App\Model\Entity\TempUser[] $temp_users
 * @property \App\Model\Entity\TestTypeCallForwarding[] $test_type_call_forwarding
 * @property \App\Model\Entity\TestTypeForCompany[] $test_type_for_company
 * @property \App\Model\Entity\ToneAudioForCompany[] $tone_audio_for_company
 * @property \App\Model\Entity\UdialGroup[] $udial_group
 * @property \App\Model\Entity\UnableToTestJob[] $unable_to_test_job
 * @property \App\Model\Entity\User[] $user
 * @property \App\Model\Entity\UserInPhonegroup[] $user_in_phonegroup
 * @property \App\Model\Entity\RouteForTestType[] $route_for_test_type
 */
class Company extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'address' => true,
        'city' => true,
        'country_code_id' => true,
        'phone' => true,
        'email' => true,
        'logo' => true,
        'report_logo' => true,
        'parent_company_id' => true,
        'style_id' => true,
        'url' => true,
        'currency_code_id' => true,
        'no_of_users_allowed' => true,
        'campaign_style' => true,
        'api_key' => true,
        'show_benchmarks' => true,
        'ivr_traversal_id' => true,
        'has_campaign_report' => true,
        'status' => true,
        'expire_on' => true,
        'created_by' => true,
        'created_on' => true,
        'old_id' => true,
        'country_code' => true,
        'company' => true,
        'company_style' => true,
        'currency_code' => true,
        'ivr_traversal' => true,
        'old' => true,
        'agent_confirmation_prompt' => true,
        'alert_contact_for_company' => true,
        'alert_level_for_company' => true,
        'alert_medium_for_company' => true,
        'alert_policy_for_did_health' => true,
        'alert_policy_for_external_call' => true,
        'alert_policy_for_fail_call' => true,
        'alert_policy_for_followup_test' => true,
        'alert_policy_for_followup_test_old' => true,
        'alert_policy_for_quality' => true,
        'alert_policy_for_score_drop' => true,
        'api_logs' => true,
        'application_for_company' => true,
        'auto_rerun_exclude_country' => true,
        'autostop_condition' => true,
        'billing_company_relation' => true,
        'billing_history' => true,
        'billing_summary_daily' => true,
        'billing_summary_monthly' => true,
        'bridge' => true,
        'call_description_group_for_company' => true,
        'campaign' => true,
        'campaign_archive' => true,
        'campaign_for_ivr' => true,
        'campaign_time_group' => true,
        'cli_for_test_type_for_company' => true,
        'clicktodial_prompt' => true,
        'company_auto_rerun_condition' => true,
        'company_auto_rerun_score_threshold' => true,
        'company_billing' => true,
        'company_billing_with_call_bundle' => true,
        'company_billing_with_country_band' => true,
        'company_billing_with_test_type' => true,
        'company_carrier' => true,
        'company_department' => true,
        'company_extension' => true,
        'company_extra_field' => true,
        'company_followup_test' => true,
        'company_jobtester_style' => true,
        'company_number_customer' => true,
        'company_number_department' => true,
        'company_number_location' => true,
        'company_outage_notification' => true,
        'company_owned_route' => true,
        'company_prepay_billing' => true,
        'company_region' => true,
        'company_rerun_test_limit' => true,
        'company_with_udial' => true,
        'conference_prompt_for_company' => true,
        'country_for_company' => true,
        'custom_company_benchmark' => true,
        'dashboard' => true,
        'did_for_company' => true,
        'eto_user' => true,
        'failed_call_description_for_company' => true,
        'filter_dropdown_for_company' => true,
        'full_recording_for_company' => true,
        'hourly_test_report' => true,
        'international_route_for_company' => true,
        'ivr_tag_for_company' => true,
        'ivr_traversal_action_for_company' => true,
        'ivr_traversal_prompt_for_company' => true,
        'ivr_type_agent_prompt' => true,
        'job' => true,
        'job_creation_for_company' => true,
        'job_for_ivr' => true,
        'job_processing_external' => true,
        'job_processing_outbound_echo' => true,
        'mrep_report_schedule' => true,
        'number' => true,
        'number_extra_field_for_company' => true,
        'number_field_name_for_company' => true,
        'number_tag' => true,
        'number_time_group' => true,
        'outage_super_ticket' => true,
        'patrick_connection_company' => true,
        'patrick_connection_country' => true,
        'pesq_fields_for_company' => true,
        'phonegroup' => true,
        'polqa_fields_for_company' => true,
        'population_request_history' => true,
        'prodial_number_schema' => true,
        'provider_port_for_company' => true,
        'role' => true,
        'score_condition' => true,
        'spearline_user_with_company' => true,
        'support_assign_group_for_company' => true,
        'support_desk_company' => true,
        'temp_info' => true,
        'temp_users' => true,
        'test_type_call_forwarding' => true,
        'test_type_for_company' => true,
        'tone_audio_for_company' => true,
        'udial_group' => true,
        'unable_to_test_job' => true,
        'user' => true,
        'user_in_phonegroup' => true,
        'route_for_test_type' => true
    ];
}
