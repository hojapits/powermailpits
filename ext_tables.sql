#
# Table structure for table 'tx_powermail_domain_model_fields'
#
CREATE TABLE tx_powermail_domain_model_fields (
  tx_powermailextended_powermail_text varchar(255) DEFAULT '' NOT NULL,
  tx_powermailextended_powermail_readonly tinyint(4) unsigned DEFAULT '0' NOT NULL,
  tx_powermailextended_powermail_selectedCountries text DEFAULT '' NOT NULL,
  tx_powermailextended_powermail_excludedCountries text DEFAULT '' NOT NULL,
);