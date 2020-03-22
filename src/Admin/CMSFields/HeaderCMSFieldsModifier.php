<?php

namespace Syanaputra\Clio\Admin\CMSFields;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldLazyLoader;

class HeaderCMSFieldsModifier implements InterfaceCMSFieldsModifier
{
    /**
     * Update the given fields
     *
     * @param FieldList $fields
     */
    public static function update_fields(FieldList $fields) {
        // Move fields
        $fieldsToMove = ['MenuStyle', 'PreHeaderBackground', 'FixedHeader', 'HeaderHasShadow', 'HeaderHasBorder'];

        $fieldsToMoveList = [];
        foreach($fieldsToMove as $fieldKey) {
            $field = $fields->fieldByName('Root.Main.' . $fieldKey);
            if($field) {
                $fieldsToMoveList[] = $field;
            }
        }

        $fields->addFieldsToTab('Root.Header', $fieldsToMoveList);
    }
}

