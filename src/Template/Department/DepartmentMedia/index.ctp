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
$this->assign('title', 'Media');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="large-9 columns media">
        	<form class="large-12 columns" id="media-form">
        		<div class="large-7 columns">
				  <div class="media-object">
				    <div class="media-object-section">
	          			<a class="fa fa-th-large" href="#"></a>
	  					<a class="fa fa-list-alt" href="#"></a>
	  					<a class="fa fa-level-up" href="#"></a>
	  					<a class="fa fa-refresh" href="#"></a>
				    </div>
				    <div class="media-object-section">
						<!-- <select>
							<option value="">-- choose category --</option>
						</select> -->
				    </div>
				  </div>
        		</div>
				<div class="large-5 columns search-media">
				  <input type="text" id="search-media" name="search-media" />
				  <span class="fa fa-search"></span>
				</div>
        	</form>
			<div class="large-12 columns media-head">
				<div class="medium-10 columns">
					<?php
						if($check_id){
							if($check_parent_media){
								echo '<a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index'.DS.$parent_media->parent_id, true).'" class="fa fa-level-up"> <span>Move Up</span></a>';
								echo '<a data-fancybox data-type="ajax" data-src="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'add_folder'.DS.$parent_media->id, true).'" href="javascript:;" class="fa fa-plus"> <span>New Folder</span></a>';
								echo '<a data-fancybox data-type="ajax" href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'add'.DS.$parent_media->id, true).'" class="fa fa-upload"> <span>Upload</span></a>';
							}
						}else{
							echo '<a data-fancybox data-type="ajax" data-src="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'add_folder', true).'" href="javascript:;" class="fa fa-plus"> <span>New Folder</span></a>';
							echo '<a data-fancybox data-type="ajax" href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'add', true).'" class="fa fa-upload"> <span>Upload</span></a>';
						}
					?>
					<!-- <span class="fa fa-plug"> <span>Connect your Google drive</span></span> -->
				</div>
				<div class="medium-2 columns text-right">
					<span class="fa fa-gear"></span>
				</div>
			</div>
			<div id="media-container" class="large-12 columns media-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
					  <?php
						  if($crumbs){
							  echo '<li><a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index', true).'"><span class="fa fa-home"></span></a></li>';
							  foreach($crumbs as $crumb):
								  echo '<li><a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index'.DS.$crumb->id, true).'">'.$crumb->folder_name.'</a></li>';
							  endforeach;
						  }
					  ?>
				  </ul>
				</nav>
				<?php
					if(!empty($media->toArray())){
						foreach($media as $data):
							if($data->project_id){
								$checkF = $this->cell('Misc::projectAccessF', ['DepartmentProjectMembers', $activeUser['id'], $data->project_id])->render('result');
								if($checkF == true || $activeUser['role_id'] == 1 || $check_user->department_role == 2 || $check_user->department_role == 3){
									if($data->folder_name){
								
										$trimmed_folder_name = null;
								
										if(strlen($data->folder_name) > 15){
											$trimmed_folder_name = substr($data->folder_name,0,15).'....';
										}else{
											$trimmed_folder_name = $data->folder_name;
										} 
								
										if($data->media_access == 1){
											echo '<a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
											echo '<div class="icon">';
											echo '<span class="fa fa-folder-o fa-3x"></span>';
											echo '</div>';
									  
											echo '<h6>'.$trimmed_folder_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
											}
											echo '</a>';
										}
							
										if($data->media_access == 2 && $data->uploaded_by == $check_user->user_id){
											echo '<a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
											echo '<div class="icon">';
											echo '<span class="fa fa-folder-o fa-3x"></span>';
											echo '</div>';
											echo '<h6>'.$trimmed_folder_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
											}
											echo '</a>';
										}
							
										if($data->media_access == 3){
											echo '<a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
											echo '<div class="icon">';
											echo '<span class="fa fa-folder-o fa-3x"></span>';
											echo '</div>';
											echo '<h6>'.$trimmed_folder_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
											}
											echo '</a>';
										}
							
									}else{
								
										$trimmed_file_name = null;
								
										if(strlen($data->file_name) > 15){
											$trimmed_file_name = substr($data->file_name,0,15).'....';
										}else{
											$trimmed_file_name = $data->file_name;
										} 
								
										if($data->media_type == 'image/jpeg' || $data->media_type == 'image/png' || $data->media_type == 'image/gif'){
											echo '<a href="'.$this->Url->build(DS.$data->media_dir.DS.$data->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->file_name.'" data-fancybox="'.$data->parent_id.'">';
											echo '<div class="icon thumbnail">';
											echo $this->Html->image(DS.$data->media_dir.DS.$data->file_name, ["alt" => "Ebony Oil & Gas"]);
											echo '</div>';
									  
											echo '<h6>'.$trimmed_file_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
											}
											echo '</a>';
										}elseif($data->media_type == 'application/pdf'){
											echo '<a target="_blank" href="'.$this->Url->build(DS.$data->media_dir.DS.$data->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->file_name.'">';
											echo '<div class="icon">';
											echo '<span class="fa fa-file-pdf-o fa-3x"></span>';
											echo '</div>';
											echo '<h6>'.$trimmed_file_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
											}
											echo '</a>';
										}else{
											echo '<a target="_blank" href="'.$this->Url->build(DS.$data->media_dir.DS.$data->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->file_name.'">';
											echo '<div class="icon">';
											echo '<span class="fa fa-file fa-3x"></span>';
											echo '</div>';
											echo '<h6>'.$trimmed_file_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
											}
											echo '</a>';
										}
								
								
									}
								}
							}else{
								if($data->folder_name){
								
									$trimmed_folder_name = null;
								
									if(strlen($data->folder_name) > 15){
										$trimmed_folder_name = substr($data->folder_name,0,15).'....';
									}else{
										$trimmed_folder_name = $data->folder_name;
									} 
								
									if($data->media_access == 1){
										echo '<a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
										echo '<div class="icon">';
										echo '<span class="fa fa-folder-o fa-3x"></span>';
										echo '</div>';
									  
										echo '<h6>'.$trimmed_folder_name.'</h6>';
										if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
										}
										echo '</a>';
									}
							
									if($data->media_access == 2 && $data->uploaded_by == $check_user->user_id){
										echo '<a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
										echo '<div class="icon">';
										echo '<span class="fa fa-folder-o fa-3x"></span>';
										echo '</div>';
										echo '<h6>'.$trimmed_folder_name.'</h6>';
										if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
										}
										echo '</a>';
									}
							
									if($data->media_access == 3){
										echo '<a href="'.$this->Url->build(DS.'department'.DS.'department-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
										echo '<div class="icon">';
										echo '<span class="fa fa-folder-o fa-3x"></span>';
										echo '</div>';
										echo '<h6>'.$trimmed_folder_name.'</h6>';
										if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
										}
										echo '</a>';
									}
							
								}else{
								
									$trimmed_file_name = null;
								
									if(strlen($data->file_name) > 15){
										$trimmed_file_name = substr($data->file_name,0,15).'....';
									}else{
										$trimmed_file_name = $data->file_name;
									} 
								
									if($data->media_type == 'image/jpeg' || $data->media_type == 'image/png' || $data->media_type == 'image/gif'){
										echo '<a href="'.$this->Url->build(DS.$data->media_dir.DS.$data->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->file_name.'" data-fancybox="'.$data->parent_id.'">';
										echo '<div class="icon thumbnail">';
										echo $this->Html->image(DS.$data->media_dir.DS.$data->file_name, ["alt" => "Ebony Oil & Gas"]);
										echo '</div>';
									  
										echo '<h6>'.$trimmed_file_name.'</h6>';
										if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
										}
										echo '</a>';
									}elseif($data->media_type == 'application/pdf'){
										echo '<a target="_blank" href="'.$this->Url->build(DS.$data->media_dir.DS.$data->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->file_name.'">';
										echo '<div class="icon">';
										echo '<span class="fa fa-file-pdf-o fa-3x"></span>';
										echo '</div>';
										echo '<h6>'.$trimmed_file_name.'</h6>';
										if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
										}
										echo '</a>';
									}else{
										echo '<a target="_blank" href="'.$this->Url->build(DS.$data->media_dir.DS.$data->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->file_name.'">';
										echo '<div class="icon">';
										echo '<span class="fa fa-file fa-3x"></span>';
										echo '</div>';
										echo '<h6>'.$trimmed_file_name.'</h6>';
										if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
								
										}
										echo '</a>';
									}
								
								
								}
							}
							
							
						endforeach;
					}else{
						if($check_parent_media){
							echo '<div class="callout secondary">'.$parent_media->folder_name.' empty</div>';
						}else{
							echo '<div class="callout secondary">Folder empty</div>';
						}
						
					}
				?>
				<!-- <a href="#" class="small-6 medium-4 large-3 columns media-folder">
					<div class="icon">
						<span class="fa fa-files-o fa-4x"></span>
					</div>
					<h6>Documents</h6>
				</a>

				<a href="#" class="small-6 medium-4 large-3 columns media-folder">
					<div class="icon">
						<span class="fa fa-star-o fa-4x"></span>
					</div>
					<h6>Favorites</h6>
				</a>

				<a href="#" class="small-6 medium-4 large-3 columns media-folder">
					<div class="icon">
						<span class="fa fa-music fa-4x"></span>
					</div>
					<h6>Audio</h6>
				</a> -->
				
				<!-- <a href="#" class="small-6 medium-4 large-3 columns media-folder">
					<div class="icon">
						<span class="fa fa-globe fa-4x"></span>
					</div>
					<h6>Public</h6>
				</a> -->
				
			</div>
	    </div>

	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('dpt_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>