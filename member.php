<?php require_once('Connections/mysqli.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO std_it12 (code_std, name_std, dep_std, tel_std) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['code_std'], "text"),
                       GetSQLValueString($_POST['name_std'], "text"),
                       GetSQLValueString($_POST['dep_std'], "text"),
                       GetSQLValueString($_POST['tel_std'], "text"));

  mysql_select_db($database_mysqli, $mysqli);
  $Result1 = mysql_query($insertSQL, $mysqli) or die(mysql_error());

  $insertGoTo = "member.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_mysqli, $mysqli);
$query_member = "SELECT * FROM std_it12";
$member = mysql_query($query_member, $mysqli) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table border="1">
      <tr>
        <td>id</td>
        <td>code_std</td>
        <td>name_std</td>
        <td>dep_std</td>
        <td>tel_std</td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_member['id']; ?></td>
          <td><?php echo $row_member['code_std']; ?></td>
          <td><?php echo $row_member['name_std']; ?></td>
          <td><?php echo $row_member['dep_std']; ?></td>
          <td><?php echo $row_member['tel_std']; ?></td>
        </tr>
        <?php } while ($row_member = mysql_fetch_assoc($member)); ?>
    </table>
  </div>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($member);
?>
