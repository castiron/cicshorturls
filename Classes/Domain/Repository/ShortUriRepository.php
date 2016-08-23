<?php
namespace CIC\Cicshorturls\Domain\Repository;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Gabe Blair <gabe@castironcoding.com>, Cast Iron Coding
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The repository for ShortUris
 */
class ShortUriRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    /**
     * @var \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    var $db;

    /**
     * @var \CIC\Cicshorturls\Factory\ShortUriFactory
     * @inject
     */
    var $shortUriFactory;

    const TABLE_NAME = 'tx_cicshorturls_domain_model_shorturi';

    public function initializeObject() {
        $this->db = $GLOBALS['TYPO3_DB'];
    }

    /**
     * @param $uri
     * @return null
     */
    public function findOneByUri($uri) {
        $res = $this->db->exec_SELECTgetRows('uri,uid,page,pid', self::TABLE_NAME, 'uri=' . $this->db->fullQuoteStr($uri, self::TABLE_NAME), '', '', '1');
        if ($res[0]) {
            return $this->shortUriFactory->get($res[0]);
        }
        return null;
    }
}
