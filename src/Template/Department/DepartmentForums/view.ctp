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
$this->assign('title', 'Forum');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column small-2">Forum</h1>
	                <div class="column small-10 text-right">
						<?php
							echo $this->Html->link(__('Back'), ['controller' => 'DepartmentForums', 'action' => 'index'], ['class'=>'button']);
							if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3 || $departmentsForum->user_id == $activeUser['id']){
								echo $this->Html->link(__('Edit'), ['controller' => 'DepartmentForums', 'action' => 'edit', $departmentsForum->id], ['class'=>'button']);
								echo $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentForums', 'action' => 'delete', $departmentsForum->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsForum->title), 'class'=>'button alert']);
							}
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Forum'), ['controller' => 'DepartmentForums', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __($departmentsForum->title); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<span class="label secondary"><strong>Created by:</strong> <?= $departmentsForum->user->name ?></span><br /><br />
					   	<?= $departmentsForum->description ?>
						<div id="comments" class="large-12 columns portal-sp comments-box">
							<?php
								if(!$comment_id){
							?>
							<?= $this->Form->create($comment) ?>
					        <?php
					            echo $this->Form->hidden('comment_src', ['value' => 4]);
								echo $this->Form->hidden('source_id', ['value' => $departmentsForum->id]);
					            echo $this->Form->hidden('forum_id', ['value' => $departmentsForum->id]);
					            echo $this->Form->hidden('user_id', ['value' => $activeUser['id']]);
					            echo $this->Form->control('comment', ['label'=>false, 'class'=>'editor']);
					        ?>
							<?= $this->Form->button(__('Submit'), ['class'=>'button']) ?>
						    <?= $this->Form->end() ?>
							<?php }else{
									echo $this->Form->create($comment);
					            	//echo $this->Form->hidden('id');
					            	echo $this->Form->control('comment', ['label'=>false, 'class'=>'editor']);
									echo $this->Form->hidden('forum_id', ['value' => $departmentsForum->id]);
									echo $this->Form->button(__('Update Comment'), ['class'=>'button']);
									echo '&nbsp;';
									echo $this->Html->link(__('Cancel'), ['controller' => 'tasks', 'action' => 'view', $departmentsForum->id], ['class'=>'button', 'escape'=>false]);
									echo $this->Form->end();
								} 
							?>
							<?php
								$comment_cat = array(4);
								echo '<h6>Comments • '.$this->cell('Misc::countCommentMisc', ['DepartmentComments', $comment_cat, $departmentsForum->id, 'forum_id', $departmentsForum->id, 'department_id', $departmentsForum->department_id])->render('count').'</h6>';
								
								foreach ($posts as $data):
									$now = new Time($data->created);
									echo '<div class="media-object"><div class="media-object-section">';
									if($data->user->photo){
										echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build(DS.'img'.DS.'users'.DS.'small'.DS.$data->user->photo, true).')"></span>'), ['controller'=>'users', 'action' => 'view', $data->user->id], ['escape'=>false]);
									}else{
										echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')"></span><span>'), ['controller'=>'users', 'action' => 'view', $data->user->id], ['escape'=>false]);
									}
									echo '</div>';
									echo '<div class="media-object-section">';
									echo '<h6>'.$data->user->name.'</h6>';
									echo '<p>'.$data->comment.'</p>';
									echo '<div class="date">'.$now->timeAgoInWords(['format' => 'MMM d, YYY', 'end' => '+1 year']).'</div>';
									if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3 || $activeUser['id'] == $data->user_id){
										echo '<div class="comment-cp">';
										echo $this->Html->link(__('Edit'), ['controller' => 'DepartmentForums', 'action' => 'view', $departmentsForum->id, $data->id], ['class'=>'', 'escape'=>false]);
										echo ' • ';
										echo $this->Form->postLink(
							                __('Delete'),
							                ['action' => 'delete_comment', $data->id],
							                ['confirm' => __('Are you sure you want to delete {0}?', $data->id), 'class'=>'']
							            );
										echo '</div>';
									}
									echo '</div></div>';
								endforeach;
							?>
						    <div class="paginator text-right">
						        <ul class="pagination">
						            <?= $this->Paginator->first('<< ' . __('first')) ?>
						            <?= $this->Paginator->prev('< ' . __('previous')) ?>
						            <?= $this->Paginator->numbers() ?>
						            <?= $this->Paginator->next(__('next') . ' >') ?>
						            <?= $this->Paginator->last(__('last') . ' >>') ?>
						        </ul>
						        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
						    </div>
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