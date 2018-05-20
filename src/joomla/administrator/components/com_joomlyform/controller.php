<?php

defined('_JEXEC') or die;

class JoomlyformController extends JControllerLegacy
{

	public function display($cachable = false, $urlparams = false)
	{

		$document	= JFactory::getDocument();
		$vName   = isset($_GET['view'])?$_GET['view']:"list";
		$vFormat = $document->getType();
		$view = $this->getView($vName, $vFormat);
		$model = $this->getModel($vName);
		$view->setModel($model, true);
		$extension = 'com_joomly';
		$base_dir = JPATH_BASE."/components/com_joomlyform";
		$language_tag = 'ru-RU';
		JFactory::getLanguage()->load($extension, $base_dir,  $language_tag, true);	
		$view->display();
		
	}
	
	public function	deleteFeed()
	{
	
		$id = $_POST['delete_id'];
		$table = $_POST['table'];
		$db = JFactory::getDbo();
		$query= "DELETE FROM {$table} WHERE `id` = {$id}";
		$db->setQuery($query);
		$result = $db->execute();
	}
}
