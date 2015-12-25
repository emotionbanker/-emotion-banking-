<?php

require_once("settings");

define('DEBUG', false);

$relations = Array();


$relations['144']['killer'] = "nein";
$relations['144']['subs'] = array(145, 146);

$relations['107']['killer'] = "nein";
$relations['107']['subs'] = array(655, 656);

$relations['104']['killer'] = "nein";
$relations['104']['subs'] = array(105);

$relations['213']['killer'] = "nein";
$relations['213']['subs'] = array(214, 215);

$relations['135']['killer'] = "Nie";
$relations['135']['subs'] = array(136);

$relations['647']['killer'] = "nie";
$relations['647']['subs'] = array(39, 40, 41, 43, 46, 48, 648, 649, 142, 137, 650);

$relations['256']['killer'] = "nein";
$relations['256']['subs'] = array(257);

$relations['258']['killer'] = "nein";
$relations['258']['subs'] = array(259);

$relations['281']['killer'] = "nein";
$relations['281']['subs'] = array(282);

//debug($relations);

$db = initDB();

if(!connectDB($db))
{
  debug($db['msg']);
  die();
}


foreach ($relations as $master => $rel)
{
	debug($rel);
	
	$quer = "select z_id from v06zugangsdaten zd, v06ergebnisse erg where erg.e_z_id = zd.z_id and erg.e_fr_id=".$master." and erg.antwort='".$rel['killer']."'";
	
	debug($quer);
	
	$result = query($quer);
	
	$c = 0;
	$notempty = 0;
	while ($row = mysql_fetch_row($result)) 
  {
  	$zid = $row[0];
  	
  	if (!DEBUG)
  	{
			foreach ($rel['subs'] as $sub)
			{
				$q1 = "select count(*) from v06ergebnisse where antwort!='' and e_z_id='".$zid."' and e_fr_id='".$sub."'";
				$res1 = query($q1);
				
				$r = mysql_fetch_row($res1);
				
				$notempty += $r[0];
				
				$q = "update v06ergebnisse set antwort='' where e_z_id='".$zid."' and e_fr_id='".$sub."'";
				
				query($q);
				//debug($q);
			}
  	}
  	
  	$c++;
  }
  
  debug($notempty . " not empty");
  
  //if (DEBUG)
  //{
  	debug($c);
  //}
}

?>