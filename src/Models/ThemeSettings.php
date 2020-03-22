<?php

namespace Syanaputra\Clio\Model;

use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DB;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;
use SilverStripe\Security\Security;
use SilverStripe\View\TemplateGlobalProvider;

/**
 * Class ThemeSettings
 *
 * @package Syanaputra\Clio\Model
 */
class ThemeSettings extends DataObject implements PermissionProvider, TemplateGlobalProvider
{
    /**
     * @var null
     */
    private static $_cached_settings = null;

    /**
     * @var array
     */
    private static $db = [
        'MenuStyle' => 'Varchar',
        'PreHeaderBackground' => 'Varchar',
        'FixedHeader' => 'Boolean',
        'HeaderHasShadow' => 'Boolean',
        'HeaderHasBorder' => 'Boolean',
    ];

    /**
     * @var array
     */
    private static $has_one = [];

    /**
     * @var array
     */
    private static $many_many = [];

    /**
     * @var array
     */
    private static $many_many_extraFields = [];

    /**
     * @var string
     */
    private static $singular_name = 'Setting';

    /**
     * @var string
     */
    private static $plural_name = 'Settings';

    /**
     * @var string
     */
    private static $table_name = 'ClioThemeSettings';

    /**
     * @var array
     */
    private static $indexes = [];

    /**
     * @var array
     */
    private static $searchable_fields = [];

    /**
     * @var array
     */
    private static $extensions = [];

    /**
     * @var array
     */
    private static $defaults = [];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Title' => 'Title',
        'LastEdited.Nice' => 'Last Edited',
    ];

    /**
     * Update the CMS Fields
     *
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
//        $this->beforeUpdateCMSFields(function (FieldList $fields) {
//
//        });

        return parent::getCMSFields();
    }


    /**
     * Get the current sites ThemeSettings, and creates a new one through
     * {@link make_theme_settings()} if none is found.
     *
     * @return ThemeSettings
     */
    public static function current_theme_settings($flush = false)
    {
        if(self::$_cached_settings === null || $flush) {

            $obj = DataObject::get_one(self::class);

            if ($obj) {
                self::$_cached_settings = $obj;
            }
            else {
                self::$_cached_settings = self::make_theme_settings();
            }

        }

        return self::$_cached_settings;
    }

    /**
     * Setup a default SiteConfig record if none exists.
     */
    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();

        $config = DataObject::get_one(self::class);

        if (!$config) {
            self::make_theme_settings();

            DB::alteration_message("Added default Clio theme settings", "created");
        }
    }

    /**
     * Create ThemeSettings with defaults from language file.
     *
     * @return ThemeSettings
     */
    public static function make_theme_settings()
    {
        $className = static::class;
        $obj = Injector::inst()->create($className);
        $obj->write();

        return $obj;
    }

    /**
     * Can a user view this SiteConfig instance?
     *
     * @param Member $member
     * @return boolean
     */
    public function canView($member = null)
    {
        if (!$member) {
            $member = Security::getCurrentUser();
        }

        $extended = $this->extendedCan('canView', $member);
        if ($extended !== null) {
            return $extended;
        }

        // Assuming all that can edit this object can also view it
        return $this->canEdit($member);
    }

    public function canEdit($member = null)
    {
        if (!$member) {
            $member = Security::getCurrentUser();
        }

        $extended = $this->extendedCan('canEdit', $member);
        if ($extended !== null) {
            return $extended;
        }

        return Permission::checkMember($member, "EDIT_CLIO_THEMESETTINGS");
    }

    /**
     * @return array
     */
    public function providePermissions()
    {
        return [
            'EDIT_CLIO_THEMESETTINGS' => [
                'name' => _t(self::class . '.EDIT_PERMISSION', 'Manage theme settings'),
                'category' => _t(
                    'SilverStripe\\Security\\Permission.PERMISSIONS_CATEGORY',
                    'Roles and access permissions'
                ),
                'help' => _t(
                    self::class . '.EDIT_PERMISSION_HELP',
                    'Ability to edit global access settings/top-level page permissions.'
                ),
                'sort' => 400
            ]
        ];
    }

    /**
     * Add $ThemeSettings to all SSViewers
     */
    public static function get_template_global_variables()
    {
        return [
            'ThemeSettings' => 'current_theme_settings',
        ];
    }
}
