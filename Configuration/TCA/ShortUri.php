<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_cicshorturls_domain_model_shorturi'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_cicshorturls_domain_model_shorturi']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'uri, page',
	),
	'types' => array(
		'1' => array('showitem' => 'uri, page'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'uri' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cicshorturls/Resources/Private/Language/locallang_db.xlf:tx_cicshorturls_domain_model_shorturi.uri',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,unique,lower,required,CIC\\Cicshorturls\\Tca\\UrlNormalizeEvaluation'
			),
		),
		'page' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cicshorturls/Resources/Private/Language/locallang_db.xlf:tx_cicshorturls_domain_model_shorturi.page',
			'config' => array(
				'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
				'foreign_table' => 'pages',
				'minitems' => 1,
				'maxitems' => 1,
                'size' => 1,
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest'
                    ),
                ),
			),
		),

	),
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['CIC\\Cicshorturls\\Tca\\UrlNormalizeEvaluation'] = '';
