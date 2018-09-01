<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 * Controller
 * @author Alexander Kravez
 */
class Tours_InfoControllerDates extends JControllerForm
{

	/**
	 * Class constructor
	 * @param array $config
	 */
	function __construct( $config = array() )
	{
		$this->view_list = 'Dates';
		parent::__construct( $config );
	}

	/**
	 * @return bool
	 */
	public function allowSave()
	{
		return true;
	}
	
}