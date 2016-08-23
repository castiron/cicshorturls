<?php
namespace CIC\Cicshorturls\Migration;

use \CIC\Cicbase\Migration\AbstractMigration;

/**
 * Class AddUriField1452715871
 * @package CIC\Cicshorturls\Migration
 */
class AddUriField1452715871 extends AbstractMigration {
    /**
     *
     */
    public function run() {
        $this->setForgiving(true);
        $this->addTinytextField('pages', 'tx_cicshorturls_uris');
    }

    /**
     *
     */
    public function rollback() {
        $this->setForgiving(true);
        $this->dropFieldFromTable('pages', 'tx_cicshorturls_uris');
    }
}
