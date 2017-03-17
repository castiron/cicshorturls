#
# Table structure for table 'tx_cicshorturls_domain_model_shorturi'
#
CREATE TABLE tx_cicshorturls_domain_model_shorturi (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	uri varchar(255) DEFAULT '' NOT NULL,
	page int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	UNIQUE KEY uri (uri),
	KEY parent (pid)

);

CREATE TABLE pages (
  tx_cicshorturls_uris tinytext NOT NULL
);
