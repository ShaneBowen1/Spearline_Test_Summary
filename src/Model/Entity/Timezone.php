<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timezone Entity
 *
 * @property int $id
 * @property string $ui_name
 * @property string $timezone
 * @property string $description
 * @property int $status
 *
 * @property \App\Model\Entity\Campaign[] $campaign
 * @property \App\Model\Entity\CompanyWithUdial[] $company_with_udial
 * @property \App\Model\Entity\EtoCountryDefaultSetting[] $eto_country_default_setting
 * @property \App\Model\Entity\EtoUser[] $eto_user
 * @property \App\Model\Entity\MrepReportSchedule[] $mrep_report_schedule
 * @property \App\Model\Entity\MrepReportScheduleHistory[] $mrep_report_schedule_history
 * @property \App\Model\Entity\NumberForIvr[] $number_for_ivr
 * @property \App\Model\Entity\NumberForIvrType[] $number_for_ivr_type
 * @property \App\Model\Entity\NumberTimeGroup[] $number_time_group
 * @property \App\Model\Entity\ReportSchedule[] $report_schedule
 * @property \App\Model\Entity\TempUser[] $temp_users
 * @property \App\Model\Entity\TimezoneOffset[] $timezone_offset
 * @property \App\Model\Entity\User[] $user
 * @property \App\Model\Entity\UserForUdial[] $user_for_udial
 */
class Timezone extends Entity
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
        'ui_name' => true,
        'timezone' => true,
        'description' => true,
        'status' => true,
        'campaign' => true,
        'company_with_udial' => true,
        'eto_country_default_setting' => true,
        'eto_user' => true,
        'mrep_report_schedule' => true,
        'mrep_report_schedule_history' => true,
        'number_for_ivr' => true,
        'number_for_ivr_type' => true,
        'number_time_group' => true,
        'report_schedule' => true,
        'temp_users' => true,
        'timezone_offset' => true,
        'user' => true,
        'user_for_udial' => true
    ];
}
