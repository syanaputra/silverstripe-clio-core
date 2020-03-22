<?php

namespace Syanaputra\Clio\Page;

use Page;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DB;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;
use SilverStripe\Security\Security;
use SilverStripe\View\TemplateGlobalProvider;
use Syanaputra\Clio\Admin\CMSFields\HeaderCMSFieldsModifier;

/**
 * Class BlockPage
 *
 * @package Syanaputra\Clio\Page
 */
class BlockPage extends Page
{
    /**
     * @var null
     */
    private static $_cached_settings = null;

    /**
     * @var array
     */
    private static $db = [];

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
    private static $singular_name = 'Block Page';

    /**
     * @var string
     */
    private static $plural_name = 'Block Pages';

    /**
     * @var string
     */
    private static $table_name = 'BlockPages';

    /**
     * @var string
     */
    private static $description = 'Clio Default Page with lots of customised blocks';

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
     * Update the CMS Fields
     *
     * @return \SilverStripe\Forms\FieldList
     */
//    public function getCMSFields()
//    {
////        $this->beforeUpdateCMSFields(function (FieldList $fields) {
////            $fields->removeByName(['Content']);
////        });
//
//        return parent::getCMSFields();
//    }

}
