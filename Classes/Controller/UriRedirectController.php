<?php

namespace CIC\Cicshorturls\Controller;
use CIC\Cicshorturls\Utility\UriUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Frontend\Utility\EidUtility;

/**
 * Class UriRedirectController
 * @package CIC\Cicshorturls\Controller
 */
class UriRedirectController {
    /**
     * @var \CIC\Cicshorturls\Domain\Repository\ShortUriRepository
     * @inject
     */
    var $shortUriRepository;

    /**
     * @var \CIC\Cicshorturls\Service\ShortUriCacheService
     * @inject
     */
    var $cacheService;

    /**
     * @var string
     */
    var $currentUri;

    /**
     *
     */
    public function initializeObject() {
        $this->initCurrentUri();
    }

    /**
     *
     */
    public function execute() {
        if (!$this->currentUri) {
            return;
        }
        if ($uri = $this->getUri()) {
            $this->redirectToShortUri($uri);
        }
    }

    /**
     * @param $uri
     */
    protected function redirectToShortUri($uri) {
        if (UriUtility::normalizeUri($uri) !== UriUtility::normalizeUri($this->currentUri)) {
            HttpUtility::redirect($uri, HttpUtility::HTTP_STATUS_301);
        }
    }

    /**
     * @return null|string
     */
    public function getUri() {
        $uri = null;

        $cache = $this->cacheService->getCache();
        $cacheId = $this->cacheService->cacheId($this->currentUri);

        /**
         * Find a cached one? NB: falsy values are wanted, because they should indicate a page
         * that doesn't have any short URLs, which we want to cache, so we don't have to look for a shortUri every time
         */
        if (false !== ($uri = $cache->get($cacheId))) {
            return $uri;
        }

        /**
         * Determine if this URI has an associated record, and get the target URI to which we want to redirect
         */
        $shortUri = $this->applicableUri();
        $tags = array();
        if ($shortUri) {
            $this->initSystem();
            $uri = $shortUri->getTargetUri();
            if ($id = $shortUri->getUid()) {
                $tags[] = $id;
            }
        } else {
            $uri = '';
        }

        /**
         * Cache both non-redirects and redirects. This will save us the trouble of running
         * $this->initSystem() on every page load (including 404s, etc.).
         */
        $cache->set($cacheId, $uri, $tags);

        return $uri;
    }

    /**
     * @return \CIC\Cicshorturls\Domain\Model\ShortUri
     */
    protected function applicableUri() {
        return $this->shortUriRepository->findOneByUri($this->currentUri);
    }

    /**
     * @return string
     */
    protected function initCurrentUri() {
        $this->currentUri = UriUtility::normalizeUri(GeneralUtility::getIndpEnv('REQUEST_URI'));
    }

    /**
     * Need this for finding extension settings
     * Need to init TCA for fetching category relations
     * @throws \TYPO3\CMS\Core\Error\Http\ServiceUnavailableException
     */
    protected function initSystem() {
        global $TSFE;
        if (is_object($TSFE)) {
            return;
        }
        /** @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $TSFE */
        $TSFE = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            'TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController', $GLOBALS['TYPO3_CONF_VARS'], 0, 0);
        $TSFE->initFEuser();
        $TSFE->determineId();
        $TSFE->initTemplate();
        $TSFE->getConfigArray();
        EidUtility::initTCA();
    }
}
