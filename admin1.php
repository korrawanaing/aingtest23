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

mysql_select_db($database_mysqli, $mysqli);
$query_admin1 = "SELECT * FROM aing_admin";
$admin1 = mysql_query($query_admin1, $mysqli) or die(mysql_error());
$row_admin1 = mysql_fetch_assoc($admin1);
$totalRows_admin1 = mysql_num_rows($admin1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <p>ข้อมูลสมาชิก สทส.12</p>
  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="">
    <p>ค้นหา :</p>
    <p>
      <a href="searh1.php">
      <input type="text" name="textfield" id="textfield" />
    </a></p>
    <p>
      <a href="searh1.php">
      <input type="submit" name="btn" id="btn" value="search" />
    </a></p>
    <p><a href="insert1.php">insert</a></p>
    <table border="1">
      <tr>
        <td>id</td>
        <td>code_std</td>
        <td>name_std</td>
        <td>dep_std</td>
        <td>tel_std</td>
        <td>option</td>
        <td>option</td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_admin1['id']; ?></td>
          <td><?php echo $row_admin1['code_std']; ?></td>
          <td><?php echo $row_admin1['name_std']; ?></td>
          <td><?php echo $row_admin1['dep_std']; ?></td>
          <td><?php echo $row_admin1['tel_std']; ?></td>
          <td><a href="delete1.php?id=<?php echo $row_admin1['id']; ?>">delete</a></td>
          <td><a href="update1.php?id=<?php echo $row_admin1['id']; ?>">update</a></td>
        </tr>
        <?php } while ($row_admin1 = mysql_fetch_assoc($admin1)); ?>
    </table>
    <p>&nbsp;</p>
  </form>
  <p>&nbsp;</p>
</div>
</body>
</html>
<?php
mysql_free_result($admin1);
?>
