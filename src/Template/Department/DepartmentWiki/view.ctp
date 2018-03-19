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
$this->assign('title', 'Wiki');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column medium-4">Wiki</h1>
		            <div class="column medium-8 text-right">
						<?php
							echo $this->Html->link(__('Back'), ['controller' => 'DepartmentWiki', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
							if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
								echo $this->Html->link(__('Add Wiki'), ['controller' => 'DepartmentWiki', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('Edit'), ['controller' => 'DepartmentWiki', 'action' => 'edit', $wiki->id], ['class'=>'button']);
								echo $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentWiki', 'action' => 'delete', $wiki->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wiki->title), 'class'=>'button alert']);
							}
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Wiki'), ['controller' => 'DepartmentWiki', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __($wiki->title); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp">
							<div class="large-12 columns">
								<?php
									echo '<h5>'.__($wiki->title).'</h5>';
									echo $wiki->content;
									
									echo '<a data-fancybox data-type="ajax" href="'.$this->Url->build(DS.'department'.DS.'department-wiki'.DS.'upload'.DS.$wiki->id, true).'" class="button"> <span class="fa fa-upload"></span> Upload file</a>';
								?>
								
							</div>
							<div class="large-12 columns misc-wrap text-right">
								<?php
									echo '<button class="slide-toggle" href="#"><span class="fa fa-folder"></span> Files • '.$media_files_count.'</button>';
									//$comment_cat = array();
									//echo $this->Html->link(__('<span class="fa fa-comments"></span> Comments • '.$this->cell('Misc::countComment', ['DepartmentComments', $comment_cat, $wiki->id])->render('count')), ['controller' => 'DepartmentWiki', 'action' => 'comments', $wiki->id], ['class'=>'', 'escape'=>false]);
								?>
							</div>
							<div class="large-12 columns file-box">
								<?php
									if($media_files_count > 0){
										foreach($media_files as $media_file):
										
											$trimmed_file_name = null;
								
											if(strlen($media_file->file_name) > 15){
												$trimmed_file_name = substr($media_file->file_name,0,15).'....';
											}else{
												$trimmed_file_name = $media_file->file_name;
											} 
										
											if($media_file->media_type == 'image/jpeg' || $media_file->media_type == 'image/png' || $media_file->media_type == 'image/gif'){
												echo '<a href="'.$this->Url->build(DS.$media_file->media_dir.DS.$media_file->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$media_file->file_name.'" data-fancybox="'.$media_file->parent_id.'">';
												echo '<div class="icon thumbnail">';
												echo $this->Html->image(DS.$media_file->media_dir.DS.$media_file->file_name, ["alt" => "Ebony Oil & Gas"]);
												echo '</div>';
									  
												echo '<h6>'.$trimmed_file_name.'</h6>';
												if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
								
												}
												echo '</a>';
											}elseif($media_file->media_type == 'application/pdf'){
												echo '<a target="_blank" href="'.$this->Url->build(DS.$media_file->media_dir.DS.$media_file->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$media_file->file_name.'">';
												echo '<div class="icon">';
												echo '<span class="fa fa-file-pdf-o fa-3x"></span>';
												echo '</div>';
												echo '<h6>'.$trimmed_file_name.'</h6>';
												if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
								
												}
												echo '</a>';
											}else{
												echo '<a target="_blank" href="'.$this->Url->build(DS.$media_file->media_dir.DS.$media_file->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$media_file->file_name.'">';
												echo '<div class="icon">';
												echo '<span class="fa fa-file fa-3x"></span>';
												echo '</div>';
												echo '<h6>'.$trimmed_file_name.'</h6>';
												if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
								
												}
												echo '</a>';
											}
										endforeach;
									}else{
										echo '<p>No files uploaded</p>';
									}
								?>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".slide-toggle").click(function(){
            $(".file-box").slideToggle(300, 'swing');
        });
    });
</script>
