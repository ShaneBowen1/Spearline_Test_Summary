<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TestType Entity
 *
 * @property int $id
 * @property int $application_id
 * @property string $test_type
 * @property string $description
 * @property int $status
 * @property string $job_processing_table
 * @property string $job_processing_rerun_table
 * @property int $score_type
 * @property string $pesq_table
 * @property string $pesq_rerun_table
 * @property string $polqa_table
 * @property string $polqa_rerun_table
 * @property string $reference_file
 * @property float $ref_file_length
 * @property int $checkin_timeout
 * @property int $no_of_prompts
 * @property bool $upload_full_recording
 * @property int $campaign_style
 * @property bool $has_alert
 * @property bool $has_offset
 * @property bool|null $has_gsm
 *
 * @property \App\Model\Entity\SpearlineApplication $spearline_application
 * @property \App\Model\Entity\AlertCall[] $alert_call
 * @property \App\Model\Entity\AlertCallNoPort[] $alert_call_no_port
 * @property \App\Model\Entity\AlertIgnore[] $alert_ignore
 * @property \App\Model\Entity\AlertPolicyForExternalCallHistory[] $alert_policy_for_external_call_history
 * @property \App\Model\Entity\AlertPolicyForFailCallHistory[] $alert_policy_for_fail_call_history
 * @property \App\Model\Entity\AlertPolicyForFollowupTestHistory[] $alert_policy_for_followup_test_history
 * @property \App\Model\Entity\AlertPolicyForQualityHistory[] $alert_policy_for_quality_history
 * @property \App\Model\Entity\AutoRerunTest[] $auto_rerun_test
 * @property \App\Model\Entity\BelowThresholdScore[] $below_threshold_score
 * @property \App\Model\Entity\BillingSummaryDaily[] $billing_summary_daily
 * @property \App\Model\Entity\BillingSummaryMonthly[] $billing_summary_monthly
 * @property \App\Model\Entity\CallDescriptionGroupForTestType[] $call_description_group_for_test_type
 * @property \App\Model\Entity\CallDescriptionHistory[] $call_description_history
 * @property \App\Model\Entity\Campaign[] $campaign
 * @property \App\Model\Entity\CampaignForIvr[] $campaign_for_ivr
 * @property \App\Model\Entity\CliForTestType[] $cli_for_test_type
 * @property \App\Model\Entity\CliForTestTypeForCompany[] $cli_for_test_type_for_company
 * @property \App\Model\Entity\CompanyBillingIncludedTestType[] $company_billing_included_test_type
 * @property \App\Model\Entity\CompanyFollowupTest[] $company_followup_test
 * @property \App\Model\Entity\CompanyJobtesterStyle[] $company_jobtester_style
 * @property \App\Model\Entity\CompanyOutageNotificationHistory[] $company_outage_notification_history
 * @property \App\Model\Entity\CompanyOutageRestoreHistory[] $company_outage_restore_history
 * @property \App\Model\Entity\CompanyOwnedRoute[] $company_owned_route
 * @property \App\Model\Entity\CompanyRerunTestLimit[] $company_rerun_test_limit
 * @property \App\Model\Entity\CompanyRouteForTestType[] $company_route_for_test_type
 * @property \App\Model\Entity\DeferredEmail[] $deferred_email
 * @property \App\Model\Entity\DidForCompany[] $did_for_company
 * @property \App\Model\Entity\EtoJobProcessing[] $eto_job_processing
 * @property \App\Model\Entity\FailedPesqPolqa[] $failed_pesq_polqa
 * @property \App\Model\Entity\FailedTestReview[] $failed_test_review
 * @property \App\Model\Entity\FollowupTestHistory[] $followup_test_history
 * @property \App\Model\Entity\FullRecordingForCompany[] $full_recording_for_company
 * @property \App\Model\Entity\InvalidTestRecording[] $invalid_test_recording
 * @property \App\Model\Entity\IvrNextTestForOption[] $ivr_next_test_for_option
 * @property \App\Model\Entity\IvrTranscriptionHistory[] $ivr_transcription_history
 * @property \App\Model\Entity\IvrTypeTagHistory[] $ivr_type_tag_history
 * @property \App\Model\Entity\Job[] $job
 * @property \App\Model\Entity\JobForIvr[] $job_for_ivr
 * @property \App\Model\Entity\JobProcessing[] $job_processing
 * @property \App\Model\Entity\JobProcessing2way[] $job_processing2way
 * @property \App\Model\Entity\JobProcessing2wayRerun[] $job_processing2way_rerun
 * @property \App\Model\Entity\JobProcessingAgentConnection[] $job_processing_agent_connection
 * @property \App\Model\Entity\JobProcessingAgentConnectionRerun[] $job_processing_agent_connection_rerun
 * @property \App\Model\Entity\JobProcessingAudioLatency[] $job_processing_audio_latency
 * @property \App\Model\Entity\JobProcessingAudioLatencyRerun[] $job_processing_audio_latency_rerun
 * @property \App\Model\Entity\JobProcessingConf[] $job_processing_conf
 * @property \App\Model\Entity\JobProcessingConfDynamicPrompt[] $job_processing_conf_dynamic_prompt
 * @property \App\Model\Entity\JobProcessingConfDynamicPromptRerun[] $job_processing_conf_dynamic_prompt_rerun
 * @property \App\Model\Entity\JobProcessingConfInternational[] $job_processing_conf_international
 * @property \App\Model\Entity\JobProcessingConfInternationalRerun[] $job_processing_conf_international_rerun
 * @property \App\Model\Entity\JobProcessingConfLongCall[] $job_processing_conf_long_call
 * @property \App\Model\Entity\JobProcessingConfLongCallRerun[] $job_processing_conf_long_call_rerun
 * @property \App\Model\Entity\JobProcessingConfRerun[] $job_processing_conf_rerun
 * @property \App\Model\Entity\JobProcessingConfSingleCall[] $job_processing_conf_single_call
 * @property \App\Model\Entity\JobProcessingConfSingleCallRerun[] $job_processing_conf_single_call_rerun
 * @property \App\Model\Entity\JobProcessingConfSip[] $job_processing_conf_sip
 * @property \App\Model\Entity\JobProcessingConfSipRerun[] $job_processing_conf_sip_rerun
 * @property \App\Model\Entity\JobProcessingConfWithTone[] $job_processing_conf_with_tone
 * @property \App\Model\Entity\JobProcessingConfWithToneRerun[] $job_processing_conf_with_tone_rerun
 * @property \App\Model\Entity\JobProcessingConnection[] $job_processing_connection
 * @property \App\Model\Entity\JobProcessingConnectionRerun[] $job_processing_connection_rerun
 * @property \App\Model\Entity\JobProcessingDtmf[] $job_processing_dtmf
 * @property \App\Model\Entity\JobProcessingDtmfRerun[] $job_processing_dtmf_rerun
 * @property \App\Model\Entity\JobProcessingEcho[] $job_processing_echo
 * @property \App\Model\Entity\JobProcessingEchoRerun[] $job_processing_echo_rerun
 * @property \App\Model\Entity\JobProcessingEmail[] $job_processing_email
 * @property \App\Model\Entity\JobProcessingEmailRerun[] $job_processing_email_rerun
 * @property \App\Model\Entity\JobProcessingExternal[] $job_processing_external
 * @property \App\Model\Entity\JobProcessingFailover[] $job_processing_failover
 * @property \App\Model\Entity\JobProcessingFailoverRerun[] $job_processing_failover_rerun
 * @property \App\Model\Entity\JobProcessingFax[] $job_processing_fax
 * @property \App\Model\Entity\JobProcessingFaxRerun[] $job_processing_fax_rerun
 * @property \App\Model\Entity\JobProcessingGoogleAgent[] $job_processing_google_agent
 * @property \App\Model\Entity\JobProcessingGoogleLoadBalance[] $job_processing_google_load_balance
 * @property \App\Model\Entity\JobProcessingIdial[] $job_processing_idial
 * @property \App\Model\Entity\JobProcessingInboundEcho[] $job_processing_inbound_echo
 * @property \App\Model\Entity\JobProcessingInboundEchoRerun[] $job_processing_inbound_echo_rerun
 * @property \App\Model\Entity\JobProcessingInternational[] $job_processing_international
 * @property \App\Model\Entity\JobProcessingInternationalRerun[] $job_processing_international_rerun
 * @property \App\Model\Entity\JobProcessingIvr[] $job_processing_ivr
 * @property \App\Model\Entity\JobProcessingIvrMap[] $job_processing_ivr_map
 * @property \App\Model\Entity\JobProcessingIvrMapRerun[] $job_processing_ivr_map_rerun
 * @property \App\Model\Entity\JobProcessingIvrRerun[] $job_processing_ivr_rerun
 * @property \App\Model\Entity\JobProcessingIvrType[] $job_processing_ivr_type
 * @property \App\Model\Entity\JobProcessingIvrTypePhase2[] $job_processing_ivr_type_phase2
 * @property \App\Model\Entity\JobProcessingIvrTypePhase2Rerun[] $job_processing_ivr_type_phase2_rerun
 * @property \App\Model\Entity\JobProcessingIvrTypeRerun[] $job_processing_ivr_type_rerun
 * @property \App\Model\Entity\JobProcessingIvrTypeT[] $job_processing_ivr_type_t
 * @property \App\Model\Entity\JobProcessingLatency[] $job_processing_latency
 * @property \App\Model\Entity\JobProcessingLatencyRerun[] $job_processing_latency_rerun
 * @property \App\Model\Entity\JobProcessingLink[] $job_processing_link
 * @property \App\Model\Entity\JobProcessingLinkRerun[] $job_processing_link_rerun
 * @property \App\Model\Entity\JobProcessingManual[] $job_processing_manual
 * @property \App\Model\Entity\JobProcessingMultiPrompt[] $job_processing_multi_prompt
 * @property \App\Model\Entity\JobProcessingMultiPromptRerun[] $job_processing_multi_prompt_rerun
 * @property \App\Model\Entity\JobProcessingOutboundConf[] $job_processing_outbound_conf
 * @property \App\Model\Entity\JobProcessingOutboundConfRerun[] $job_processing_outbound_conf_rerun
 * @property \App\Model\Entity\JobProcessingOutboundEcho[] $job_processing_outbound_echo
 * @property \App\Model\Entity\JobProcessingPatrickConnection[] $job_processing_patrick_connection
 * @property \App\Model\Entity\JobProcessingPatrickConnectionRerun[] $job_processing_patrick_connection_rerun
 * @property \App\Model\Entity\JobProcessingRecordingOnly[] $job_processing_recording_only
 * @property \App\Model\Entity\JobProcessingRerun[] $job_processing_rerun
 * @property \App\Model\Entity\JobProcessingSip[] $job_processing_sip
 * @property \App\Model\Entity\JobProcessingSipRerun[] $job_processing_sip_rerun
 * @property \App\Model\Entity\JobProcessingSkype[] $job_processing_skype
 * @property \App\Model\Entity\JobProcessingSkypeRerun[] $job_processing_skype_rerun
 * @property \App\Model\Entity\JobProcessingUserInput[] $job_processing_user_input
 * @property \App\Model\Entity\JobProcessingUserInputRerun[] $job_processing_user_input_rerun
 * @property \App\Model\Entity\LatestJpId[] $latest_jp_id
 * @property \App\Model\Entity\NumberFieldNameForCompany[] $number_field_name_for_company
 * @property \App\Model\Entity\NumberWithOverrideRoute[] $number_with_override_route
 * @property \App\Model\Entity\PatrickConnectionJob[] $patrick_connection_job
 * @property \App\Model\Entity\PopulationRequestHistory[] $population_request_history
 * @property \App\Model\Entity\PossibleAlert[] $possible_alert
 * @property \App\Model\Entity\RerunHistory[] $rerun_history
 * @property \App\Model\Entity\RouteForTestType[] $route_for_test_type
 * @property \App\Model\Entity\ScoreCondition[] $score_condition
 * @property \App\Model\Entity\SipTest[] $sip_test
 * @property \App\Model\Entity\SnmpTrapHistory[] $snmp_trap_history
 * @property \App\Model\Entity\TempAlertPolicyForFailCallHistory[] $temp_alert_policy_for_fail_call_history
 * @property \App\Model\Entity\TempAlertPolicyForQualityHistory[] $temp_alert_policy_for_quality_history
 * @property \App\Model\Entity\TempDidForCompany[] $temp_did_for_company
 * @property \App\Model\Entity\TempInfo[] $temp_info
 * @property \App\Model\Entity\TempJobProcessingGoogleAgent[] $temp_job_processing_google_agent
 * @property \App\Model\Entity\TestApprovalHistory[] $test_approval_history
 * @property \App\Model\Entity\TestPosting[] $test_posting
 * @property \App\Model\Entity\TestTypeCallForwarding[] $test_type_call_forwarding
 * @property \App\Model\Entity\TestTypeExtra[] $test_type_extra
 * @property \App\Model\Entity\TestTypeForCompany[] $test_type_for_company
 */
