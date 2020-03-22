<?php

namespace Syanaputra\Clio\Model;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldLazyLoader;

class ThemeAdmin extends ModelAdmin
{
    /**
     * @var string
     */
    private static $menu_title = 'Theme Settings';

    /**
     * @var string
     */
    private static $url_segment = 'ClioTheme';

    /**
     * @var float
     */
    private static $menu_priority = 0.4;

    /**
     * @var array
     */
    private static $managed_models = [
        ThemeSettings::class,
    ];

    /**
     * @param null $id
     * @param null $fields
     * @return \SilverStripe\Forms\Form
     */
    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        // get grid field
        $gridField = $form->Fields()->dataFieldByName($this->sanitiseClassName($this->modelClass));
        $gridFieldConfig = $gridField->getConfig();

        // remove delete & edit buttons
        $gridFieldConfig->removeComponentsByType(GridFieldAddNewButton::class);
        $gridFieldConfig->removeComponentsByType(GridFieldDeleteAction::class);

        $gridFieldConfig->addComponents(new GridFieldLazyLoader());

        return $form;
    }
}

