<?php

namespace CIC\Cicshorturls\Service;

use CIC\Cicshorturls\Utility\UriUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Class ShortUriCacheService
 * @package CIC\Cicshorturls\Service
 */
class ShortUriCacheService {
    /**
     * @var \TYPO3\CMS\Core\Cache\CacheManager
     * @inject
     */
    var $cacheManager;

    /**
     * @var \CIC\Cicshorturls\Domain\Repository\ShortUriRepository
     * @inject
     * @lazy
     */
    var $shortUriRepository;

    /**
     * @var \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    var $db;

    /**
     *
     */
    const CACHE_KEY = 'tx_cicshorturls_cache';

    public function initializeObject() {
        $this->db = $GLOBALS['TYPO3_DB'];
    }

    /**
     * @param $uri
     * @return string
     */
    public function cacheId($uri) {
        return GeneralUtility::shortMD5(UriUtility::normalizeUri($uri));
    }

    /**
     * @return \TYPO3\CMS\Core\Cache\Frontend\FrontendInterface
     * @throws \TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException
     */
    public function getCache() {
        return $this->cacheManager->getCache(self::CACHE_KEY);
    }

    /**
     * Flush cache variously on dataHandler actions
     *
     * @param array $dataHandlerParams
     * @param array $uriDataMap
     * @param array $uriCmdMap
     */
    public function updateCacheFromDataHandler($dataHandlerParams, $uriDataMap, $uriCmdMap) {
        /**
         * Trash them all
         */
        if ($dataHandlerParams['cacheCmd'] === 'all') {
            $this->flushCache();
            return;
        }

        /**
         * Trash individual items from cache that may have been affected by BE edits
         */
        $this->flushByDataMap($uriDataMap);
        $this->flushByDataMap($uriCmdMap);
    }

    /**
     * @param array $dataMap
     */
    protected function flushByDataMap($dataMap) {
        if (is_array($dataMap) && count($dataMap)) {
            foreach ($this->getIdsFromDataMap($dataMap) as $id) {
                $this->getCache()->flushByTag(intval($id));
            }
        }
    }

    /**
     * @param $dataMap
     * @return array
     */
    protected function getIdsFromDataMap($dataMap) {
        if (!is_array($dataMap)) {
            return array();
        }
        return array_filter(array_keys($dataMap), function ($item) {
            return MathUtility::canBeInterpretedAsInteger($item);
        });
    }

    /**
     *
     */
    protected function flushCache() {
        $this->getCache()->flush();
    }

}
