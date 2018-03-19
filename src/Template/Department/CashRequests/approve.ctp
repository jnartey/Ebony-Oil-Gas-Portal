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
	                <h1 class="column medium-6">Cash/Cheque Request</h1>
		            <div class="column medium-6 text-right">
						<?php
							echo $this->Html->link(__('Cancel'), ['controller' => 'CashRequests', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Cash Request'), ['controller' => 'CashRequests', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __("Cash Request"); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp">
							
							<div class="tasks form large-9 medium-8 columns content">
							    <?php
								echo '<div class="medium-12 columns pad-col-x">';
					            echo '<strong>Request Type</strong> <span class="label secondary">'.$cashRequest->r_type.'</span>';
								echo '<br />';
								echo '</div>';
								echo '<div class="medium-7 columns pad-col-x">';
					            echo '<strong>Requested By</strong> <span class="label secondary">'.$cashRequest->user->name.'</span>';
								echo '<br />';
								echo '</div>';
								echo '<div class="medium-4 columns pad-col-x">';
					            echo '<strong>Date:</strong> <span class="label secondary">'.date("d/m/Y", strtotime($cashRequest->created)).'</span>';
								echo '<br />';
								echo '</div>';
								echo '<div class="medium-12 columns pad-col-x">';
					            echo '<strong>Subject:</strong> <span class="label secondary">'.$cashRequest->subject.'</span>';
								echo '<br />';
								echo '</div>';
								echo '<div class="medium-12 columns pad-col-x">';
					            echo '<strong>Amount:</strong> <span class="label secondary">GHS '.number_format($cashRequest->amount, 2).'</span>';
								echo '</div>';
							    ?>
							</div>
						</div>
						<div class="columns medium-12">
							<?php
								if(isset($approve->name)){
									echo '<strong>Approved by:</strong> <span class="label secondary">'.$approve->name.'</span>';
									echo '<br />';
									echo '<strong>Paid by:</strong> <span class="label secondary">'.$approve->name.'</span>';
									echo '<br />';
								}
							?>
						</div>
						<div class="tasks form large-9 medium-8 columns content float-left">
						    <?= $this->Form->create($cashRequest) ?>
						    <fieldset>
						        <?php
									echo '<div class="medium-12 columns pad-col-x">';
						            echo $this->Form->hidden('approved_by', ['value' => $activeUser['id']]);
									echo $this->Form->hidden('approval_date', ['value' => date('Y-m-d H:i:s')]);
									echo '<div class="medium-4 columns float-left pad-col-x">';
						            $options = array(4 => 'Approve', 5 => 'Decline');
						            echo $this->Form->control('status', ['options'=>$options]);
									echo '</div>';
									echo '</div>';
						        ?>
								<div class="medium-12 columns pad-col-x">
							    <?= $this->Form->button(__('Approve'), ['class'=>'button']) ?>
								</div>
						    </fieldset>
						    <?= $this->Form->end() ?>
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
