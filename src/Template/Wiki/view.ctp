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
$this->assign('title', 'Wiki');
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="large-12 columns event-section">
            <div class="large-12 columns event-heading">
                <h1 class="column medium-4">Wiki</h1>
	            <div class="column medium-8 text-right">
					<?php
						echo $this->Html->link(__('Back'), ['controller' => 'wiki', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						if($activeUser['id'] == $wiki->user_id){
							echo $this->Html->link(__('Add Wiki'), ['controller' => 'wiki', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
							echo $this->Html->link(__('Edit'), ['controller' => 'wiki', 'action' => 'edit', $wiki->id], ['class'=>'button']);
							echo $this->Form->postLink(__('Delete'), ['controller' => 'wiki', 'action' => 'delete', $wiki->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wiki->title), 'class'=>'button alert']);
						}
					?>
				</div>
            </div>
			<div class="large-12 columns event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('Wiki'), ['controller' => 'wiki', 'action' => 'index'], ['escape'=>false]); ?></li>
				    <li><?= __($wiki->title); ?></li>
				  </ul>
				</nav>
				<div class="large-12 columns">
					<div class="large-12 columns portal-sp">
						<div class="large-12 columns">
							<?php
								echo '<h5>'.__($wiki->title).'</h5>';
								echo $wiki->content;
							?>
						</div>
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
