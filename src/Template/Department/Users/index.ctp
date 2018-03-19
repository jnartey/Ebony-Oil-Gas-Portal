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
use Cake\Chronos\Chronos;
use Cake\I18n\Time;

$this->layout = 'default';
$this->assign('title', 'Users');
echo $this->element('department/head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="large-12 columns event-section">
            <div class="large-12 columns event-heading">
                <h1 class="column large-4">Employees</h1>
            </div>
			<div class="large-12 columns event-content">
				<div class="large-12 columns">
					<div class="large-12 columns portal-sp">
				        <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
							<thead>
					            <tr>
					                <th><?= __('Name') ?></th>
					                <th><?= __('Position') ?></th>
									<th><?= __('Phone') ?></th>
									<th><?= __('Email') ?></th>
									<th><?= __('Skype') ?></th>
					            </tr>
							</thead>
							<tbody>
					            <?php 
									$i=1;
									foreach ($users as $user): 
								?>
					            <tr>
					                <td>
					                	<?php
											echo '<div class="user-pn">';
											if($user->photo){
												echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build(DS.'files'.DS.'Users'.DS.'photo'.DS.'medium-'.$user->photo).')"></span>'), ['controller'=>'users', 'action' => 'view', $user->id], ['escape'=>false]);
											}else{
												echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')"></span><span>'), ['controller'=>'users', 'action' => 'view', $user->id], ['escape'=>false]);
											}
											echo '</div>';
											echo '<div class="user-pn">';
											echo $this->Html->link(__($user->name), ['action' => 'view', $user->id], ['class'=>'']);
											echo '</div>';
					                	?>
					                </td>
					                <td><?= $user->position ?></td>
									<td><?= $user->phone_number ?></td>
									<td><?= $user->email ?></td>
									<td><?= $user->skype_name ?></td>
					            </tr>
					            <?php 
									$i++;
									endforeach; 
								?>
							</tbody>
				        </table>
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