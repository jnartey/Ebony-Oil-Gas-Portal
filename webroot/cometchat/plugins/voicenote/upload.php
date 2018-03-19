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
include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."extensions".DIRECTORY_SEPARATOR."mobileapp".DIRECTORY_SEPARATOR."config.php");

/*echo <<<EOD
	<html>
	<head>
		<style>

		</style>
	</head>
	</html>
EOD;*/

$message = '';
$mediauploaded = 1;
$filename = '';
$isImage = false;
$isVideo = false;
$isAudio = false;
$mediaType = 0;
$error = 0;
$imageFormats = array("jpg", "jpeg", "png", "gif");
$videoFormats = array("3gp", "mp4", "wmv", "avi", "mov", "flv", "mpg", "webm");
$audioFormats = array("aac", "mp3", "wav", "wma", "ogg");

//$target_dir = dirname(__FILE__)."/uploads/";
$target_dir = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."writable".DIRECTORY_SEPARATOR."voicenote".DIRECTORY_SEPARATOR."uploads/";


/*if(isset($_POST['type']) && $_POST['type'] == 'file'){
	$target_file = $target_dir . basename($_FILES["Filedata"]["name"]);
	$uploadOk = 1;
	if (move_uploaded_file($_FILES["Filedata"]["tmp_name"], $target_file)) {
	    echo "The file ". basename( $_FILES["Filedata"]["name"]). " has been uploaded.";
	} else {
	    echo "Sorry, there was an error uploading your file.";
	}
}else*/if(isset($_POST['data'])){

	$file_data = $_POST['data'];

	$data = substr($file_data, strpos($file_data, ",") + 1);
// decode it
	$decodedData = base64_decode($data);
	// print out the raw data,
	//echo ($decodedData);
	$filename = urldecode($_POST['fname']);
	// write the data out to the file
	$fp = fopen($target_dir.$filename, 'wb');
	fwrite($fp, $decodedData);
	fclose($fp);
	/*echo json_encode($_POST['data']);*/
}
//print_r($_REQUEST);
/*if (!empty($_REQUEST['callbackfn']) && $_REQUEST['callbackfn'] == 'mobileapp') {
	$filename = preg_replace("/[^a-zA-Z0-9\. ]/", "", sql_real_escape_string($_POST['name']));
	$isImage = (strpos($_POST['name'], 'MG-'))? true : false;
	$isVideo = (strpos($_POST['name'], 'ID-'))? true : false;
	$width = $_POST['imagewidth'];
	$height = $_POST['imageheight'];
	$path = pathinfo($filename);
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if (in_array(strtolower($ext), $imageFormats)) {
		$mediaType = 1;
		$isImage = true;
	}
	if (in_array(strtolower($ext), $videoFormats)) {
		$mediaType = 2;
		$isVideo = true;
	}
	if (in_array(strtolower($ext), $audioFormats)) {
		$mediaType = 3;
		$isAudio = true;
	}
} else {
	$filename = preg_replace("/[^a-zA-Z0-9\. ]/", "", sql_real_escape_string($_FILES['Filedata']['name']));
	$filename = str_replace(" ", "_",$filename);
	$path = pathinfo($filename);
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if (in_array(strtolower($ext), $imageFormats)) {
		$isImage = true;
		$mediaType = 1;
		list($width, $height) = getimagesize($_FILES['Filedata']['tmp_name']);
	} else if (in_array(strtolower($ext), $videoFormats)) {
		$width = "512";
		$height = "512";
		$isVideo = true;
		$mediaType = 2;
	} else if (in_array(strtolower($ext), $audioFormats)) {
		$width = "512";
		$height = "512";
		$isAudio = true;
		$mediaType = 3;
	}
}*/

/*print_r($_REQUEST);*/



