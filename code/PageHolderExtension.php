<?php


// from # ExcludeChildren Module
class PageHolderExtension extends Hierarchy
{
    protected $hiddenChildren = array();

    public static function include_requirements() {
        $moduleDir = self::get_module_dir();
        Requirements::css($moduleDir.'/css/holderpage.css');
    }

    public static function get_module_dir() {
        return basename(dirname(__DIR__));
    }

    public function updateCMSFields(FieldList $fields)
    {

        self::include_requirements();

        foreach ($this->owner->config()->get("child_page_classes") as $class => $title) {
            $children = $class::get()->filter('ParentID', $this->owner->ID);
            $fields->addFieldToTab('Root.Main', new VersionedGridField($class, $title, $children), 'Metadata');
        }
    }

    public function getExcludedClasses()
    {
        $configClasses = $this->owner->config()->get("child_page_classes");
        $hiddenChildren = array();
        if ($configClasses) {
            foreach ($configClasses as $class => $title) {
                $hiddenChildren = array_merge($hiddenChildren, array_values(ClassInfo::subclassesFor($class)));
            }
        }
        $this->hiddenChildren = $hiddenChildren;
        return $this->hiddenChildren;
    }

    public function stageChildren($showAll = false)
    {
        $staged = parent::stageChildren($showAll);
        $action = Controller::curr()->getAction();
        if (in_array($action, array(
            'treeview',
            'getsubtree'
        ))) {
            $staged = $staged->exclude('ClassName', $this->getExcludedClasses());
        }
        return $staged;
    }

    public function liveChildren($showAll = false, $onlyDeletedFromStage = false)
    {
        $staged = parent::liveChildren($showAll, $onlyDeletedFromStage);
        $action = Controller::curr()->getAction();
        if (in_array($action, array(
            'treeview',
            'getsubtree'
        ))) {
            $staged = $staged->exclude('ClassName', $this->getExcludedClasses());
        }
        return $staged;
    }
}