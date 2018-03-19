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
$this->assign('title', 'Events');
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="event-section">
            <div class="event-heading row">
                <h1 class="column small-3">Events</h1>
                <div class="column small-9 text-right">
					<?php
						echo $this->Html->link(__('<span class="fa fa-calendar"></span> Event Calendar'), ['controller' => 'events', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						echo $this->Html->link(__('<span class="fa fa-list"></span> All Events'), ['controller' => 'events', 'action' => 'events'], ['class'=>'button', 'escape'=>false]);
						if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
							echo $this->Html->link(__('<span class="fa fa-list"></span> My Events'), ['controller' => 'events', 'action' => 'my_events'], ['class'=>'button active', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Event'), ['controller' => 'events', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
						}
					?>
				</div>
            </div>
			<?php
				if($events){
					foreach ($events as $event):
						echo '<a href="'.$this->Url->build('/events/view/'.$event->id, true).'" class="event-article with-image row">';
						if($event->image){
							echo '<div class="article-image column medium-2">';
							echo '<span style="background-image: url(\'img/samples/frank-mckenna.jpg\');"></span>';
							echo '</div>';
							echo '<div class="article-details column small-10">';
							echo '<h2>'.$event->name.'</h2>';
							echo $event->description;
							echo '<p><span class="location"><span></span>'.$event->location.'</span><time class="date"><span></span>'.$event->from_date.'</time></p>';
							echo '</div>';
						}else{
							echo '<div class="article-details plain column medium-12">';
							echo '<h2>'.$event->name.'</h2>';
							echo $event->description;
							echo '<p><span class="location"><span></span>'.$event->location.'</span><time class="date"><span></span>'.$event->from_date.'</time></p>';
							echo '</div>';
						}
						echo '</a>';
					endforeach;
				}else{
					echo '<p>No events</p>';
				}
			?>
		    <div class="paginator">
		        <ul class="pagination">
		            <?= $this->Paginator->first('<< ' . __('first')) ?>
		            <?= $this->Paginator->prev('< ' . __('previous')) ?>
		            <?= $this->Paginator->numbers() ?>
		            <?= $this->Paginator->next(__('next') . ' >') ?>
		            <?= $this->Paginator->last(__('last') . ' >>') ?>
		        </ul>
		        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} events(s) out of {{count}} total')]) ?></p>
		    </div>
        </section>
    </div>

    <aside class="column small-12 large-3 pad-aside">
        <?php echo $this->element('aside'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>