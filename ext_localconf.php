<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

/**
 * Example: This controls where URI records will be stored. Place one of these into your own localconf.
 */
//$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cicshorturls']['storagePid'] = 1234;

/**
 * This hook controls the redirection from short URIs => target pages
 */
if (TYPO3_MODE === 'FE') {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/index_ts.php']['preprocessRequest'][] =
        'CIC\Cicshorturls\Hook\ShortUriHook->execute';
}

/**
 * Determining the redirects require the TSFE to be instantiated. Register a cache for them so we
 * don't always have to do that.
 */
$cacheKey = \CIC\Cicshorturls\Service\ShortUriCacheService::CACHE_KEY;
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations'][$cacheKey] = array(
    'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\StringFrontend',
);

/**
 * For clearing the nav cache when the cache is cleared
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] =
    'CIC\\Cicshorturls\\Hook\\ClearShortUriCacheHook->execute';