if(isset($_REQUEST['param']) && $_REQUEST['param'] == 'actionvoicenote'){
$md5filename = md5(str_replace(" ", "_",str_replace(".","",$filename))."cometchat".time());
if ($isImage||$isVideo){
	$md5filename .= ".".strtolower($path['extension']);
}
$unencryptedfilename=rawurlencode($filename);

if(defined('AWS_STORAGE') && AWS_STORAGE == '1' && !empty($_FILES['Filedata'])) {
	include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."functions".DIRECTORY_SEPARATOR."storage".DIRECTORY_SEPARATOR."s3.php");
	$s3 = new S3(AWS_ACCESS_KEY, AWS_SECRET_KEY);
	if(!$s3->putObject($s3->inputFile($_FILES['Filedata']['tmp_name'], false), AWS_BUCKET, $bucket_path.'voicenote/'.$md5filename, S3::ACL_PUBLIC_READ)) {
		$error = 1;
	}
	$linkToFile = '//'.$aws_bucket_url.'/'.$bucket_path.'voicenote/'.$md5filename;
	$server_url = BASE_URL;
}else if(!empty($_FILES['Filedata']) && is_uploaded_file($_FILES['Filedata']['tmp_name'])) {
	if (!move_uploaded_file($_FILES['Filedata']['tmp_name'], dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'writable'.DIRECTORY_SEPARATOR.'voicenote'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$md5filename)) {
		$error = 1;
	}
	$linkToFile = BASE_URL."writable/voicenote/uploads/".$md5filename;
	$server_url = '//'.$_SERVER['SERVER_NAME'].BASE_URL;
	if(filter_var(BASE_URL, FILTER_VALIDATE_URL)){
		$server_url = BASE_URL;
	}
}
if(!empty($error)) {
	$message = 'An error has occurred. Please contact administrator. Closing Window.';
	$mediauploaded = 0;
}

if (!empty($isImage) && $isImage) {
	$imgHeight = "";
	if ($width >= $height && $height >= 50 ) {
		$imgHeight = '70px';
	} else if ($width <= $height && $height >=50 && $height <= 100) {
		$imgHeight = '50px';
	} else if ($width <= $height &&  $height >= 100) {
		$imgHeight = '170px';
	} else {
		$imgHeight = '70px';
	}

	$imgtag = "<img class=\"file_image\" type=\"image\" src=\"".$linkToFile."\" style=\"max-height:".$imgHeight.";\"/>";
} else if (!empty($isVideo) && $isVideo) {
	$imgtag = "(".$filename.")<img class=\"file_video\" type=\"video\" src=\"".BASE_URL."images/videoicon.png\"/>";
} else if (!empty($isAudio) && $isAudio) {
	$imgtag = "(".$filename.")<img class=\"file_audio\" type=\"audio\" src=\"".BASE_URL."images/audioicon.png\"/>";
}

