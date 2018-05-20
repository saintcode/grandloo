<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class JoomlyformModelList extends JModelLegacy
{	
	function getList(){
		
		if ((isset($_GET['page']))&&($_GET['page']>1)){
			$CurrentPage = $_GET['page'];
		} else{
			$CurrentPage = 1;
		}		
		$MaxPage = $this->getMaxPage();
		if ($CurrentPage>$MaxPage){
			$CurrentPage = $MaxPage;
		}
		$offset = ($CurrentPage-1)*10;
		$query= "SELECT * FROM #__joomly  WHERE 1 ORDER BY id DESC LIMIT {$offset},10";
		$this->_db->setQuery($query);
		$this->list = $this->_db->loadObjectList();
		
		return $this->list;
	}
	
	function getMaxPage(){
		$query= "SELECT count(*) FROM #__joomly  WHERE 1";
		$this->_db->setQuery($query);
		$count = $this->_db->loadResult();
		$MaxPage = ceil($count/10);
		$MaxPage = ceil($count/10) == 0 ? 1 : ceil($count/10);
			
		return $MaxPage;	
	}
	
	
	
}
