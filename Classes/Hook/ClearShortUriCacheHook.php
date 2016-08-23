<?php

namespace CIC\Cicshorturls\Hook;

/**
 * Class ShortUriCacheHook
 * @package CIC\Cicshorturls\Hook
 */
class ClearShortUriCacheHook {
    /**
     * @param array $params
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $dataHander
     */
    public function execute($params, $dataHander) {
        $shortUriTable = 'tx_cicshorturls_domain_model_shorturi';
        /** @var \CIC\Cicshorturls\Service\ShortUriCacheService $o */
        $o = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')
            ->get('CIC\\Cicshorturls\\Service\\ShortUriCacheService');
        $o->updateCacheFromDataHandler(
            $params,
            $dataHander->datamap[$shortUriTable],
            $dataHander->cmdmap[$shortUriTable]
        );
    }
}
