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
	}

}