<?php

defined('_JEXEC') or die;

class JoomlyformViewFeedback extends JViewLegacy
{
	
	public function display($tpl = null)
	{
		$document	= JFactory::getDocument();
		$document->addStyleSheet('components/com_joomlyform/css/feedback.css');
		$model= $this->getModel();
		$feedback=$model->getFeedback();
		$this->assignRef('feedback', $feedback);
		$captions=$model->getCaptions();
		$this->assignRef('captions', $captions);
		
		parent::display($tpl);
	}

	
}
