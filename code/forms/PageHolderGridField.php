<?php

class PageHolderGridField extends GridField {


    public function __construct($name, $title = null, SS_List $dataList = null) {
        parent::__construct($name, $title, $dataList);

        $config = new GridFieldConfig_RecordEditor();
        $config->removeComponentsByType('GridFieldDeleteAction');
        $config->removeComponentsByType('GridFieldDetailForm');
        $config->addComponent(new PageHolderGridFieldDetailForm());
        $config->addComponent(new GridFieldPageHistoryButton(),'GridFieldPageCount');

        $this->setConfig($config);
    }
}