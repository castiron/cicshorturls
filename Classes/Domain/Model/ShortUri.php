<?php
namespace CIC\Cicshorturls\Domain\Model;


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
use CIC\Cicshorturls\Utility\UriUtility;

/**
 * ShortUri
 */
class ShortUri extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     * @inject
     */
    var $contentObjectRender;

    /**
     *
     */
    public function initializeObject() {
        $this->contentObjectRender->start(array('pageId' => $this->getPage()));
    }

	/**
	 * uri
	 *
	 * @var string
	 */
	protected $uri = '';

	/**
	 * page
	 *
	 * @var int
	 */
	protected $page;

	/**
	 * Returns the uri
	 *
	 * @return string $uri
	 */
	public function getUri() {
		return UriUtility::normalizeUri($this->uri);
	}

	/**
	 * Sets the uri
	 *
	 * @param string $uri
	 * @return void
	 */
	public function setUri($uri) {
		$this->uri = UriUtility::normalizeUri($uri);
	}

    /**
     * @return int
     */
	public function getPage() {
		return $this->page;
	}

    /**
     * @param
     */
	public function setPage($page) {
		$this->page = $page;
	}

    /**
     * @return string
     */
    public function getTargetUri() {
        return $this->contentObjectRender->typoLink_URL(array(
            'parameter' => intval($this->getPage()),
        ));
    }
}
