<?php
class BlogPost extends AppModel{

	public function beforeSave($options = array()){
		if (isset($this->data[$this->alias]['date'])) {
			$this->data[$this->alias]['date'] = $this->formatDatetimeMysql($this->data[$this->alias]['date']);
		}
		return true;
	}

	public function afterFind($results, $primary = false){
		foreach ($results as $key => $val) {
			if (isset($val[$this->alias]['date'])) {
				$results[$key][$this->alias]['date'] = $this->formateDatetimeView($val[$this->alias]['date']);
			}
		}
		return $results;
	}
}