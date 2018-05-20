<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class JoomlyformModelAdd extends JModelLegacy
{	
	
	function sendMessage($data,$add){
		$mailer = JFactory::getMailer();
		
		$sender_mail = $this->getSenderMail($data->email);
		$from = array($sender_mail, $data->name);
		$mailer->setSender($from);
		
		$mail = $this->getRecipient($add['form_id']);
		$mailer->addRecipient($mail);
		
		$subject = $this->getSubject($data->title);
		$mailer->setSubject($subject);
		
		$body = $this->getBody($data,$add);
		$mailer->setBody($body);
		
		if (file_exists($_FILES["file"]["tmp_name"][0])){
			$attachments = array();
			$name = array();
			for ($i = 0; $i < count($_FILES["file"]["name"]);$i++ ){
				$attachments[] =  $_FILES["file"]["tmp_name"][$i];
				$name[]= $_FILES["file"]["name"][$i];
			}	
			$mailer->addAttachment($attachments, $name);
		}	
		
		$mailer->IsHTML(true);
		$mailer->Send();
	
	}
	
	function getRecipient($form_id){
		$query = $this->_db->getQuery(true);
		if ($form_id !== '')
		{
			$mod_name = 'mod_joomly_'.$form_id;
			$query->select('params')
			->from('#__modules')
			->where("module='{$mod_name}'");	
		} else {
			$query->select('params')
			->from('#__modules')
			->where('module="mod_joomly_form"');
		}	
		$this->_db->setQuery($query);
		$array =  $this->_db->loadAssoc();
		$parameters =  json_decode($array['params']); 
		$mail = $parameters->admin_mail;
		if ($mail == null){
			$config = JFactory::getConfig();
			$mail = $config->get('mailfrom');
		}
		return $mail;
	}
	
	function getSenderMail($mail){
		$sender_mail = $mail;
		if ($sender_mail == null){
			$config = JFactory::getConfig();
			$sender_mail = $config->get('mailfrom');
		}
		return $sender_mail;
	}
	
	function getSubject($title){
		$subject = $title;
		if ($subject == null){
			$subject = JText::_('COM_JOOMLY_FORM_NEW_FEEDBACK');
		}
		return $subject;
	}
	
	function getBody($data,$add){
		$captions = $this->getCaptions($add['form_id']);
		$i = 0;
		foreach ($data as $key=>$value){
			if  (($key !== '_errors') && ($key !== 'id')&&($key !== 'read')&&($key !== 'created_at')&&($key !== 'ip')&&($key !== 'page')){
				$body = $body.'<br><b>'.$captions[$i].'</b>: '.$value;
				$i +=1;
			}	
		}
		$body = $body.'<br><b>'.JText::_('COM_JOOMLY_FORM_DATE').'</b>: '.$data->created_at;
		$body = $body.'<br><b>IP</b>: '.$data->ip;
		$body = $body.'<br><b>'.JText::_('COM_JOOMLY_FORM_SITE_PAGE').'</b>: '.$data->page;
		return $body;
	}
	
	function getCaptions($form){
		$query= "SELECT `captions` FROM #__joomly  WHERE `form` = '{$form}'";
		$this->_db->setQuery($query);
		$captions = json_decode($this->_db->loadResult(),true);
			
		return $captions;	
	}
}
