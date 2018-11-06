<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$tempColumns = Array(
    'tx_cicshorturls_uris' => array(
        'exclude' => 0,
        'label' => 'Short URIs',
        'config' => array(
            'type' => 'inline',
            'foreign_table' => 'tx_cicshorturls_domain_model_shorturi',
            'foreign_field' => 'page',
            'appearance' => array(
                'collapseAll' => true,
                'enabledControls' => array(
                    'sort' => false,
                    'hide' => false,
                    'delete' => true,
                    'localize' => false,
                ),
                'newRecordLinkTitle' => 'Add a short URI'
            ),
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'tx_cicshorturls_uris', '', 'before:tx_realurl_pathsegment');
