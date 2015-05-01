<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
	public $validate = array(
		'email' => array(
			'notEmpty' => array(
				'rule'=>'notEmpty',
				'message'=>'Cannot be blank'
			),
			'email' => array(
				'rule'=>'email',
				'message'=>'Invalid email address'
			)
		),
		'password' => array('rule'=>'notEmpty'),
	);

	public function beforeSave($options = array())
	{
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}
}
