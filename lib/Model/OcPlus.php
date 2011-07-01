<?php
class Model_OcPlus extends Model_Table {
	public $entity_code='ocplus';

	function init(){
		parent::init();
		$this->addField('invite_me') ->caption('Email to invite');
		$this->addField('is_invited')->type('boolean');
		$this->addField('invited_by') ;
		$this->addField('deleted')->type('boolean');

	}
}