if (empty($message) && isset($_REQUEST['send_audio'])) {
	$insertedId = "";
	if (!empty($_REQUEST['chatroommode'])) {
		$chatroommode = sql_real_escape_string($_REQUEST['chatroommode']);
		$audiofile = explode('.', $_REQUEST['audiofile']);
		if(!empty($_REQUEST['to'])){
			$to = sql_real_escape_string($_REQUEST['to']);
		}
		$controlparameters = array('type' => 'plugins', 'name' => 'voicenote','params' => array('to' => $to,'audiofile' => $audiofile[0],'chatroommode' => $chatroommode));
		$controlparameters = json_encode($controlparameters);

		$insertedId = sendChatroomMessage($to,'CC^CONTROL_'.$controlparameters,0);
	} else {
		if ((!empty($isImage) && $isImage) || (!empty($isVideo) && $isVideo) || (!empty($isAudio) && $isAudio) ) {
			$response = sendMessage($_REQUEST['to'],$voicenote_language[5]."<br/><a class=\"imagemessage mediamessage\" filename=\"".$unencryptedfilename."\" encfilename=\"".$md5filename."\" mediatype=\"".$mediaType."\" href=\"".$server_url."plugins/voicenote/download.php?file=".$md5filename."&amp;unencryptedfilename=".$unencryptedfilename."\">".$imgtag."</a>",0,'voicenote');
			$processedMessage = $_SESSION['cometchat']['user']['n'].": ".$voicenote_language[5];
			pushMobileNotification($_REQUEST['to'],$response['id'],$processedMessage);
			if(USE_COMET == 1){
				$cometmessage = array();
				$cometresponse = array('to' => $_REQUEST['to'],'message' => $voicenote_language[5]."<br/><a class=\"imagemessage mediamessage\" filename=\"".$unencryptedfilename."\" encfilename=\"".$md5filename."\" mediatype=\"".$mediaType."\" href=\"".$server_url."plugins/voicenote/download.php?file=".$md5filename."&amp;unencryptedfilename=".$unencryptedfilename."\">".$imgtag."</a>", 'dir' => 0,'type' => "voicenote");
				array_push($cometmessage, $cometresponse);
				publishCometMessages($cometmessage,$response['id']);
			}
			$insertedId = $response['id'];
		} else {
			$server_url = BASE_URL;
			$to = $_REQUEST['to'];
			$audiofile = explode('.', $_REQUEST['audiofile']);
			$chatroommode = 0;
			$controlparameters = array('type' => 'plugins', 'name' => 'voicenote', 'params' => array('to' => $to,'audiofile' => $audiofile[0],'chatroommode' => $chatroommode));
			$controlparameters = json_encode($controlparameters);
			$response = sendMessage($to,'CC^CONTROL_'.$controlparameters,0,'voicenote');


			$processedMessage = $_SESSION['cometchat']['user']['n'].": ".$voicenote_language[5];
			pushMobileNotification($_REQUEST['to'],$response['id'],$processedMessage);
			if(USE_COMET == 1){
				$cometmessage = array();
				$cometresponse = array('to' => $_REQUEST['to'],'message' => $voicenote_language[7]." (".$filename.").<a class=\"imagemessage\" href=\"".$server_url."plugins/voicenote/download.php?file=".$md5filename."&unencryptedfilename=".$unencryptedfilename."\" target=\"_blank\" mediatype=\"".$mediaType."\">".$voicenote_language[6]."</a>", 'dir' => 0,'type' => "voicenote");
				array_push($cometmessage, $cometresponse);
				publishCometMessages($cometmessage,$response['id']);
			}
			$insertedId = $response['id'];
		}
		/*Uncomment to enable push notifications for CometChat Legacy Apps*/
		/*if (isset($_REQUEST['sendername']) && $pushNotifications == 1) {
			pushMobileNotification($voicenote_language[9], $_REQUEST['sendername'], $_REQUEST['to'], $_REQUEST['to']);
		}*/
		/*Uncomment to enable push notifications for CometChat Legacy Apps*/
	}

	if (!empty($_REQUEST['callbackfn']) && $_REQUEST['callbackfn'] == 'mobileapp') {
		echo $insertedId; exit;
	}
	$message = $voicenote_language[8];
}

$embed = '';
$embedcss = '';
$close = "setTimeout('closePopup();',2000);";

if (!empty($_GET['embed']) && $_GET['embed'] == 'web') {
	$embed = 'web';
	$embedcss = 'embed';
} else if (!empty($_GET['embed']) && $_GET['embed'] == 'desktop') {
	$embed = 'desktop';
	$embedcss = 'embed';
	$close = "setTimeout('parentSandboxBridge.closeCCPopup(\"voicenote\");',2000);";
}

if(isset($_REQUEST['param']) && isset($_REQUEST['cancel_audio'])){
   $filename = $_REQUEST['audiofile'];
   unlink($target_dir.$filename);
   $message = '';
   $close = "closePopup();";
}


if (!empty($_REQUEST['callbackfn']) && $_REQUEST['callbackfn'] == 'mobileapp') {
	echo $mediauploaded;
} else {
echo <<<EOD
	<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>{$voicenote_language[0]} (closing)</title>
		<link type="text/css" rel="stylesheet" media="all" href="../../css.php?type=plugin&name=voicenote" />
		<script type="text/javascript">
			function closePopup(){
				var controlparameters = {'type':'plugins', 'name':'voicenote', 'method':'closeCCPopup', 'params':{'name':'voicenote'}};
				controlparameters = JSON.stringify(controlparameters);
				if(typeof(parent) != 'undefined' && parent != null && parent != self){
					parent.postMessage('CC^CONTROL_'+controlparameters,'*');
				} else {
					window.close();
				}
			}
		</script>
	</head>
	<body onload={$close}>
		<div class="cometchat_wrapper">
				<div class="container_body {$embedcss}">
				<div>{$message}</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</body>
	</html>
EOD;
}
}
