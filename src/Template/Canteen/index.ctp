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
$this->assign('title', 'Canteen');
echo $this->element('head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row canteen-main">
	    <div class="column small-12 large-9">
	        <section class="canteen-section">
	            <h1>Canteen</h1>
	            <ul class="sorting-area tabs" data-tabs id="day-tabs">
					<?php
						$i = 1;
						$now = Chronos::now();
						
						foreach($canteen as $data):
							if($now->isMonday() && $data->day == 1){
								echo '<li class="tabs-title is-active"><a href="#canteen'.$data->day.'" aria-selected="true">Monday</a></li>';
							}elseif($now->isTuesday() && $data->day == 2){
								echo '<li class="tabs-title is-active"><a href="#canteen'.$data->day.'" aria-selected="true">Tuesday</a></li>';
							}elseif($now->isWednesday() && $data->day == 3){
								echo '<li class="tabs-title is-active"><a href="#canteen'.$data->day.'" aria-selected="true">Wednesday</a></li>';
							}elseif($now->isThursday() && $data->day == 4){
								echo '<li class="tabs-title is-active"><a href="#canteen'.$data->day.'" aria-selected="true">Thursday</a></li>';
							}elseif($now->isFriday() && $data->day == 5){
								echo '<li class="tabs-title is-active"><a href="#canteen'.$data->day.'" aria-selected="true">Friday</a></li>';
							}else{
								
								if($data->day == 1){
									echo '<li class="tabs-title"><a href="#canteen'.$data->day.'" aria-selected="true">Monday</a></li>';
								}
						
								if($data->day == 2){
									echo '<li class="tabs-title"><a href="#canteen'.$data->day.'" aria-selected="true">Tuesday</a></li>';
								}
						
								if($data->day == 3){
									echo '<li class="tabs-title"><a href="#canteen'.$data->day.'" aria-selected="true">Wednesday</a></li>';
								}
						
								if($data->day == 4){
									echo '<li class="tabs-title"><a href="#canteen'.$data->day.'" aria-selected="true">Thursday</a></li>';
								}
						
								if($data->day == 5){
									echo '<li class="tabs-title"><a href="#canteen'.$data->day.'" aria-selected="true">Friday</a></li>';
								}
								
							}
							
							$i++;
						endforeach;
					?>
	                
	            </ul>

	            <div class="sorting-container tabs-content" data-tabs-content="day-tabs">
					<?php
						$j = 1;
						foreach($canteen as $data):
							if($now->isMonday() && $data->day == 1){
								echo '<div class="tabs-panel time-sorting-panel is-active" id="canteen'.$data->day.'">';
							}elseif($now->isTuesday() && $data->day == 2){
								echo '<div class="tabs-panel time-sorting-panel is-active" id="canteen'.$data->day.'">';
							}elseif($now->isWednesday() && $data->day == 3){
								echo '<div class="tabs-panel time-sorting-panel is-active" id="canteen'.$data->day.'">';
							}elseif($now->isThursday() && $data->day == 4){
								echo '<div class="tabs-panel time-sorting-panel is-active" id="canteen'.$data->day.'">';
							}elseif($now->isFriday() && $data->day == 5){
								echo '<div class="tabs-panel time-sorting-panel is-active" id="canteen'.$data->day.'">';
							}else{
								
								if($data->day == 1){
									echo '<div class="tabs-panel time-sorting-panel" id="canteen'.$data->day.'">';
								}
						
								if($data->day == 2){
									echo '<div class="tabs-panel time-sorting-panel" id="canteen'.$data->day.'">';
								}
						
								if($data->day == 3){
									echo '<div class="tabs-panel time-sorting-panel" id="canteen'.$data->day.'">';
								}
						
								if($data->day == 4){
									echo '<div class="tabs-panel time-sorting-panel" id="canteen'.$data->day.'">';
								}
						
								if($data->day == 5){
									echo '<div class="tabs-panel time-sorting-panel" id="canteen'.$data->day.'">';
								}
								
							}
							echo '<ul class="time-sorting-area tabs" data-tabs id="menu'.$data->day.'">';
							echo '<li class="tabs-title is-active"><a href="#morning'.$data->day.'" aria-selected="true">Morning</a></li>';
							echo '<li class="tabs-title"><a href="#afternoon'.$data->day.'" aria-selected="true">Afternoon</a></li>';
							echo '<li class="tabs-title"><a href="#evening'.$data->day.'" aria-selected="true">Evening</a></li>';
							echo '</ul>';
							echo '<div class="tabs-content" data-tabs-content="menu'.$data->day.'">';
							echo '<div class="tabs-panel is-active" id="morning'.$data->day.'">';
							echo '<h3>'.$data->morning_meal.'</h3>';
							echo '<p>'.$data->morning_meal_description.'</p>';
							echo '</div>';
							echo '<div class="tabs-panel is-active" id="afternoon'.$data->day.'">';
							echo '<h3>'.$data->afternoon_meal.'</h3>';
							echo '<p>'.$data->afternoon_meal_description.'</p>';
							echo '</div>';
							echo '<div class="tabs-panel is-active" id="evening'.$data->day.'">';
							echo '<h3>'.$data->evening_meal.'</h3>';
							echo '<p>'.$data->evening_meal_description.'</p>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							$j++;
						endforeach;
					?>
				</div>
	        </section>
	    </div>
	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Canteen'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="canteen index large-9 medium-8 columns content">
    <h3><?= __('Canteen') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('day') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($canteen as $canteen): ?>
            <tr>
                <td><?= h($canteen->day) ?></td>
                <td><?= h($canteen->meal) ?></td>
                <td><?= h($canteen->created) ?></td>
                <td><?= h($canteen->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $canteen->day]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $canteen->day]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $canteen->day], ['confirm' => __('Are you sure you want to delete # {0}?', $canteen->day)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div> -->
