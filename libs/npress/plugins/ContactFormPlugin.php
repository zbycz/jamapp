<?php
/**
 * nPress - opensource cms
 *
 * @copyright  (c) 2012 Pavel Zbytovský (pavel@zby.cz)
 * @link       http://npress.info/
 * @package    nPress
 */


class ContactFormPlugin extends Control {

	static $events = array('displayPageContent');

	function displayPageContent(){
		if(!$this->parent->page->getMeta('ContactFormPlugin'))
			return true;

		$this->template->page = $this->parent->page;
		$this->template->setFile(dirname(__FILE__).'/ContactFormPlugin.latte');
		echo $this->template->render();
		return false;
	}

	public function createComponentContactForm(){
		$form = new AppForm;
		$form->addText("name", "Jméno");
		$form->addText("email", "E-mail")
						//->setDefaultValue('@')
						->setRequired('Vyplňte, prosím, správně svůj email.')
						->addRule(Form::EMAIL, 'Vyplňte, prosím, správně svůj email.');
		$form->addTextArea("text", "Zpráva")
						->setRequired('Vyplňte, prosím, svou zprávu.');
		$form->addSubmit("submit1", "Odeslat");
		//$form->addProtection(); //sends cookie ... wtf?
		$form->onSuccess[] = callback($this, 'contactFormSubmitted');
		return $form;
	}

	public function contactFormSubmitted(AppForm $form){
		//posíláme
		$mail = new Mail;
		$mail->setEncoding(Mail::ENCODING_QUOTED_PRINTABLE);
		$mail->setFrom($form['email']->value, $form['name']->value);
		$mail->addTo($this->parent->page->getMeta('ContactFormPlugin'));
		$mail->setSubject('Zpráva z webu '.$this->parent->context->params['npress']['webTitle']);
		$mail->setHtmlBody($form['text']->value);
    $mail->send();

		$this->parent->flashMessage('Zpráva byla odeslána.');
		$this->parent->redirect('this');
	}

}
