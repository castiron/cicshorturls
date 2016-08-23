<?php

namespace CIC\Cicshorturls\Migration;

/**
 * Class AddShortUriTable1452895056
 */
class AddShortUriTable1452895056 extends \CIC\Cicbase\Migration\AbstractMigration {
    /**
     *
     */
    public function run() {
        $this->db->sql_query('CREATE TABLE IF NOT EXISTS tx_cicshorturls_domain_model_shorturi ( uid int(11) NOT NULL auto_increment, pid int(11) NOT NULL default \'0\', uri varchar(255) NOT NULL default \'\', page int(11) unsigned default \'0\', tstamp int(11) unsigned NOT NULL default \'0\', crdate int(11) unsigned NOT NULL default \'0\', cruser_id int(11) unsigned NOT NULL default \'0\', deleted tinyint(4) unsigned NOT NULL default \'0\', hidden tinyint(4) unsigned NOT NULL default \'0\', starttime int(11) unsigned NOT NULL default \'0\', endtime int(11) unsigned NOT NULL default \'0\', PRIMARY KEY (uid), KEY parent (pid) );');
    }

    /**
     *
     */
    public function rollBack() {
        $this->db->sql_query('DROP TABLE IF EXISTS tx_cicshorturls_domain_model_shorturi');
    }
}
