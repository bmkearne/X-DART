<?php

session_start();
require("config.php");
include('phpqrcode/qrlib.php');
function foo($name)
{
$tempDir = 'tempdir/';
$parse = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$url_to_use = "http://$_SERVER[HTTP_HOST]".dirname($parse['path']).'/';
$codeContents = $url_to_use.'viewPlate.php?id='.trim($name);

    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = '005_file_'.md5($codeContents).'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = 'tempdir/'.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);}

    
    // displaying
 $imageData2 = $urlRelativeFilePath;
return $imageData2;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" media="screen, handheld" href="CSS/style.css" rel="stylesheet" />
	<link type="text/css" media="print, projection" href="CSS/print.css" rel="stylesheet" />
	<title>X-DART Online</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="jquery.imagemapster.js"></script>
	<!--Crystallography Data and Record Tracker -->
</head>

<body>
			<form id="myform" method="post" action="test2.php">
	<div id="wrapper">
<div id="logo" class="clearfix">
			<img src="images/d_pattern.png" width="93" height="93" alt="" class="headimg" />
			<img src="images/logo.png" width="581" height="93" alt="X-DART: X-ray Data and Record Tracking" class="nameimg" />
		</div>
		<div id="bar">
<?php
if( isset($_SESSION['name']) ) {
                        print "<p>&nbsp; Logged in as: {$_SESSION['name']} &nbsp;";
                        print '&nbsp; - &nbsp; &nbsp;<a href="users.php">User Info</a>';
			print '&nbsp; &nbsp; - &nbsp; &nbsp;<a href="logout.php">Logout</a></p>';
}
else print "Please Log In."; 
?>
		</div>
		<div id="top">
			
		</div>
		<div id="content">
		<?php 
		$query = "SELECT * FROM plate WHERE plate.UID = {$_GET['id']}";
		$results = mysql_query($query, $link) or die('Invalid Query: '.mysql_error());
		$results = mysql_fetch_array($results);
		?>
		<h1>Tray Overview - Plate <?php print $_GET['id'];?>: <?php print "{$results['protein']}<br/>";?></h1>
		<table width="90%" border=1>
		<tr>
		<td width="1%">
		
			<img id="tray" src="24WellVDX2.png" usemap="#tray">
		</td>
		<td width="1%"><center>
		<style>
		input {
		width: 10em;
		}
		</style>
		<img src="<?php echo foo($_GET['id']);?>" />
		<br/>
		<input type="button" size="20" value="Define Slides" onClick="dothis()" />	<br/>
		<input type="button" size="20" value="Edit Reservoir" onClick="dothis()" />	<br/>
		<input type="button" size="20" value="Analyze Slides" onClick="dothis()" />	<br/>
		<input type="button" size="20" value="Harvest Crystals" onClick="dothis()" />	<br/>	</center>	
		<td width="33%">
		<iframe id="myIframe2" src="viewPlate_stats.php?id=<?php print "{$_GET['id']}"; ?>" width="100%" height="409" ></iframe></td></tr></table>
			<map id="tray" name="tray">

<area shape="rect" id="Arow" alt="" title="" coords="28,60,40,78" href="#" target="" />
<area shape="circle" name="A1" alt="" title="" coords="74,73,28" href="#" target="" /><area shape="circle" name="A2" alt="" title="" coords="151,72,28" href="#" target="" /><area shape="circle" name="A3" alt="" title="" coords="223,73,28" href="#" target="" /><area shape="circle" name="A4" alt="" title="" coords="296,73,28" href="#" target="" /><area shape="circle" name="A5" alt="" title="" coords="366,73,28" href="#" target="" /><area shape="circle" name="A6" alt="" title="" coords="437,72,28" href="#" target="" />

<area shape="rect" id="Brow" alt="" title="" coords="30,132,43,153" href="" target="" />
<area shape="circle" name="B1" alt="" title="" coords="75,143,28" href="#" target="" /><area shape="circle" name="B2" alt="" title="" coords="150,144,28" href="#" target="" /><area shape="circle" name="B3" alt="" title="" coords="223,144,28" href="#" target="" /><area shape="circle" name="B4" alt="" title="" coords="297,144,28" href="#" target="" /><area shape="circle" name="B5" alt="" title="" coords="367,144,28" href="#" target="" /><area shape="circle" name="B6" alt="" title="" coords="437,144,28" href="#" target="" />

<area shape="rect" id="Crow" alt="" title="" coords="28,201,43,223" href="" target="" />
<area shape="circle" name="C1" alt="" title="" coords="75,216,28" href="#" target="" /><area shape="circle" name="C2" alt="" title="" coords="152,218,28" href="#" target="" /><area shape="circle" name="C3" alt="" title="" coords="223,217,28" href="#" target="" /><area shape="circle" name="C4" alt="" title="" coords="297,217,28" href="#" target="" /><area shape="circle" name="C5" alt="" title="" coords="365,217,28" href="#" target="" /><area shape="circle" name="C6" alt="" title="" coords="437,216,28" href="#" target="" />

<area shape="rect" id="Drow" alt="" title="" coords="27,278,45,299" href="" target="" />
<area shape="circle" name="D1" alt="" title="" coords="75,292,28" href="#" target="" /><area shape="circle" name="D2" alt="" title="" coords="151,292,28" href="#" target="" /><area shape="circle" name="D3" alt="" title="" coords="224,292,28" href="#" target="" /><area shape="circle" name="D4" alt="" title="" coords="297,292,28" href="#" target="" /><area shape="circle" name="D5" alt="" title="" coords="366,291,28" href="#" target="" /><area shape="circle" name="D6" alt="" title="" coords="437,292,28" href="#" target="" />

</map>
<!--end mapping-->
            <span id="selections2"></span>

			<input type="text" name="selections" id="selections" hidden>
			<input type="text" name="plateID" id="plateID" value="<?php print $_GET['id'];?>" hidden>
	
			</form>
<?php $res =  mysql_query("SELECT * FROM slide WHERE plate_ID = '{$_GET['id']}'",$link);
     $res2 =  mysql_query("SELECT * FROM slide WHERE plate_ID = '{$_GET['id']}'",$link);?>

			<script>

			//var csv="A1,A2,A3,A4,A5";
			var csv="<?php 	 while ($results = mysql_fetch_array($res)){
	  print $results['position'];print",";}?>";
