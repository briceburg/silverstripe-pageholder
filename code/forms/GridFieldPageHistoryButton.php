<?php
class GridFieldPageHistoryButton extends GridFieldViewButton {
    /**
     * @param GridField $gridField
     * @param DataObject $record
     * @param string $columnName
     * @return string - the HTML for the column
     */
    public function getColumnContent($gridField, $record, $columnName) {
        if (!$record->canEdit()) {
            return;
        }

        $history_controller = singleton('CMSPageHistoryController');

        $data = new ArrayData(array(
            'Link' => Controller::join_links($history_controller->Link('show'), $record->ID)
        ));

        return $data->renderWith('GridFieldPageHistoryButton');
    }
}