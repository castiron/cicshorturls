<?php namespace CIC\Cicshorturls\Utility;

use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * Class ShortUriConfigUtility
 * @package CIC\Cicshorturls\Utility
 */
class ShortUriConfigUtility {
    const SHORT_URI_TABLE = 'tx_cicshorturls_domain_model_shorturi';

    /**
     * @param $pageUid
     * @return int
     */
    public static function shortUriStoragePid($pageUid) {
        $tsConfig = BackendUtility::getPagesTSconfig($pageUid);
        return @intval($tsConfig['TCAdefaults.']['tx_cicshorturls_domain_model_shorturi.']['pid']);
    }
}
