<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class JoomlyformModelFeedback extends JModelLegacy
{	

	function getFeedback(){
		$id = JRequest::getVar('id');
		$table = '#__joomly_'.JRequest::getVar('form');
		$query= "SELECT * FROM {$table} WHERE id = {$id}";
		$this->_db->setQuery($query);
		$this->feedback = $this->_db->loadobject();
		$this->ReadToDB($id, $table);
		
		return $this->feedback;

	}
	
	function getCaptions(){
		$form = JRequest::getVar('form');
		$query= "SELECT `captions` FROM #__joomly  WHERE `form` = '{$form}'";
		$this->_db->setQuery($query);
		$captions = json_decode($this->_db->loadResult());
			
		return $captions;	
	}	
	
	function ReadToDB($id, $table){
		$query= "UPDATE {$table} SET `read` = 1 where id={$id}";
		$this->_db->setQuery($query);
		$this->_db->execute();	
	}
}
