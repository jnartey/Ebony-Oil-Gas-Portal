<?php
namespace App\View\Cell;

use Cake\View\Cell;
// use Cake\Chronos\Chronos;
// use Cake\I18n\Time;

/**
 * Misc cell
 */
class MiscCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display() {
		$this->loadModel('Messages');
        $unread = $this->Messages->find('unread');
        $this->set('unread_count', $unread->count());
    }
	
    public function count($table, $field, $target_field, $status = null) {
		$this->loadModel($table);
		
		$count = null;
		
		if(is_array($target_field)){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.$field.' IN' => $target_field]]);
		}elseif($status){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.$field => $target_field, $table.'.status' => $status]]);
		}else{
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.$field => $target_field]]);
		}
		
		if($count){
			$this->set('count_field', $count->count());
		}else{
			$this->set('count_field', 0);
		}
    }
	
    public function countComment($table, $comment_src, $source_id, $project_id = null, $department_id = null, $workgroup_id = null) {
		
		$this->loadModel($table);
		
		$count = null;
		
		if($project_id){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'comment_src IN' => $comment_src, $table.'.'.'source_id' => $source_id, $table.'.'.'project_id' => $project_id]]);
		}elseif($workgroup_id){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'comment_src IN' => $comment_src, $table.'.'.'source_id' => $source_id, $table.'.'.'workgroup_id' => $workgroup_id]]);
		}elseif($project_id && $workgroup_id){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'comment_src IN' => $comment_src, $table.'.'.'source_id' => $source_id, $table.'.'.'project_id' => $project_id, $table.'.'.'workgroup_id' => $workgroup_id]]);
		}else{
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'comment_src IN' => $comment_src, $table.'.'.'source_id' => $source_id]]);
		}
				
		if($count){
			$this->set('count_field', $count->count());
		}else{
			$this->set('count_field', 0);
		}
    }
	
    public function countCommentMisc($table, $comment_src, $source_id, $primary_field = null, $primary_value = null, $secondary_field = null, $secondary_value = null) {
		
		$this->loadModel($table);
		
		$count = null;
		
		if($primary_field && $primary_value){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'comment_src IN' => $comment_src, $table.'.'.'source_id' => $source_id, $table.'.'.$primary_field => $primary_value]]);
		}elseif($secondary_field && $secondary_value){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'comment_src IN' => $comment_src, $table.'.'.'source_id' => $source_id, $table.'.'.$primary_field => $primary_value, $table.'.'.$secondary_field => $secondary_value]]);
		}
				
		if($count){
			$this->set('count_field', $count->count());
		}else{
			$this->set('count_field', 0);
		}
    }
	
    public function countFiles($table, $source_id, $project_id = null, $task_id = null, $department_id = null, $workgroup_id = null) {
		
		$this->loadModel($table);
		
		$count = null;
		
		if($project_id && !$task_id && $source_id){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'source_id' => $source_id, $table.'.'.'project_id' => $project_id, $table.'.'.'file_name IS NOT'=>'', $table.'.'.'task_id IS'=>null, $table.'.'.'department_id' => $department_id]]);
		}elseif($project_id && $task_id && $source_id){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'source_id' => $source_id, $table.'.'.'project_id' => $project_id, $table.'.'.'file_name IS NOT'=>'', $table.'.'.'task_id'=>$task_id, $table.'.'.'department_id' => $department_id]]);
		}elseif($workgroup_id && $source_id){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'source_id' => $source_id, $table.'.'.'project_id' => $project_id, $table.'.'.'file_name IS NOT'=>'', $table.'.'.'task_id'=>$task_id, $table.'.'.'workgroup_id' => $workgroup_id]]);
		}else{
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'project_id' => $project_id, $table.'.'.'file_name IS NOT'=>'', $table.'.'.'department_id' => $department_id]]);
		}
				
		if($count){
			$this->set('count_field', $count->count());
		}else{
			$this->set('count_field', 0);
		}
    }
	
    public function countFilesMisc($table, $source_id, $primary_field = null, $primary_value = null, $secondary_field = null, $secondary_value = null) {
		
		$this->loadModel($table);
		
		$count = null;
		
		if($primary_field && $primary_value){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'source_id' => $source_id, $table.'.'.$primary_field => $primary_value]]);
		}elseif($secondary_field && $secondary_value){
			$count = $this->$table->find('all', ['conditions'=>[$table.'.'.'source_id' => $source_id, $table.'.'.$primary_field => $primary_value, $table.'.'.$secondary_field => $secondary_value]]);
		}
				
		if($count){
			$this->set('count_field', $count->count());
		}else{
			$this->set('count_field', 0);
		}
    }
	
	public function projectAccessF($table, $user_id, $project_id){
		$this->loadModel($table);
		
		$result = $this->$table->find('all', ['conditions'=>[$table.'.'.'project_id' => $project_id, $table.'.'.'user_id' => $user_id]]);
		$result = $result->toArray();
		
		if($result){
			$check = true;
		}else{
			$check = false;
		}
		
		$this->set('check', $check);
	}
	
    public function eventStatus($start_date, $end_date = null, $raw = null) {
		$this->set('start_date', $start_date);
        $this->set('end_date', $end_date);
		$this->set('raw', $raw);
    }
	
    public function getUsers($id) {
		$this->loadModel('Users');
		$expanded_ids = explode(',', $id);
        $staff = $this->Users->find('all', ['conditions'=>['Users.id IN'=>$expanded_ids]]);
        $this->set('staff', $staff);
    }
	
    public function getDepartments($id) {
		$this->loadModel('DepartmentsMembers');
        $department = $this->DepartmentsMembers->find('all', ['conditions'=>['DepartmentsMembers.user_id'=>$id], 'contain'=>['Departments']]);
		$department_ch = $department->toArray();
        $this->set('department', $department);
		$this->set('department_ch', $department_ch);
    }
	
    public function onlineStatus($id) {
		$this->loadModel('UsersLog');
        $userlog = $this->UsersLog->find('all', ['conditions'=>['UsersLog.user_id'=>$id], 'order'=>['UsersLog.created'=>'DESC']]);
		$userlog = $userlog->first();
        $this->set('userlog', $userlog);
    }
}
