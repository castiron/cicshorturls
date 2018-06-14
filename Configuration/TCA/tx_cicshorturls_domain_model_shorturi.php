<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return [
    'ctrl' => [
        'title' => 'LLL:EXT:cicshorturls/Resources/Private/Language/locallang_db.xlf:tx_cicshorturls_domain_model_shorturi',
        'label' => 'uri',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'uri,page,',
        'iconfile' => 'EXT:cicshorturls/Resources/Public/Icons/tx_cicshorturls_domain_model_shorturi.gif',
    ],
    'interface' => [
        'showRecordFieldList' => 'uri, page',
    ],
    'types' => [
        '1' => ['showitem' => 'uri, page'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [

        'uri' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:cicshorturls/Resources/Private/Language/locallang_db.xlf:tx_cicshorturls_domain_model_shorturi.uri',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,unique,lower,required,CIC\\Cicshorturls\\Tca\\UrlNormalizeEvaluation',
            ],
        ],
        'page' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:cicshorturls/Resources/Private/Language/locallang_db.xlf:tx_cicshorturls_domain_model_shorturi.page',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'foreign_table' => 'pages',
                'minitems' => 1,
                'show_thumbs' => 1,
                'maxitems' => 1,
                'size' => 1,
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                    ],
                ],
            ],
        ],

    ],
];
