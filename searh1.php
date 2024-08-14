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

$colname_search1 = "-1";
if (isset($_POST['search'])) {
  $colname_search1 = $_POST['search'];
}
mysql_select_db($database_mysqli, $mysqli);
$query_search1 = sprintf("SELECT * FROM aing_admin WHERE name_std LIKE %s", GetSQLValueString("%" . $colname_search1 . "%", "text"));
$search1 = mysql_query($query_search1, $mysqli) or die(mysql_error());
$row_search1 = mysql_fetch_assoc($search1);
$totalRows_search1 = mysql_num_rows($search1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <p>ผลการค้นหา</p>
  <p>&nbsp;</p>
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
        <td><?php echo $row_search1['id']; ?></td>
        <td><?php echo $row_search1['code_std']; ?></td>
        <td><?php echo $row_search1['name_std']; ?></td>
        <td><?php echo $row_search1['dep_std']; ?></td>
        <td><?php echo $row_search1['tel_std']; ?></td>
      </tr>
      <?php } while ($row_search1 = mysql_fetch_assoc($search1)); ?>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($search1);
?>
