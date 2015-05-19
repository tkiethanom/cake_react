<?php
class AdminController extends AppController{
	public $controller = 'Admin';
	public $model = 'Admin';

	function beforeFilter(){
		parent::beforeFilter();

		$this->set('model',$this->model);
	}

	function admin_index(){
		$this->layout = 'admin';
		$this->Paginator->settings = array(
			'limit'=>25,
			'order'=>array($this->model.'.id'=>'ASC')
		);
		$data = $this->Paginator->paginate(
			$this->model,
			array()
		);

		$this->set('data', $data);
	}

	function admin_add(){
		$this->layout = 'admin';
		$this->set('title_for_layout',Inflector::humanize($this->controller).' Add');

		if (!empty($this->data)) {
			$this->{$this->model}->create();
			if ($this->{$this->model}->save($this->data)) {
				$this->Session->setFlash(__('Add Successful.'),'default',array('class'=>'success') );
				return $this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash(__('Add Failed.'),'default',array('class'=>'error') );
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

	function admin_edit($id){
		$this->layout = 'admin';
		$this->set('title_for_layout',Inflector::humanize($this->controller).' Edit');

		if(!empty($id)){
			$data = $this->{$this->model}->find('first', array('conditions'=>array($this->model.'.id'=>$id)));

			if(!empty($data)){
				if(!empty($this->data)){
					if($this->{$this->model}->save($this->data)){
						$this->Session->setFlash(__('Edit Successful.'),'default',array('class'=>'success') );
						return $this->redirect(array('action' => 'index'));
					}
					else{
						$this->Session->setFlash(__('Edit Failed.'),'default',array('class'=>'error') );
					}
				}
				else{
					$this->request->data = $data;
				}
			}
			else{
				$this->Session->setFlash(__(Inflector::humanize($this->model).' could not be found.'),'default',array('class'=>'error') );
				return $this->redirect(array('action' => 'index'));
			}
		}
	}

	function admin_delete($id){
		$this->layout = 'admin';
		$data = $this->{$this->model}->find('first', array('conditions'=>array($this->model.'.id'=>$id)));
		if(!empty($data)){
			if($this->{$this->model}->delete($id)){
				$this->Session->setFlash(__(Inflector::humanize($this->model).' Deleted Succesfully.'),'default',array('class'=>'success') );
			}
			else{
				$this->Session->setFlash(__(Inflector::humanize($this->model).' could not be deleted.'),'default',array('class'=>'error') );
			}
		}
		else{
			$this->Session->setFlash(__(Inflector::humanize($this->model).' could not be found.'),'default',array('class'=>'error') );
		}

		return $this->redirect(array('action' => 'index'));
	}

	function admin_reorder(){
		$this->layout = 'admin';
		$output = array('success'=>false, 'error'=>array());

		if(!empty($this->data)){
			$lowest_row = $this->{$this->model}->find('first',array(
					'conditions'=>array($this->model.'.id'=>$this->data['id']),
					'order'=>array($this->model.'.order'=>'ASC')
				)
			);

			if($lowest_row[$this->model]['order'] == null){
				$lowest = 1;
			}
			else{
				$lowest = $lowest_row[$this->model]['order'];
			}

			foreach($this->data['id'] as $id){
				$this->{$this->model}->save(array('id'=>$id, 'order'=>$lowest));
				$lowest++;
				$output['success'] = true;
			}
		}

		header('Content-Type: application/json');
		echo json_encode($output);
		exit;
	}

	function admin_setOrder($id){
		$this->layout = 'admin';
		$output = array('success'=>false, 'error'=>array());

		if(!empty($this->data)){
			if(isset($this->data['order']) ){
				$data = $this->{$this->model}->find('first', array('conditions'=>array($this->model.'.id'=>$id)));
				if(!empty($data)){
					if($this->data['order'] == ''){
						$this->request->data['order'] = null;
					}
					if($this->{$this->model}->save(array('id'=>$id,'order'=>$this->data['order']))){
						$output['success'] = true;
					}
					else{
						$output['error'] = 'Unable to save';
					}
				}
				else{
					$output['error'] = 'Not found';
				}
			}
		}

		header('Content-Type: application/json');
		echo json_encode($output);
		exit;
	}

	function index(){
		$this->set('title_for_layout','Admin');
	}

}