class TestType extends Entity
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
        'application_id' => true,
        'test_type' => true,
        'description' => true,
        'status' => true,
        'job_processing_table' => true,
        'job_processing_rerun_table' => true,
        'score_type' => true,
        'pesq_table' => true,
        'pesq_rerun_table' => true,
        'polqa_table' => true,
        'polqa_rerun_table' => true,
        'reference_file' => true,
        'ref_file_length' => true,
        'checkin_timeout' => true,
        'no_of_prompts' => true,
        'upload_full_recording' => true,
        'campaign_style' => true,
        'has_alert' => true,
        'has_offset' => true,
        'has_gsm' => true,
        'spearline_application' => true,
        'alert_call' => true,
        'alert_call_no_port' => true,
        'alert_ignore' => true,
        'alert_policy_for_external_call_history' => true,
        'alert_policy_for_fail_call_history' => true,
        'alert_policy_for_followup_test_history' => true,
        'alert_policy_for_quality_history' => true,
        'auto_rerun_test' => true,
        'below_threshold_score' => true,
        'billing_summary_daily' => true,
        'billing_summary_monthly' => true,
        'call_description_group_for_test_type' => true,
        'call_description_history' => true,
        'campaign' => true,
        'campaign_for_ivr' => true,
        'cli_for_test_type' => true,
        'cli_for_test_type_for_company' => true,
        'company_billing_included_test_type' => true,
        'company_followup_test' => true,
        'company_jobtester_style' => true,
        'company_outage_notification_history' => true,
        'company_outage_restore_history' => true,
        'company_owned_route' => true,
        'company_rerun_test_limit' => true,
        'company_route_for_test_type' => true,
        'deferred_email' => true,
        'did_for_company' => true,
        'eto_job_processing' => true,
        'failed_pesq_polqa' => true,
        'failed_test_review' => true,
        'followup_test_history' => true,
        'full_recording_for_company' => true,
        'invalid_test_recording' => true,
        'ivr_next_test_for_option' => true,
        'ivr_transcription_history' => true,
        'ivr_type_tag_history' => true,
        'job' => true,
        'job_for_ivr' => true,
        'job_processing' => true,
        'job_processing2way' => true,
        'job_processing2way_rerun' => true,
        'job_processing_agent_connection' => true,
        'job_processing_agent_connection_rerun' => true,
        'job_processing_audio_latency' => true,
        'job_processing_audio_latency_rerun' => true,
        'job_processing_conf' => true,
        'job_processing_conf_dynamic_prompt' => true,
        'job_processing_conf_dynamic_prompt_rerun' => true,
        'job_processing_conf_international' => true,
        'job_processing_conf_international_rerun' => true,
        'job_processing_conf_long_call' => true,
        'job_processing_conf_long_call_rerun' => true,
        'job_processing_conf_rerun' => true,
        'job_processing_conf_single_call' => true,
        'job_processing_conf_single_call_rerun' => true,
        'job_processing_conf_sip' => true,
        'job_processing_conf_sip_rerun' => true,
        'job_processing_conf_with_tone' => true,
        'job_processing_conf_with_tone_rerun' => true,
        'job_processing_connection' => true,
        'job_processing_connection_rerun' => true,
        'job_processing_dtmf' => true,
        'job_processing_dtmf_rerun' => true,
        'job_processing_echo' => true,
        'job_processing_echo_rerun' => true,
        'job_processing_email' => true,
        'job_processing_email_rerun' => true,
        'job_processing_external' => true,
        'job_processing_failover' => true,
        'job_processing_failover_rerun' => true,
        'job_processing_fax' => true,
        'job_processing_fax_rerun' => true,
        'job_processing_google_agent' => true,
        'job_processing_google_load_balance' => true,
        'job_processing_idial' => true,
        'job_processing_inbound_echo' => true,
        'job_processing_inbound_echo_rerun' => true,
        'job_processing_international' => true,
        'job_processing_international_rerun' => true,
        'job_processing_ivr' => true,
        'job_processing_ivr_map' => true,
        'job_processing_ivr_map_rerun' => true,
        'job_processing_ivr_rerun' => true,
        'job_processing_ivr_type' => true,
        'job_processing_ivr_type_phase2' => true,
        'job_processing_ivr_type_phase2_rerun' => true,
        'job_processing_ivr_type_rerun' => true,
        'job_processing_ivr_type_t' => true,
        'job_processing_latency' => true,
        'job_processing_latency_rerun' => true,
        'job_processing_link' => true,
        'job_processing_link_rerun' => true,
        'job_processing_manual' => true,
        'job_processing_multi_prompt' => true,
        'job_processing_multi_prompt_rerun' => true,
        'job_processing_outbound_conf' => true,
        'job_processing_outbound_conf_rerun' => true,
        'job_processing_outbound_echo' => true,
        'job_processing_patrick_connection' => true,
        'job_processing_patrick_connection_rerun' => true,
        'job_processing_recording_only' => true,
        'job_processing_rerun' => true,
        'job_processing_sip' => true,
        'job_processing_sip_rerun' => true,
        'job_processing_skype' => true,
        'job_processing_skype_rerun' => true,
        'job_processing_user_input' => true,
        'job_processing_user_input_rerun' => true,
        'latest_jp_id' => true,
        'number_field_name_for_company' => true,
        'number_with_override_route' => true,
        'patrick_connection_job' => true,
        'population_request_history' => true,
        'possible_alert' => true,
        'rerun_history' => true,
        'route_for_test_type' => true,
        'score_condition' => true,
        'sip_test' => true,
        'snmp_trap_history' => true,
        'temp_alert_policy_for_fail_call_history' => true,
        'temp_alert_policy_for_quality_history' => true,
        'temp_did_for_company' => true,
        'temp_info' => true,
        'temp_job_processing_google_agent' => true,
        'test_approval_history' => true,
        'test_posting' => true,
        'test_type_call_forwarding' => true,
        'test_type_extra' => true,
        'test_type_for_company' => true
    ];
}
