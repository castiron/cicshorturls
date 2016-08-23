<?php

namespace CIC\Cicshorturls\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Gabe Blair <gabe@castironcoding.com>, Cast Iron Coding
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \CIC\Cicshorturls\Domain\Model\ShortUri.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Gabe Blair <gabe@castironcoding.com>
 */
class ShortUriTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \CIC\Cicshorturls\Domain\Model\ShortUri
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \CIC\Cicshorturls\Domain\Model\ShortUri();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getUriReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUri()
		);
	}

	/**
	 * @test
	 */
	public function setUriForStringSetsUri() {
		$this->subject->setUri('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'uri',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPageReturnsInitialValueFor() {	}

	/**
	 * @test
	 */
	public function setPageForSetsPage() {	}
}
