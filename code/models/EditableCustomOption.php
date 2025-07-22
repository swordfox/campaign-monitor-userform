<?php

/**
 * Custom dataobject specifically for Campaign Monitor Field Type
 *
 * @package campaign-monitor-userform
 */


namespace Swordfox\UserForms;

use SilverStripe\Core\Convert;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;

use SilverStripe\Versioned\Versioned;
use SilverStripe\UserForms\Model\EditableFormField;
use Swordfox\UserForms\EditableCampaignMonitorField;

class EditableCustomOption extends DataObject
{

    private static $default_sort = "Sort";

    private static $db = [
        "Name" => "Varchar(255)",
        "Title" => "Varchar(255)",
        "Default" => "Boolean",
        "Sort" => "Int"
    ];

    private static $has_one = [
        "EditableCampaignMonitorField" => EditableCampaignMonitorField::class,
        'Field' => EditableFormField::class,
    ];

    private static $extensions = [
        Versioned::class . "('Stage', 'Live')",
    ];

    private static $summary_fields = [
        'Field.Name',
        'Value',
    ];

    private static $table_name = 'EditableCustomOption';

    /**
     * @param Member $member
     *
     * @return boolean
     */
    public function canEdit($member = null)
    {
        return ($this->EditableCampaignMonitorField()->canEdit($member));
    }

    /**
     * @param Member $member
     *
     * @return boolean
     */
    public function canDelete($member = null)
    {
        return ($this->EditableCampaignMonitorField()->canDelete($member));
    }

    public function getEscapedTitle()
    {
        return Convert::raw2att($this->Title);
    }
}
