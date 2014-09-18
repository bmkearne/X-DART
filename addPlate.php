<?php
session_start();
require("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="jquery.imagemapster.js"></script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
	if(!isset($_SESSION['name']))
                print '<meta http-equiv="Refresh" content="0; URL=index.php" />';
?>
	<link type="text/css" media="screen" href="CSS/style.css" rel="stylesheet" />
	<link type="text/css" media="print" href="CSS/print.css" rel="stylesheet" />
	<title>X-DART - Add New Plate</title>
</head>
<body>
	<div id="wrapper">
		<div id="logo" class="clearfix">
			<img src="images/d_pattern.png" width="93" height="93" alt="" class="headimg" />
			<img src="images/logo.png" width="581" height="93" alt="X-DART: X-ray Data and Record Tracking" class="nameimg" />
		</div>
		<div id="bar">
<?php
                        print "<p>&nbsp; Logged in as: {$_SESSION['name']} &nbsp;";
                        $res = mysql_query("SELECT * FROM user WHERE name = '{$_SESSION['name']}' AND "
                                ."email = '{$_SESSION['mail']}'",$link);
                        $resset = mysql_fetch_array($res);
                        print "&nbsp; - &nbsp; &nbsp;<a href=\"users.php?user={$resset['User_ID']}\">User Info</a>";
                        print '&nbsp; &nbsp; - &nbsp; &nbsp;<a href="logout.php">Logout</a></p>';
?>
		</div>
		<div id="top">
			<img src="images/top.gif" width="765" height="33" alt="" />
		</div>
		<div id="content">
<?php 
	if(isset($_POST['form_submit']))
	{
if(!empty($_POST['PI']) && !empty($_POST['exptitle']))
{
	$mysqltime = date ("Y-m-d H:i:s", $phptime);
	$insert_query = "INSERT INTO plate VALUES (Default, {$_SESSION['UID']}, {$_POST['PI']}, '{$_POST['exptitle']}', '{$_POST['protein']}', '{$_POST['plasmid']}', Default)";
	$insert_results = mysql_query($insert_query, $link) or die('Invalid Query:'.mysql_error());
	$last= mysql_insert_id();
	?><meta http-equiv="Refresh" content="0; URL='viewPlate.php?id=<?php print $last?>'/>;<?php
}
else
		print "Invalid input in one or more required fields....";
	}
	else
	{
?>
			<h1>Add New Tray</h1>
			<br />
<?php
if(isset($_SESSION['name']) && $_SESSION['access'] >= 100) {
?>			<form method="post" action="<?php print "{$_SERVER['PHP_SELF']}"; ?>">
			<table width="90%">
				<tr>
					<th width="20%">Name</th>
					<td><!--<input type="text" size="30" maxlength="50" name="name" value="<?php print "{$_SESSION['name']}"; ?>" disabled />--><?php print "{$_SESSION['name']}"; ?></td>
				</tr>
				<tr>
					<td><b>PI</b></td> 
					<td>
<select name="PI">
  <option value=<?php print $_SESSION['PI']; ?>><?php print $_SESSION['PI_name']; ?></option>
  <?php $query = "SELECT * FROM user WHERE level = 200 OR level = 777 AND name != '{$_SESSION['PI_name']}'";
$results = mysql_query($query, $link) or die('Invalid Query:'.mysql_error()); 
while($PIArray = mysql_fetch_array($results))
{
print "<option value={$PIArray['user_ID']}>{$PIArray['name']} </option>";
}

?>

</select>
<!--<input type="text" size="30" maxlength="50" name="PI" value="<?php print "{$_SESSION['PI']}";?>" />-->
</td>
				</tr>
				<tr>
					<td><b>Experiment Title</b></td> 
					<td><input type="text" size="30" maxlength="50" name="exptitle" value="" /></td>
				</tr>
				<tr>
					<td><b>Protein</b></td> 
					<td><input type="text" size="30" maxlength="50" name="protein" value="" /></td>
				</tr>
				<tr>
					<td><b>Plasmid</b></td> 
					<td><input type="text" size="30" maxlength="50" name="plasmid" value="" /></td>
				</tr>
				</table>
				 <!--begin tray mapping
				<img id="tray" src="24WellVDX2.png" usemap="#tray">-->


			
			<br />
				<input type="submit" value="Add this tray" name="Add User" alt="Edit" />
				<input type="hidden" name="form_submit" />
				</form>
			<br />
<?php 
	}
	else Print "You are not authorized to view this page.";
	}
?>
		</div>
<div id="nav">
			<?php include 'footer.php';?>
		</div>
	<div id="footer">
		<hr />
		<p>&copy; 2014 Bradley Kearney</p>
	</div>
	</div>
</body>
</html>