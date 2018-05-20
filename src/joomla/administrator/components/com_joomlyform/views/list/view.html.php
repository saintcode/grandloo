<?php
defined('_JEXEC') or die;

class JoomlyformViewList extends JViewLegacy
{
	public function display($tpl = null)
	{
		$document	= JFactory::getDocument();
		$document->addStyleSheet('components/com_joomlyform/css/list.css');
		$model=$this->getModel();
		$list=$model->getList();
		$this->assignRef('list', $list);

		
		parent::display($tpl);
	}

	
}