//$(document).ready(function (){
$(window).load(function(){

var arowstate=0;
var browstate=0;
var crowstate=0;
var drowstate=0;
var selected1opts = {
        fillColor: '00ff00',
        stroke: true,
        strokeColor: '000000',
        strokeWidth: 1,
    };
	$('#submit2').click(function(e){
	e.preventDefault();
				
	});
$('#tray').mapster({
	areas:[
	<?php while($results = mysql_fetch_array($res2))
	{
		print "{\n";
		print "key: '".$results['position']."',\n";
		print "highlight: false,\n";
		print "staticState: true,\n";
		print "isSelectable: false,\n";
		print "isDeselectable: false,\n";
		print "fillColor: '00ff00',\n";
		print "},\n";
	}?>
	],
	singleSelect : false,
	//render_highlight : { altImage : '24WellVDX2_2.png' },
    mapKey: 'name',
	fill : true,
	fillColor: '000000',
	fillOpacity : 1,
	
    onConfigured: function(){
	$('#tray').mapster('set',true,csv,selected1opts);
	$('#tray').mapster('snapshot');
	$('#tray').mapster('unbind',preserveState);
	alert("?");
	},
	isSelectable: false,
	isDeselectable: false,
});



function bindlinks()
{
$("#show_selected").bind("click", function (e) {
                e.preventDefault();
				var textbox = document.getElementById('selections');
 //$('#selections').value($("#tray").mapster("get"));
 textbox.value=$("#tray").mapster("get");
 
});
};
bindlinks();
});

</script>
			<script>
function dothis()
{
	var textbox = document.getElementById('selections');
	$('#tray').mapster('set',false,csv);
	textbox.value=$("#tray").mapster("get");
	if (textbox.value.length<1 && 0)
		alert("Please select at least one well");
	else
	document.forms["myform"].submit();
				 
}
</script>

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