<?php

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Joomlyform');
$controller->execute(JFactory::getApplication()->input->get('task', 'display'));
$controller->redirect();

?>