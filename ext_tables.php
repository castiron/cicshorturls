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

//$tempColumns = Array(
//    'tx_cicshorturls_uris' => array(
//        'exclude' => 0,
//        'label' => 'Short URIs (1 per line)',
//        'config' => array(
//            'type' => 'text',
//            'cols' => 30,
//            'rows' => 3,
//            'eval' => 'trim'
//        ),
//    ),
//);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'tx_cicshorturls_uris', '', 'before:tx_realurl_pathsegment');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/Typoscript', 'Short URLs');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cicshorturls_domain_model_shorturi', 'EXT:cicshorturls/Resources/Private/Language/locallang_csh_tx_cicshorturls_domain_model_shorturi.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cicshorturls_domain_model_shorturi');

/**
 * Add the storage pid
 */
if ($storagePid = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['storagePid']) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'TCAdefaults.tx_cicshorturls_domain_model_shorturi.pid = ' .
          intval($GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['storagePid'])
    );
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['CIC\\Cicshorturls\\Tca\\UrlNormalizeEvaluation'] = '';
