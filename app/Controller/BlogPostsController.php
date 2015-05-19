<?php
App::uses('AdminController', 'Controller');

class BlogPostsController extends AdminController
{
	public $controller = 'BlogPosts';
	public $model = 'BlogPost';
	public $uses = array('BlogPost');

	function beforeFilter()
	{
		parent::beforeFilter();

		$this->set('model', $this->model);

		$this->Auth->allow('index','view');
	}

	function index(){
		$this->layout = 'default';
		if($this->request->is('ajax') ){
			$this->layout = 'ajax';
		}

		$posts = $this->BlogPost->find('all');
		$data = array('BlogPosts'=>$posts);
		$this->set('data', json_encode($data) );

		$this->render(false);
	}

	function view($id){
		$this->layout = 'default';
		if($this->request->is('ajax') ){
			$this->layout = 'ajax';
		}

		$post = $this->BlogPost->find('first', array('conditions'=>array('BlogPost.id'=>$id)));
		$data = $post;
		$this->set('data', json_encode($data) );

		$this->render(false);
	}
}
