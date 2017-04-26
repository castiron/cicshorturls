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

if (
    class_exists('TYPO3\\CMS\\Core\\Imaging\\IconProvider\\FontawesomeIconProvider') &&
    class_exists('TYPO3\\CMS\\Core\\Imaging\\IconRegistry')
) {
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Imaging\\IconRegistry')->registerIcon(
        'bolt-icon',
        'TYPO3\\CMS\\Core\\Imaging\\IconProvider\\FontawesomeIconProvider',
        [
            'name'     => 'bolt',
            'spinning' => true
        ]
    );
}

/**
 * Hook to remove short URIs that are copied when a page is copied
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] =
    'CIC\\Cicshorturls\\Hook\\RemoveCopiedShortUrisHook';

/**
 * Hook to fix wrong pid on Short URIs when a page is moved (there seems to be a bug in the default TCA values in
 * this case).
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] =
    'CIC\\Cicshorturls\\Hook\\EnsureShortUriStorageHook';
