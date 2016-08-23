<?php

namespace CIC\Cicshorturls\Hook;

/**
 * Class ShortUriHook
 * @package CIC\Cicshorturls\Hook
 */
class ShortUriHook {
    public function execute() {
        /** @var \CIC\Cicshorturls\Controller\UriRedirectController $o */
        $o = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')
            ->get('CIC\\Cicshorturls\\Controller\\UriRedirectController');
        $o->execute();
    }
}
