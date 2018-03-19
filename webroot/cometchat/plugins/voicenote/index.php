<?php

/*

CometChat
Copyright (c) 2016 Inscripts
License: https://www.cometchat.com/legal/license

*/

include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."plugins.php");

if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang.php")) {
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang.php");
}

if( checkplan('plugins','voicenote') == 0){ exit;}

$toId = $_GET['id'];
$baseData = $_REQUEST['basedata'];

$chatroommode = 0;

if (!empty($_GET['chatroommode'])) {
	$chatroommode = 1;
}

$sendername = $_REQUEST['sendername'];
$embed = '';
$embedcss = '';

if (!empty($_GET['embed']) && $_GET['embed'] == 'web') {
	$embed = 'web';
	$embedcss = 'embed';
}

if (!empty($_GET['embed']) && $_GET['embed'] == 'desktop') {
	$embed = 'desktop';
	$embedcss = 'embed';
}

$cc_layout = '';
if(!empty($_REQUEST['cc_layout'])){
	$cc_layout = $_REQUEST['cc_layout'];
}



echo <<<EOD
	<!DOCTYPE html>
	<html>
	<head>
		<meta name="viewport" content="user-scalable=0,width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>{$voicenote_language[0]}</title>
		<link type="text/css" rel="stylesheet" media="all" href="../../css.php?type=plugin&name=voicenote&cc_layout={$cc_layout}" />

		<script src="../../js.php?type=core&name=jquery"></script>
		<script>
			$ = jQuery = jqcc;
		</script>
		<script type="text/javascript" src="../../js.php?type=plugin&name=voicenote"></script>
		<script type="text/javascript" src="../../js.php?subtype=recorder&type=plugin&name=voicenote"></script>
		<script type="text/javascript" src="../../js.php?subtype=addvoicenote&type=plugin&name=voicenote"></script>
		<script type="text/javascript">
	    var id, user_tab_id;
	    id = $toId;
	    user_tab_id = 'cometchat_user_'+id+'_popup';
		</script>
	</head>
	<body>
		<form name="upload" action="upload.php?embed={$embed}" method="post" enctype="multipart/form-data">
			<div class="cometchat_wrapper">
					<div class='recording_frame'>
							<div class='audio_start audio_css' onclick='recordClick(user_tab_id);'>{$voicenote_language[4]}</div>
					</div>
					<div style="clear:both"></div>
					<input type="hidden" name="to" value="{$toId}">
					<input type="hidden" name="basedata" value="{$baseData}">
					<input type="hidden" name="chatroommode" value="{$chatroommode}">
					<input type="hidden" name="sendername" value="{$sendername}">

			</div>

			<script type='text/javascript'>
				var width = 0;
				var height = 0;
				if(typeof $ != 'undefined')
				$(document).ready(function(){
					setTimeout(function(){
						width = ($("form").outerWidth(false)+window.outerWidth-$("form").outerWidth(false));
						height = ($('form').outerHeight(false)+window.outerHeight-window.innerHeight)+10;//margin-top+margin-bottom
						window.resizeTo(width,height);
					},150);

					if(typeof(parent) != 'undefined'){
						var controlparameters = {'type':'plugin', 'name':'voicenote', 'method':'resizeCCPopup', 'params':{"id":"loadChatroomPro", "height":height, "width":width}};
	                	controlparameters = JSON.stringify(controlparameters);
	                	if(typeof(window.opener) == null){
	                		window.opener.postMessage('CC^CONTROL_'+controlparameters,'*');
	                	}else{
	                		parent.postMessage('CC^CONTROL_'+controlparameters,'*');
	                	}
					}
					//Height 80 = container_body.height(50) + embed.padding(10*2) + container.margin(5*2)

				});
			</script>

		</form>
	</body>
	</html>
EOD;
