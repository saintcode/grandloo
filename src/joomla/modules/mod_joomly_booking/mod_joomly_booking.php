<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_joomly_form
 *
 * @copyright   Copyright (C) 2015 Artem Yegorov. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//require_once __DIR__ . '/helper.php';

$app  = JFactory::getApplication();
$data = $app->getUserState('joomlyform.add.form.data', array());
$app->setUserState('joomlyform.add.form.data', array());
$doc =JFactory::getDocument();
$doc->addStyleSheet('components/com_joomlyform/css/constructor-form.css' );
//$fields = ModFormHelper::getFields();


//require JModuleHelper::getLayoutPath('mod_joomly_form', $params->get('layout', 'default'));
require_once __DIR__ . '/tmpl/default.php';
