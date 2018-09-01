<?php
defined( '_JEXEC' ) or die; // No direct access
/**
 * Component tours_info
 * @author Alexander Kravez
 */
require_once JPATH_COMPONENT.'/helpers/tours_info.php';
$controller = JControllerLegacy::getInstance( 'tours_info' );
$controller->execute( JFactory::getApplication()->input->get( 'task' ) );
$controller->redirect();
