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
$this->assign('title', 'News');
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="event-section">
            <div class="event-heading row">
                <h1 class="column small-3">News</h1>
                <div class="column small-9 text-right">
					<?php
						echo $this->Html->link(__('<span class="fa fa-list"></span> All News'), ['controller' => 'news', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
							echo $this->Html->link(__('<span class="fa fa-list"></span> My News'), ['controller' => 'events', 'action' => 'my_news'], ['class'=>'button', 'escape'=>false]);
							if($activeUser['id'] == $news->user_id){
								echo $this->Html->link(__('<span class="fa fa-pencil"></span> Edit'), ['controller' => 'news', 'action' => 'edit', $news->id], ['class'=>'button', 'escape'=>false]);
								echo $this->Form->postLink(
					                __('Delete'),
					                ['action' => 'delete', $news->id],
					                ['confirm' => __('Are you sure you want to delete # {0}?', $news->title), 'class'=>'button alert']
					            );
							}
						
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Add News'), ['controller' => 'news', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
						}
					?>
				</div>
            </div>
			<div class="large-12 event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('News'), ['controller' => 'news', 'action' => 'index'], ['escape'=>false]); ?></li>
				    <li><?= $news->title; ?></li>
				  </ul>
				</nav>
				<?php
					$created = Time::parse($news->created);
					echo '<span class="label secondary">'.$news->category->name.'</span>';
					echo '<h4>'.$news->title.'</h4>'; 
					echo '<span class="date">'.$created->nice().'</span>';
					echo $news->story;
				?>
			</div>
        </section>
    </div>

    <aside class="column small-12 large-3 pad-aside">
        <?php echo $this->element('aside'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>