<?php
/**
  * @var \App\View\AppView $this
  */
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'admin';
$this->assign('title', 'User');

$length = 8;
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
$default_password = substr( str_shuffle( $chars ), 0, $length );

?>

<div class="large-12 panel-wrap">
	<div class="large-12 columns users">
		
		<div id="form-message"></div>
		<div class="large-12 pad-row">
			<div class="medium-12 columns pad-col">
			<?= '<h4>Reset Password for '.$user->name.'</h4>'; ?>
			</div>
			<div id="form-message-i" class="columns"></div>
			<?= $this->Form->create($user, ['url' => ['action' => 'reset_password'], 'id'=>'password-form']) ?> 
			<div class="medium-12 columns pad-col">
				<?= $this->Form->input('password1',['type' => 'text' , 'label'=>false, 'value'=>$default_password])?> 
			</div>
			<div class="medium-12 columns pad-col text-right">
				<?php 
					echo $this->Form->button(__('Reset password'), ['class'=>'button r-margin']);
				?>
			</div>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>

	<script>
	//<![CDATA[
	//prepare the form when the DOM is ready
	$(document).ready(function() {
	    var options = {
	        target:        '#form-message-i',   // target element(s) to be updated with server response
	        beforeSubmit:  showRequest,  // pre-submit callback
	        success:       showResponse  // post-submit callback

	        // other available options:
	        //url:       url         // override for form's 'action' attribute
	        //type:      type        // 'get' or 'post', override for form's 'method' attribute
	        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
	        //clearForm: true        // clear all form fields after successful submit
	        //resetForm: true        // reset the form after successful submit

	        // $.ajax options can be used here too, for example:
	        //timeout:   3000
	    };

	    //$("#contact-form").validate();
	    // bind form using 'ajaxForm'
	    $('#password-form').ajaxForm(options);
	});

	// pre-submit callback
	function showRequest(formData, jqForm, options) {
	    // formData is an array; here we use $.param to convert it to a string to display it
	    // but the form plugin does this for you automatically when it submits the data
	    var queryString = $.param(formData);

	    // jqForm is a jQuery object encapsulating the form element.  To access the
	    // DOM element for the form do this:
	    // var formElement = jqForm[0];

		if(confirm('Please confirm'
		+ '')){
	        return true;
	    }else {
	        // here we could return false to prevent the form from being submitted;
	        // returning anything other than false will allow the form submit to continue
	        return false;
	    }
	}

	// post-submit callback
	function showResponse(responseText, statusText, xhr, $form)  {
	    // for normal html responses, the first argument to the success callback
	    // is the XMLHttpRequest object's responseText property

	    // if the ajaxForm method was passed an Options Object with the dataType
	    // property set to 'xml' then the first argument to the success callback
	    // is the XMLHttpRequest object's responseXML property

	    // if the ajaxForm method was passed an Options Object with the dataType
	    // property set to 'json' then the first argument to the success callback
	    // is the json data object returned by the server

	    //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
	      //  '\n\nThe output div should have already been updated with the responseText.');
	      //$('#form-message').css('display', 'block');
		  //$("#personal-details-edit").fadeOut('fast');
	  	  //$("#personal-details-view").fadeIn('slow');
		  $("#form-message-i").html(responseText['result']);
		  //alert(responseText['result']);
	}
	//]]>
</script>