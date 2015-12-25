<?php
	
	define ('DEBUG08', false);
	
	define ('RADIO_LIMIT', 15);
	
	define ('RADIO_MULTILINE_LIMIT', 8); //ab 8 antwortmöglichkeiten mehrzeilig
	define ('RADIO_MULTILINE_ROWS', 4);  //anzahl der spalten
	
	define ('SESSION_PATH', "./sessions/");
	define ('SESSION_EXPIRE', "100");
	define ('SYSTEM_DIR', "./system/");
    define ('BACKUP_DIR', "./backup/");
	define ('STATIC_DIR', "./static/");
	define ('LOCK_DIR', "./locks/");
	define ('STYLE_PATH', "./styles/");
	define ('TEXT_PATH', "./texts/");
	
	//victor
	//define ('DB_HOST', "95.129.200.10");
	//define ('DB_USER', "banksql");
	//define ('DB_PASS', "ma10R58z");
	//define ('DB_BASE', "bdj_db");

	define ('DB_HOST', "localhost");
	define ('DB_USER', "bankdesje_sql");
	define ('DB_PASS', "cNcPjCYFzzKJ9");
	define ('DB_BASE', "bankdesje_db");

	define ('DB_SCRIPT', SYSTEM_DIR . "database.sql");
	
	define('USERNAME', "administrator");
	define('PASSWORD', "um15vieb");
	
	define ('TITLE', "victor 2015");
	define ('DB_ID', "victor2015");
  
	define ('BANK',     DB_ID . "bank");
	define ('ZUG',      DB_ID . "zugangsdaten");
	define ('PERSONEN', DB_ID . "personen");
	define ('FF',       DB_ID . "f_f");
	define ('BOGEN',    DB_ID . "fragebogen");
	define ('RES',      DB_ID . "ergebnisse");
	define ('FRAGE',    DB_ID . "frage");
	define ('LANG',     DB_ID . "languages");
	define ('TRANS',    DB_ID . "translations");
	define ('QALIAS',   DB_ID . "qalias");
	define ('META',     DB_ID . "meta");
	define ('ALIAS',    DB_ID . "alias");
  
	require_once(SYSTEM_DIR . "locks"); 
	require_once(SYSTEM_DIR . "alias"); 
	require_once(SYSTEM_DIR . "meta");  
	require_once(SYSTEM_DIR . "qalias"); 
	require_once(SYSTEM_DIR . "db"); 
	require_once(SYSTEM_DIR . "vis"); 
	require_once(SYSTEM_DIR . "debug"); 
	require_once(SYSTEM_DIR . "bank"); 
	require_once(SYSTEM_DIR . "userg"); 
	require_once(SYSTEM_DIR . "codes"); 
	require_once(SYSTEM_DIR . "questions"); 
	require_once(SYSTEM_DIR . "forms"); 
	require_once(SYSTEM_DIR . "panels"); 
	require_once(SYSTEM_DIR . "system"); 
	require_once(SYSTEM_DIR . "public");
	require_once(SYSTEM_DIR . "lang");  
	require_once(SYSTEM_DIR . "settings");
	require_once(SYSTEM_DIR . "styles");
	require_once(SYSTEM_DIR . "texts"); 
 
 ?>