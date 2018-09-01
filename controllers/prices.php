<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 * Controller
 * @author Alexander Kravez
 */
class Tours_InfoControllerPrices extends JControllerForm
{

	/**
	 * Class constructor
	 * @param array $config
	 */
	function __construct( $config = array() )
	{
		$this->view_list = 'Prices';
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