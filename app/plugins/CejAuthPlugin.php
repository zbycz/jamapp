<?php
/**
 * nPress - opensource cms
 *
 * @copyright  (c) 2012 Pavel Zbytovský (pavel@zby.cz)
 * @link       http://npress.info/
 * @package    nPress
 */



class CejAuthPlugin extends Control
{
	static $events = array(
		'allow_admin_request',
		'allow_page_edit',
	);
	
	public static function allow_admin_request($presenter)
	{
		if(!$presenter->user->isInRole('user')) //not our user -> allow
			return true;

		return false;
	}
	
	public static function allow_page_edit($presenter, $id){
		if(!$presenter->user->isInRole('user')) //not our user -> allow
			return true;
					
		return false;	
	}


	public function handleLogin(){

		
		$row = dibi::query('SELECT * FROM patrols WHERE pl_mail = %s',$_POST['mail'])->fetch();
		if(!$row OR strtolower($row['id']) != strtolower($_POST['passw'])){
					$this->presenter->flashMessage('Sorry you have put in wrong email or ID, try again or conact INFO TENT.');
				$this->presenter->redirect('this');
					return;
		}
		
		$this->presenter->user->login(new Identity($row['id'], array('user'), $row));
		$this->presenter->flashMessage('You were logged in successfully!');
		$this->presenter->redirect('this');
	}
}
