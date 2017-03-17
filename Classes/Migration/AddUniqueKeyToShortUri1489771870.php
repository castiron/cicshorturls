<?php namespace CIC\Cicshorturls\Migration;

use CIC\Cicbase\Migration\AbstractMigration;

/**
 * Class AddUniqueKeyToShortUri1489771870
 * @package CIC\Cicshorturls\Migration
 */
class AddUniqueKeyToShortUri1489771870 extends AbstractMigration {
    /**
     *
     */
    public function run() {
        $this->setForgiving();
        $this->addUniqueKey('tx_cicshorturls_domain_model_shorturi', 'uri', 'uri', 255);
    }

    /**
     *
     */
    public function rollback() {
        $this->setForgiving();
        $this->dropKeyFromTable('tx_cicshorturls_domain_model_shorturi', 'uri');
    }
}
