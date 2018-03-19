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
?>
<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="medium-12 large-8 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Users'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New User'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<div class="large-12 columns users">
					<h4><?= $this->Html->image("account.png", ["alt" => "Ebony Oil & Gas"]).' '.__('<span>Personal Details</span>') ?></h4>
					<hr />
					<div class="large-12 pad-row">
						<div class="avatar-image">
							<?php 
								if($user->photo){
									echo '<div class="profile-photo" style="background-image:url('.$this->Url->build(DS.'files'.DS.'Users'.DS.'photo'.DS.'medium-'.$user->photo, true).');"></div>';
									//echo $this->Html->image(DS.'files'.DS.'Users'.DS.'photo'.DS.'medium-'.$user->photo, ["alt" => "Ebony Oil & Gas"]); 
								}else{
									echo $this->Html->image("dummy.png", ["alt" => "Ebony Oil & Gas"]); 
								}
								
							?>
						</div>
						<div class="avatar-text">
							<!-- <h6>Change Photo</h6> -->
							<?= '<a data-fancybox data-type="ajax" data-src="'.$this->Url->build(DS.'admin'.DS.'users'.DS.'upload_photo'.DS.$user->id, true).'" href="javascript:;" class="user-icon"><span><span class="fa fa-pencil"></span></span></a>'; ?>
							<?php 
								//echo $this->Form->button(__('Upload'), ['class' => 'button']);
							?>
						</div>
					</div>
					<hr />
					<div id="form-message"></div>
					<div id="personal-details-view" class="large-12 pad-row">
						<div class="medium-6 columns pad-col">
							<h6><?= __('First Name') ?></h6>
							<?= h($user->first_name) ?>
						</div>
						<div class="medium-6 columns pad-col">
							<h6><?= __('Last Name') ?></h6>
							<?= h($user->last_name) ?>
						</div>
						<div class="medium-6 columns pad-col">
							<h6><?= __('Date of Birth') ?></h6>
							<?= h($user->date_of_birth) ?>
						</div>
						<div class="medium-6 columns pad-col">
							<h6><?= __('Username') ?></h6>
							<?= h($user->username) ?>
						</div>
						<div class="medium-6 columns pad-col">
							<h6><?= __('Position') ?></h6>
							<?php
								if($user->position){
									echo h($user->position);
								}else{
									echo '-';
								}
							?>
						</div>
						<div class="medium-6 columns pad-col">
							<h6><?= __('Email') ?></h6>
							<?= h($user->email) ?>
						</div>
						<div class="medium-6 columns pad-col">
							<h6><?= __('Employee ID') ?></h6>
							<?= h($user->employee_id) ?>
						</div>
						<div class="medium-6 columns pad-col">
							<h6><?= __('Grade') ?></h6>
							<?= h($user->grade) ?>
						</div>
						<div class="medium-6 columns pad-col">
							<h6><?= __('Phone Number') ?></h6>
							<?php
								if($user->phone_number){
									echo h($user->phone_number);
								}else{
									echo '-';
								}
							?>
						</div>
						<div class="medium-12 columns pad-col text-left">
							<?= $this->Html->link(__('<span class="fa fa-pencil"></span> Edit'), ['controller' => 'users', 'action' => '#'], ['class' => 'button personal-details-edit', 'escape'=>false]).'<br /><br />'; ?>
						</div>
					</div>
					<div id="personal-details-edit" class="large-12 pad-row">
						<?php
							echo $this->Form->create($user, ['type' => 'file', 'url' => ['action' => 'personal_details'], 'id'=>'personal-form']);
							echo '<div class="medium-6 columns pad-col-x">';
					        echo $this->Form->control('username');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
					        echo $this->Form->control('first_name');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
					        echo $this->Form->control('last_name');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col">';
							echo $this->Form->control('date_of_birth', ['type' => 'text', 'class'=>'extra-date']);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
					        echo $this->Form->control('position');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
					        echo $this->Form->control('email');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('employee_id', ['type'=>'text', 'label'=>'Employee ID']);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('grade', ['type'=>'text', 'label'=>'Grade']);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
					        echo $this->Form->control('phone_number');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('role_id', ['options' => $roles]);
							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
							echo $this->Html->link(__('Cancel'), ['controller' => 'users', 'action' => '#'], ['class' => 'button secondary personal-details-cancel', 'escape'=>false]);
							echo $this->Form->button(__('Update'), ['class'=>'button']).'<br /><br />';
							echo '</div>';
							echo $this->Form->end();
						?>
					</div>
					<hr />
					<div class="large-12 pad-row">
						<div class="medium-6 columns pad-col">
							<h5><?= __('Department') ?></h5>
							<?php
								if($user->id){
									echo $this->cell('Misc::getDepartments', [$user->id])->render('getDepartments');
								}
							?>
						</div>
					</div>
					<hr />
					<div class="large-12 pad-row">
						<div class="medium-12 columns pad-col">
							<h5><?= __('Change Password') ?></h5>
						</div>
						<div id="form-message-i" class="columns"></div>
						<?= $this->Form->create($user, ['url' => ['action' => 'change_password'], 'id'=>'password-form']) ?> 
						<div class="medium-4 columns pad-col">
							<?= $this->Form->input('old_password',['type' => 'password' , 'label'=>'Old password'])?> 
						</div>
						<div class="medium-4 columns pad-col">
							<?= $this->Form->input('password1',['type' => 'password' , 'label'=>'Password'])?> 
						</div>
						<div class="medium-4 columns pad-col">
							<?= $this->Form->input('password2',['type' => 'password' , 'label'=>'Repeat password'])?> 
						</div>
						<div class="medium-12 columns pad-col text-right">
							<?php 
								echo $this->Form->button(__('Update password'), ['class'=>'button r-margin']);
							?>
						</div>
					</div>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>
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
	
	//<![CDATA[
	//prepare the form when the DOM is ready
	$(document).ready(function() {
	    var options = {
	        target:        '#form-message',   // target element(s) to be updated with server response
	        beforeSubmit:  showRequestB,  // pre-submit callback
	        success:       showResponseB  // post-submit callback

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
	    $('#personal-form').ajaxForm(options);
	});

	// pre-submit callback
	function showRequestB(formData, jqForm, options) {
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
	function showResponseB(responseText, statusText, xhr, $form)  {
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
		  $("#personal-details-edit").fadeOut('fast');
	  	  $("#personal-details-view").load("<?php echo $this->Url->build(DS.'users'.DS.'personalDetails'.DS.$user->id, true); ?>", function(response,status,xhr){
	  		$(".personal-details-edit").on('click', function(event) {
	  		    event.preventDefault();
	  			$("#personal-details-view").fadeOut('fast');
	  	    	$("#personal-details-edit").fadeIn('slow');
	  		});
	
	  		$(".personal-details-cancel").on('click', function(event) {
	  		    event.preventDefault();
	  			$("#personal-details-edit").fadeOut('fast');
	  	    	$("#personal-details-view").fadeIn('slow');
	  		});
	  	  });
		  $("#personal-details-view").fadeIn('fast');
		  $("#form-message").html(responseText['result']);
		  //alert(responseText['result']);
	}
	//]]>
</script>