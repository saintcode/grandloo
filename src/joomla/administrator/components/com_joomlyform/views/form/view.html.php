<?php
defined('_JEXEC') or die;

class JoomlyformViewForm extends JViewLegacy
{
	public function display($tpl = null)
	{
		$document	= JFactory::getDocument();
		$document->addStyleSheet('components/com_joomlyform/css/list.css');
		$model=$this->getModel();
		$list=$model->getList();
		$captions=$model->getCaptions();
		$MaxPage=$model->getMaxPage();
		$this->assignRef('list', $list);
		$this->assignRef('MaxPage', $MaxPage);
		$this->assignRef('captions', $captions);
		
		parent::display($tpl);
	}

	
}
