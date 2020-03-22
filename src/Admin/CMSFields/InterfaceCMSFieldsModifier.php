<?php

namespace Syanaputra\Clio\Admin\CMSFields;

use SilverStripe\Forms\FieldList;

interface InterfaceCMSFieldsModifier
{
    /**
     * Update the given fields
     *
     * @param FieldList $fields
     * @return void
     */
    public static function update_fields(FieldList $fields);
}

