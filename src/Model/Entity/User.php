<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $name
 * @property string $email
 * @property string $sms
 * @property int|null $country_code_id
 * @property int|null $timezone_id
 * @property int|null $department_id
 * @property string $login_name
 * @property string $password
 * @property int|null $created_by
 * @property \Cake\I18n\FrozenTime $created_on
 * @property \Cake\I18n\FrozenTime $edited_on
 * @property bool $show
 * @property int $status
 * @property bool $backendadmin
 * @property int $old_id
 * @property int|null $role_id
 * @property bool $api_access
 * @property string $login_token
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\CountryCode $country_code
 * @property \App\Model\Entity\Timezone $timezone
 * @property \App\Model\Entity\CompanyDepartment $company_department
 * @property \App\Model\Entity\Old $old
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\ApiLog[] $api_logs
 * @property \App\Model\Entity\AuditLog[] $audit_log
 * @property \App\Model\Entity\CampaignApprovalHistory[] $campaign_approval_history
 * @property \App\Model\Entity\CompanyJobtesterStyle[] $company_jobtester_style
 * @property \App\Model\Entity\EditLog[] $edit_log
 * @property \App\Model\Entity\EtoPasswordResetToken[] $eto_password_reset_token
 * @property \App\Model\Entity\GoogleAgent[] $google_agent
 * @property \App\Model\Entity\GoogleAgentLocation[] $google_agent_location
 * @property \App\Model\Entity\GoogleAgentNoPort[] $google_agent_no_port
 * @property \App\Model\Entity\IdialHistory[] $idial_history
 * @property \App\Model\Entity\JobNote[] $job_note
 * @property \App\Model\Entity\JobProcessingGoogleAgent[] $job_processing_google_agent
 * @property \App\Model\Entity\JobProcessingIdial[] $job_processing_idial
 * @property \App\Model\Entity\JobProcessingManual[] $job_processing_manual
 * @property \App\Model\Entity\NumberExtension[] $number_extension
 * @property \App\Model\Entity\NumberFailHandler[] $number_fail_handler
 * @property \App\Model\Entity\NumberFailHandlerHistory[] $number_fail_handler_history
 * @property \App\Model\Entity\PasswordResetToken[] $password_reset_token
 * @property \App\Model\Entity\RemembermeToken[] $rememberme_token
 * @property \App\Model\Entity\ReportSchedule[] $report_schedule
 * @property \App\Model\Entity\RoleForUser[] $role_for_user
 * @property \App\Model\Entity\SpearlineIdialUser[] $spearline_idial_user
 * @property \App\Model\Entity\SpearlineNotification[] $spearline_notification
 * @property \App\Model\Entity\SpearlineUserWithCompany[] $spearline_user_with_company
 * @property \App\Model\Entity\StickyJob[] $sticky_job
 * @property \App\Model\Entity\SupportAssignGroupForUser[] $support_assign_group_for_user
 * @property \App\Model\Entity\SupportDeskCompany[] $support_desk_company
 * @property \App\Model\Entity\SupportDeskUser[] $support_desk_user
 * @property \App\Model\Entity\SupportTagForNumber[] $support_tag_for_number
 * @property \App\Model\Entity\SupportUser[] $support_user
 * @property \App\Model\Entity\TempJobProcessingGoogleAgent[] $temp_job_processing_google_agent
 * @property \App\Model\Entity\UdialCallHistory[] $udial_call_history
 * @property \App\Model\Entity\UdialGroupForUser[] $udial_group_for_user
 * @property \App\Model\Entity\UserEmailAccount[] $user_email_account
 * @property \App\Model\Entity\UserForUdial[] $user_for_udial
 * @property \App\Model\Entity\UserInPhonegroup[] $user_in_phonegroup
 * @property \App\Model\Entity\UserSession[] $user_session
 * @property \App\Model\Entity\UserSessionHistory[] $user_session_history
 */
class User extends Entity
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
        'company_id' => true,
        'name' => true,
        'email' => true,
        'sms' => true,
        'country_code_id' => true,
        'timezone_id' => true,
        'department_id' => true,
        'login_name' => true,
        'password' => true,
        'created_by' => true,
        'created_on' => true,
        'edited_on' => true,
        'show' => true,
        'status' => true,
        'backendadmin' => true,
        'old_id' => true,
        'role_id' => true,
        'api_access' => true,
        'login_token' => true,
        'company' => true,
        'country_code' => true,
        'timezone' => true,
        'company_department' => true,
        'old' => true,
        'role' => true,
        'api_logs' => true,
        'audit_log' => true,
        'campaign_approval_history' => true,
        'company_jobtester_style' => true,
        'edit_log' => true,
        'eto_password_reset_token' => true,
        'google_agent' => true,
        'google_agent_location' => true,
        'google_agent_no_port' => true,
        'idial_history' => true,
        'job_note' => true,
        'job_processing_google_agent' => true,
        'job_processing_idial' => true,
        'job_processing_manual' => true,
        'number_extension' => true,
        'number_fail_handler' => true,
        'number_fail_handler_history' => true,
        'password_reset_token' => true,
        'rememberme_token' => true,
        'report_schedule' => true,
        'role_for_user' => true,
        'spearline_idial_user' => true,
        'spearline_notification' => true,
        'spearline_user_with_company' => true,
        'sticky_job' => true,
        'support_assign_group_for_user' => true,
        'support_desk_company' => true,
        'support_desk_user' => true,
        'support_tag_for_number' => true,
        'support_user' => true,
        'temp_job_processing_google_agent' => true,
        'udial_call_history' => true,
        'udial_group_for_user' => true,
        'user_email_account' => true,
        'user_for_udial' => true,
        'user_in_phonegroup' => true,
        'user_session' => true,
        'user_session_history' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
