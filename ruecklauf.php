<?php

/**

  administration
  
**/


//defaults, directories
require_once("./settings.php");


//begin db

$db = initDB();

if(!connectDB($db))
{
  debug($db['msg']);
  die();
}

session_cache_expire(SESSION_EXPIRE);
session_save_path(SESSION_PATH);


session_start();

define (U09A, true);
//if ($u09a) define (U09A, true);
//else if ($_SESSION['u09a']) define (U09A, $_SESSION['u09a']);

//$_SESSION['u09a'] = U09A;

$r = $_REQUEST;
reset($r);
$key = key($r);
$v = $_REQUEST[$key];
reset($r);
$k = key($r);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
  <head>
     <title><?php echo TITLE; ?> - administration</title>
     <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
     <link rel="stylesheet" type="text/css" href="./styles/admin/style.css" />
     <script language="javascript" type="text/javascript">
     function addText(text, caller) 
     {
	     document.editform.reihenfolge.value += text;
	     caller.className='used';
     }
</script>
  </head>

<?php

//begin page

echo "<body>";
echo "<table class='main' cellspacing='0' cellpadding='0'>";
echo "  <tr class='head'>";
//echo "    <td style='width:60px; overflow:hidden;'><img style='' src='./images/headImage.png' /></td>";
echo "    <td colspan=2>";
echo "   <span style='font-size: 32pt; color: #FFFFFF; padding: 50px;'>    Administration</span>";
echo "    </td>";
echo "  </tr>";
      
echo "  <tr class='head2'>";
echo "    <td class='quicklinks' style='text-align: left;'>";

if  ($_SESSION['isadmin'])
{
    echo "admin, " . DB_USER . "@" . DB_HOST;
    echo "<br/>";
    echo DB_ID;
}
else
  echo "&nbsp;";

 
echo "    </td>";
echo "    <td/>";



echo "    </td>";
echo "  </tr>";

echo "  <tr class='content'>";
echo "   <td class='nav'>";


echo "   </td>";
echo "   <td class='content'>";
   
 echoBankStatistik(); 
switch($k)
{   
  case "statistik":
    
    echoStatistikBank($r['limit'], getBankList());
    
    break;
  
  /*default:
  echoBankStatistik();
  echo $k;
  break;*/
}


echo "   </td>";
echo " </tr>";

echo " <tr class='foot'>";
echo "   <td colspan='2'>" . TITLE . "</td>";
echo " </tr>";
            
echo "</table>";
echo "</body>";



closeDB($db);

//end page
?>

</html>