<?php

class PageHolderExtension extends ExcludeChildren
{

    private static $pageholder_tab = 'Root.Main';
    private static $pageholder_insertBefore = 'Metadata';

    public static function include_requirements()
    {
        $moduleDir = self::get_module_dir();
        Requirements::css($moduleDir . '/css/pageholder.css');
    }

    public static function get_module_dir()
    {
        return basename(dirname(__DIR__));
    }

    public function updateCMSFields(FieldList $fields)
    {
        self::include_requirements();

        $tab = ($this->owner->stat('pageholder_tab'));
        $before = ($this->owner->stat('pageholder_insertBefore'));

        foreach ($this->owner->stat('excluded_children') as $class) {
            $children = $class::get()->filter('ParentID', $this->owner->ID);
            $title = singleton($class)->plural_name();

            $fields->addFieldToTab($tab, new PageHolderGridField($class, $title, $children), $before);
        }
    }
}
