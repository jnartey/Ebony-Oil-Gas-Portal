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
use Cake\Routing\Router;

$this->layout = 'ajax';
$this->assign('title', 'Media');
?>
<nav aria-label="You are here:" role="navigation">
  <ul class="breadcrumbs">
	  <?php
		  if($crumbs){
			  echo '<li><a href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-media'.DS.'index', true).'"><span class="fa fa-home"></span></a></li>';
			  foreach($crumbs as $crumb):
				  echo '<li><a href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-media'.DS.'index'.DS.$crumb->id, true).'">'.$crumb->folder_name.'</a></li>';
			  endforeach;
		  }
	  ?>
  </ul>
</nav>
<?php
	if(!empty($media->toArray())){
		foreach($media as $data):
			if($data->project_id){
				$checkF = $this->cell('Misc::projectAccessF', ['WorkgroupProjectMembers', $activeUser['id'], $data->project_id])->render('result');
				if($checkF == true || $activeUser['role_id'] == 1 || $activeUser['id'] == $data->user_id){
					if($data->folder_name){
				
						$trimmed_folder_name = null;
				
						if(strlen($data->folder_name) > 15){
							$trimmed_folder_name = substr($data->folder_name,0,15).'....';
						}else{
							$trimmed_folder_name = $data->folder_name;
						} 
				
						if($data->media_access == 1){
							echo '<a href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
							echo '<div class="icon">';
							echo '<span class="fa fa-folder-o fa-3x"></span>';
							echo '</div>';
					  
							echo '<h6>'.$trimmed_folder_name.'</h6>';
							if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
				
							}
							echo '</a>';
						}
			
						if($data->media_access == 2 && $data->uploaded_by == $check_user->user_id){
							echo '<a href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
							echo '<div class="icon">';
							echo '<span class="fa fa-folder-o fa-3x"></span>';
							echo '</div>';
							echo '<h6>'.$trimmed_folder_name.'</h6>';
							if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
				
							}
							echo '</a>';
						}
			
						if($data->media_access == 3){
							echo '<a href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
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
						echo '<a href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
						echo '<div class="icon">';
						echo '<span class="fa fa-folder-o fa-3x"></span>';
						echo '</div>';
					  
						echo '<h6>'.$trimmed_folder_name.'</h6>';
						if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
				
						}
						echo '</a>';
					}
			
					if($data->media_access == 2 && $data->uploaded_by == $check_user->user_id){
						echo '<a href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
						echo '<div class="icon">';
						echo '<span class="fa fa-folder-o fa-3x"></span>';
						echo '</div>';
						echo '<h6>'.$trimmed_folder_name.'</h6>';
						if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->uploaded_by == $check_user->user_id){
				
						}
						echo '</a>';
					}
			
					if($data->media_access == 3){
						echo '<a href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-media'.DS.'index'.DS.$data->id, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$data->folder_name.'">';
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