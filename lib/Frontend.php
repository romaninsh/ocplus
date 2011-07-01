<?php
/*
   Commonly you would want to re-define ApiFrontend for your own application.
 */
class Frontend extends ApiFrontend {
	function init(){
		parent::init();
		$this->addLocation('atk4-addons',array(
					'php'=>array(
                        'mvc',
						'misc/lib',
						)
					))
			->setParent($this->pathfinder->base_location);

		$this->add('jUI');
		$this->dbConnect();
		$this->js()
			->_load('atk4_univ')
			;

		$this->template->tryDel('Menu');
		$this->add('H1',null,'logo')->set('Open Cofee London Googlep + Invite Tracker');
		$this->add('HtmlElement',null,'logo')->setElement('a')->setAttr('href','https://github.com/romaninsh/ocplus')
			->set('Fork me on GitHub');

		$cr=$this->add('CRUD');
		$cr->setModel('OcPlus',array('invite_me'),array('invite_me','is_invited'));
		if($cr->add_button){
			$cr->grid->addColumn('confirm','invited','Invited');
			$cr->grid->addOrder()->move('invited','before','edit')->now();
			$cr->grid->dq->order('id desc');
			$cr->add_button->set('Invite me to Google +');
			if($_GET['invited']){
				$cr->grid->getModel()->loadData($_GET['invited'])->set('is_invited',true)->update();
				$cr->grid->js()->reload()->execute();
			}
		}
	}
}
