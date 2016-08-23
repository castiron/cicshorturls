<?php

namespace CIC\Cicshorturls\Factory;

/**
 * Class ShortUriFactory
 * @package CIC\Cicshorturls\Factory
 */
class ShortUriFactory {
    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    var $objectManager;

    /**
     * @param $params
     * @return \CIC\Cicshorturls\Domain\Model\ShortUri
     */
    public function get($params) {
        /** @var \CIC\Cicshorturls\Domain\Model\ShortUri $out */
        $out = $this->objectManager->get('CIC\\Cicshorturls\\Domain\\Model\\ShortUri');
        $out->setPage($params['page']);
        $out->setUri($params['uri']);
        $out->_setProperty('uid', $params['uid']);
        $out->setPid($params['pid']);
        return $out;
    }
}
