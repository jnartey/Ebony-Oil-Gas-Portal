<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * Canteen Controller
 *
 * @property \App\Model\Table\CanteenTable $Canteen
 */
class CanteenController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $canteen = $this->paginate($this->Canteen);

        $this->set(compact('canteen'));
        $this->set('_serialize', ['canteen']);
    }

    /**
     * View method
     *
     * @param string|null $id Canteen id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $canteen = $this->Canteen->get($id, [
            'contain' => []
        ]);
			
		$canteen_results = $this->Canteen->find('all', ['conditions' => ['Canteen.menu'=>$canteen->id]]);

        $this->set('canteen', $canteen);
		$this->set('canteen_results', $canteen_results);
        $this->set('_serialize', ['canteen']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$userA = $this->Auth->user();
        $canteen = $this->Canteen->newEntity();
        if ($this->request->is('post')) {
			//pr($this->request->getData());
			//debug($this->Canteen->save($canteen_f));
			$canteen->menu = $this->request->getData('menu');
			$canteen->week = null;
			$canteen->day = null;
			$canteen->morning_meal = null;
			$canteen->morning_meal_description = null;
			$canteen->afternoon_meal = null;
			$canteen->afternoon_meal_description = null;
			$canteen->evening_meal = null;
			$canteen->evening_meal_description = null;
			$canteen->status = 1;
			
			$canteen_f = $this->Canteen->patchEntity($canteen, $this->request->getData());
			
            if ($result = $this->Canteen->save($canteen_f)) {
				$i = 1;
				$data_x = array();
				
				foreach($this->request->getData() as $data):
					if($i != 1){
						$data_x[$i]['week'] = $result->week;
						$data_x[$i]['menu'] = $result->id;
						$data_x[$i]['day'] = $data['day'];
						$data_x[$i]['morning_meal'] = $data['morning_meal'];
						$data_x[$i]['morning_meal_description'] = $data['morning_meal_description'];
						$data_x[$i]['afternoon_meal'] = $data['afternoon_meal'];
						$data_x[$i]['afternoon_meal_description'] = $data['afternoon_meal_description'];
						$data_x[$i]['evening_meal'] = $data['evening_meal'];
						$data_x[$i]['evening_meal_description'] = $data['evening_meal_description'];
					}
					
					$i++;
				endforeach;
				
				$canteen_entities = $this->Canteen->newEntities($data_x);
				//debug($this->Canteen->saveMany($canteen_entities));
				if($this->Canteen->saveMany($canteen_entities)){
					$this->Log->write('info', 'Canteen', $userA['first_name'].' '.$userA['last_name'].' Added '.$this->request->getData('menu'), [], ['request' => true]);
					$this->Flash->success(__('Canteen week '.$result->menu.' has been saved.'));
					return $this->redirect(['action' => 'index']);
				}
				
            }else{
            	$this->Flash->error(__('The canteen could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('canteen'));
        $this->set('_serialize', ['canteen']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Canteen id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $day = null)
    {
		$userA = $this->Auth->user();
        $canteen = $this->Canteen->get($id, [
            'contain' => []
        ]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $canteen = $this->Canteen->patchEntity($canteen, $this->request->getData());
            if ($this->Canteen->save($canteen)) {
				$this->Log->write('info', 'Canteen', $userA['first_name'].' '.$userA['last_name'].' edited '.$canteen->day, [], ['request' => true]);
				if($day){
					$this->Flash->success(__('Menu Day '.$canteen->day.' has been updated.'));
					return $this->redirect(['action' => 'view', $canteen->menu]);
				}else{
					$this->Flash->success(__($canteen->menu.' has been updated.'));
					return $this->redirect(['action' => 'index']);
				}
            }
            $this->Flash->error(__('The canteen could not be updated. Please, try again.'));
        }
        $this->set(compact('canteen', 'canteen_results', 'day'));
        $this->set('_serialize', ['canteen']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Canteen id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $canteen = $this->Canteen->get($id);
        if ($this->Canteen->delete($canteen)) {
			$this->Canteen->deleteAll([
			    'menu' => $canteen->id
			]);
			
			$this->Log->write('info', 'Canteen', $userA['first_name'].' '.$userA['last_name'].' deleted '.$canteen->name, [], ['request' => true]);
            $this->Flash->success(__($canteen->name.' has been deleted.'));
        } else {
            $this->Flash->error(__($canteen->name.' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
    public function makeDefault($id = null)
    {
		$userA = $this->Auth->user();
        $this->request->allowMethod(['post', 'delete']);
        $canteen = $this->Canteen->get($id);
		$canteen_status = $this->Canteen->newEntity();
		
        if ($this->Canteen->updateAll(['Canteen.status '=>1], ['Canteen.status '=>0])) {
			$canteen_status->id = $id;
			$canteen_status->status = 1;
			
			$this->Log->write('info', 'Canteen', $userA['first_name'].' '.$userA['last_name'].' made '.$canteen->name.' default', [], ['request' => true]);
			
			if($this->Canteen->save($canteen_status)) {
				$this->Flash->success(__($canteen->menu.' is set as default menu'));
			}
            
        } else {
            $this->Flash->error(__($canteen->menu.' could not be set as default. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
