<?php
namespace CIC\Cicshorturls\Migration;

/**
 * Class AddCacheTables1452824648
 * @package CIC\Cicshorturls\Migration
 */
class AddCacheTables1452824648 extends \CIC\Cicbase\Migration\AbstractMigration {
    public function run() {
        $this->db->sql_query('CREATE TABLE IF NOT EXISTS cf_tx_cicshorturls_cache ( id int(11) unsigned NOT NULL auto_increment, identifier varchar(250) NOT NULL default \'\', expires int(11) unsigned NOT NULL default \'0\', content mediumblob, PRIMARY KEY (id), KEY cache_id (identifier,expires) ) ENGINE=InnoDB;');
        $this->db->sql_query('CREATE TABLE IF NOT EXISTS cf_tx_cicshorturls_cache_tags ( id int(11) unsigned NOT NULL auto_increment, identifier varchar(250) NOT NULL default \'\', tag varchar(250) NOT NULL default \'\', PRIMARY KEY (id), KEY cache_id (identifier), KEY cache_tag (tag) ) ENGINE=InnoDB;');
    }

    public function revert() {
        $this->db->sql_query('DROP TABLE cf_tx_cicshorturls_cache;');
        $this->db->sql_query('DROP TABLE cf_tx_cicshorturls_cache_tags;');
    }
}
