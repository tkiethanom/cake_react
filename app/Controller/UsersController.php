<?php
App::uses('AdminController', 'Controller');

class UsersController extends AdminController{
	public $controller = 'Users';
	public $model = 'User';
	public $uses = array('User');

	function beforeFilter(){
		parent::beforeFilter();

		$this->set('model',$this->model);
	}

	function admin_index(){
		$this->layout = 'admin';


		$this->Paginator->settings = array(
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
			if($this->request->data['User']['password'] != $this->request->data['User']['confirm_password']){
				$this->User->validationErrors['password'] = 'Passwords must match.';
			}

			if(empty($this->User->validationErrors)){
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
	}

	function admin_edit($id){
		$this->layout = 'admin';
		$this->set('title_for_layout',Inflector::humanize($this->controller).' Edit');

		if(!empty($id)){
			$data = $this->{$this->model}->find('first', array('conditions'=>array($this->model.'.id'=>$id)));
			unset($data['User']['password']);

			if(!empty($data)){
				if(!empty($this->data)){

					if(empty($this->data['User']['password'])){
						unset($this->request->data['User']['password']);
						unset($this->request->data['User']['confirm_password']);
					}
					else{
						if($this->request->data['User']['password'] != $this->request->data['User']['confirm_password']){
							$this->User->validationErrors['password'] = 'Passwords must match.';
						}
					}
					if(empty($this->User->validationErrors)){
						if($this->{$this->model}->save($this->data)){
							$this->Session->setFlash(__('Edit Successful.'),'default',array('class'=>'success') );
							return $this->redirect(array('action' => 'index'));
						}
						else{
							$this->Session->setFlash(__('Edit Failed.'),'default',array('class'=>'error') );
						}
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



	function admin_login(){
		$this->set('title_for_layout','Admin Login');

		if($this->Auth->loggedIn()){
			$this->redirect('/admin');
		}
		else{
			if ($this->request->is('post')) {
				if ($this->Auth->login()) {
					return $this->redirect($this->Auth->redirectUrl());
				}
				$this->Session->setFlash(__('Invalid email or password, try again'),'default',array('class'=>'error') );
			}
		}

	}

	function admin_logout(){
		return $this->redirect($this->Auth->logout());
	}
}