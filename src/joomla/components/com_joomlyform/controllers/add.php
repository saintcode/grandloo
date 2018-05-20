<?php
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

class JoomlyformControllerAdd extends JoomlyformController
{
	
	public function save()
	{	
		$url = JFactory::getURI();
		$app    = JFactory::getApplication();
		$input  = $app->input;
		$method = $input->getMethod();
		
		$data = array();
		$data = JRequest::get('post');
		
		if (array_key_exists('captcha', $data)){
				$captcha = md5($data['captcha']);
		} else {
				$captcha = 'none';
		}	
		
		if (array_key_exists('email', $data)){
				unset($data['email']);
		}	
		
		if (($captcha !== 'none')&&($captcha !== $_COOKIE['joomlyform_captcha'])){
			$app->setUserState('joomlyform.add.form.data', $data);
			setcookie('joomlyform_captcha', null, -1,'/',null);
			$app->redirect(JRoute::_($url, false), JText::_('COM_JOOMLY_FORM_CAPTCHA_ERROR'));
		}
		
		if (file_exists($_FILES["file"]["tmp_name"][0])){
		
			for ($i = 0; $i < count($_FILES["file"]["name"]);$i++ ){
				
				if ($_FILES["file"]["error"][$i] > 0) { 
					$app->setUserState('joomlyform.add.form.data', $data);
					setcookie('joomlyform_captcha', null, -1,'/',null);
					$app->redirect(JRoute::_($url, false), $_FILES["files"]["error"][$i]);
				} 
			
				if ($_FILES["file"]["size"][$i] > 10000000){
					$app->setUserState('joomlyform.add.form.data', $data);
					setcookie('joomlyform_captcha', null, -1,'/',null);
					$app->redirect(JRoute::_($url, false), JText::_('COM_JOOMLY_FORM_FILESIZE_ERROR'));	
				}
			}			
		}
		
		$tablename = "joomly".$data['form_id'];
		JTable::addIncludePath(JPATH_COMPONENT.'/tables/');
		$row = JTable::getInstance($tablename, 'Table');		
		if (!$row->bind(JRequest::get('post'))){
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
	
		
		$row->created_at = date('Y-m-d H:i:s');
		$model= $this->getModel('add');
		$model->sendMessage($row,$data);
		if (!$row->store()){
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		$app-> redirect($url, JText::_('COM_JOOMLY_FORM_SENT_SUCESSFULL'));
	}
}
