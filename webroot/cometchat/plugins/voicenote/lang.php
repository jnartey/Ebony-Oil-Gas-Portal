<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$addonfolder = str_replace(DIRECTORY_SEPARATOR.'lang.php','', __FILE__);
$addonarray = explode(DIRECTORY_SEPARATOR, $addonfolder);
$addonname = end($addonarray);
$addontype = rtrim(prev($addonarray),'s');

/* LANGUAGE */

${$addonname.'_language'}['title'] = setLanguageValue('title','Send a Voice Note',$lang,$addontype,$addonname);
${$addonname.'_language'}['send_voice_note'] = setLanguageValue('send_voice_note','Send a Voice Note',$lang,$addontype,$addonname);
${$addonname.'_language'}['audio_stop'] = setLanguageValue('audio_stop','Stop',$lang,$addontype,$addonname);
${$addonname.'_language'}['audio_cancel'] = setLanguageValue('audio_cancel','Cancel',$lang,$addontype,$addonname);
${$addonname.'_language'}['start_record'] = setLanguageValue('start_record','Start Recording',$lang,$addontype,$addonname);
${$addonname.'_language'}['sent_a_file'] = setLanguageValue('sent_a_file','has sent a file',$lang,$addontype,$addonname);
${$addonname.'_language'}['download_file'] = setLanguageValue('download_file','Click here to download the file',$lang,$addontype,$addonname);
${$addonname.'_language'}['cr_chat_convo'] = setLanguageValue('cr_chat_convo','has successfully sent a file',$lang,$addontype,$addonname);
${$addonname.'_language'}['sent_success'] = setLanguageValue('sent_success','Voicenote sent successfully. Closing Window.',$lang,$addontype,$addonname);
${$addonname.'_language'}['shared_a_file'] = setLanguageValue('shared_a_file','has shared a file',$lang,$addontype,$addonname);
${$addonname.'_language'}['err_no_file_found'] = setLanguageValue('err_no_file_found','Sorry, we are unable to find the file.',$lang,$addontype,$addonname);
${$addonname.'_language'}['save'] = setLanguageValue('save','Save',$lang,$addontype,$addonname);
${$addonname.'_language'}['close'] = setLanguageValue('close','Close',$lang,$addontype,$addonname);
${$addonname.'_language'}['download'] = setLanguageValue('download','Download',$lang,$addontype,$addonname);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

${$addonname.'_key_mapping'} = array(
	'0'		=>	'title',
	'1'		=>	'send_voice_note',
	'2'		=>	'audio_stop',
	'3'		=>	'audio_cancel',
	'4'		=>	'start_record',
	'5'		=>	'sent_a_file',
	'6'		=>	'download_file',
	'7'		=>	'cr_chat_convo',
	'8'		=>	'sent_success',
	'9'		=>	'shared_a_file',
	'10'	=>	'err_no_file_found',
	'11'	=>	'save',
	'12'	=>	'close',
	'13'	=>	'download'
	/**
	 * Please do not add indices here.
	 * Use the keys directly in the code.
	*/
);

${$addonname.'_language'} = mapLanguageKeys(${$addonname.'_language'},${$addonname.'_key_mapping'},$addontype,$addonname);
