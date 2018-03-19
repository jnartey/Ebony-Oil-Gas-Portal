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

$this->layout = 'default';
$this->assign('title', 'Requests');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column medium-6">Vehicle Servicing Request</h1>
		            <div class="column medium-6 text-right">
						<?php
							echo $this->Html->link(__('Cancel'), ['controller' => 'VehicleServicings', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Vehicle Servicing Request'), ['controller' => 'VehicleServicings', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __("Vehicle Servicing Request"); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp">
							<?php
								if(!$check_request){
							?>
							<div class="tasks form large-9 medium-8 columns content">
							    <?= $this->Form->create($leaveRequest) ?>
							    <fieldset>
							        <?php
										echo '<div class="large-12 columns">';
										echo '<div class="medium-6 columns pad-col-x">';
							            echo $this->Form->control('vehicle_id', ['options' => $vehicles, 'label'=>'Car Registeration Number']);
										echo $this->Form->control('mileage');
										echo '<label>General Servicing</label>';
										echo $this->Form->radio('general_servicing', [1=>'Yes', 2=>'No']);
										echo $this->Form->control('other',['label'=>'Other Specify']);
										echo '</div></div>';
							            echo $this->Form->hidden('status', ['value' => 1]);
										echo $this->Form->hidden('request_type', ['value' => 4]);
							            echo $this->Form->hidden('user_id', ['value' => $activeUser['id']]);
							            echo $this->Form->hidden('department_id', ['value' => $get_user->department_access]);
							        ?>
							    </fieldset>
							    <?= $this->Form->button(__('Update'), ['class'=>'button']) ?>
							    <?= $this->Form->end() ?>
							</div>
							<?php
								}else{
									echo '<div class="callout secondary">You cannot make a request at this time because you have a pending request which needs to be attended to or cancelled by you.</div>';
								}
							?>
						</div>
					</div>
				</div>
	        </section>
	    </div>

	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('dpt_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>
