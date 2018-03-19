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
$this->assign('title', 'Leave Request');
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="large-12 columns event-section">
            <div class="large-12 columns event-heading">
                <h1 class="column medium-4">Leave Request</h1>
	            <div class="column medium-8 text-right">
					<?php
						echo $this->Html->link(__('Cancel'), ['controller' => 'LeaveRequests', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
					?>
				</div>
            </div>
			<div class="large-12 columns event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('Leave Request'), ['controller' => 'LeaveRequests', 'action' => 'index'], ['escape'=>false]); ?></li>
				    <li><?= __("Request Leave"); ?></li>
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
								$options = array('Annual'=>'Annual', 'Sick'=>'Sick', 'Study'=>'Study', 'Casual'=>'Casual', 'Bereavement'=>'Bereavement', 'Maternity'=>'Maternity', 'Paternity'=>'Paternity');
					            echo $this->Form->control('leave_type',['options'=>$options]);
								echo '</div>';
								echo '<div class="medium-6 columns pad-col-x">';
					            echo $this->Form->control('number_of_days_requested');
								echo '</div></div>';
								echo '<div class="medium-4 columns pad-col-x">';
					            echo $this->Form->control('start_date', ['type' => 'text', 'id'=>'from']);
								echo '</div>';
								echo '<div class="medium-4 columns pad-col-x">';
					            echo $this->Form->control('end_date', ['type' => 'text', 'id'=>'to']);
								echo '</div>';
								echo '<div class="medium-4 columns pad-col-x">';
					            echo $this->Form->control('resumption_date', ['type' => 'text', 'class'=>'extra-date']);
								echo '</div>';
								echo '<div class="medium-12 columns pad-col-x">';
					            echo $this->Form->control('comments');
								echo '</div>';
								echo '<div class="medium-12 columns pad-col-x">';
								echo '<legend><h5>'.__('Leave Contact Details').'</h5></legend>';
								echo '</div>';
								echo '<div class="medium-6 columns pad-col-x">';
					            echo $this->Form->control('Tel');
								echo '</div>';
								echo '<div class="medium-6 columns pad-col-x">';
					            echo $this->Form->control('email');
								echo '</div>';
								echo '<div class="medium-12 columns pad-col-x">';
					            echo $this->Form->control('address');
								echo '</div>';
					            echo $this->Form->hidden('status', ['value' => 1]);
					            echo $this->Form->hidden('user_id', ['value' => $activeUser['id']]);
					            echo $this->Form->hidden('department_id', ['value' => $department_member->department_id]);
					        ?>
						    </fieldset>
						    <?= $this->Form->button(__('Submit'), ['class'=>'button']) ?>
						    <?= $this->Form->end() ?>
						</div>
						<?php
							}else{
								echo '<div class="callout secondary">You cannot edit this request</div>';
							}
						?>
					</div>
				</div>
			</div>
        </section>
    </div>

    <aside class="column small-12 large-3 pad-aside">
        <?php echo $this->element('aside'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>
