<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Model for edit/create current element
 * @author Alexander Kravez
 */
class Tours_InfoModelPrices extends JModelAdmin
{
	/**
	 * Method of loading the current form
	 * @param Array $data
	 * @param Boolean $loadData
	 * @return Object form data
	 */
	public function getForm( $data = array(), $loadData = true )
	{
		$form = $this->loadForm( '', 'prices', array( 'control' => 'jform', 'load_data' => $loadData ) );
		if ( empty( $form ) ) {
			return false;
		}
		return $form;
	}

	/**
	 * Method of loading table for current item
	 * @param Sting $type (name table)
	 * @param String $prefix (prefix table)
	 * @param Array $config
	 * @return Tabletour_price
	 */
	public function getTable( $type = 'tour_price', $prefix = 'Table', $config = array() )
	{
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * Method of loading data to form
	 * @return Object
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState( 'com_tours_info.edit.prices.data', array() );
		if ( empty( $data ) ) {
			$data = $this->getItem();
		}
		return $data;
	}

	/**
	 * save data
	 * @param array $data
	 * @return bool
	 */
	public function save( $data )
	{
// имя файла для вывода отладочной информации
		$f = __DIR__ . '/tour_info_db_access.log';
		switch ( $data['newold'] ) {
			case 1: //		новый тур
				$table = $this->getTable( 'tour_price' );
				// Формируем данные для записи в таблицу
				$archiveData = array(
					'title' => $data['new_tour_name'],
					'days' => $data['new_tour_days'],
					'base_price' => $data['new_base_price'],
					'add_for_1' => $data['new_add_for_1'],
					'disc_for_3' => $data['new_disc_for_3'],
					'dinners' => $data['new_dinners'],
					'suppers' => $data['new_suppers'],
					'article_id' => $data['article_id']
				);

// для отладки - вывод в файл
//				$p = date("Y-m-d, H:i:s").": Информация о новом туре: ".implode(',', $archiveData)."\n";
//				file_put_contents($f, $p, FILE_APPEND);

				// Заносим данные в таблицу
				$table->bind( $archiveData );
				if ( $table->store() ) return true;
				return false;
				break;
			case 0:		// изменение тура
				$arrOfPrices = explode("/", $data['tour_id']);
				$tr = $arrOfPrices[0];
				$table = $this->getTable( 'tour_price' );
				$table->load($tr);
				if ( $data['changed_name'] <> "" ) {
					$tour_name = $data['changed_name'];
				} else {
					$tour_name = $table->title;
				}
				// Формируем данные для записи в таблицу
				$archiveData = array(
					'title' => $tour_name,
					'days' => $data['old_tour_days'],
					'base_price' => $data['new_base_price'],
					'add_for_1' => $data['new_add_for_1'],
					'disc_for_3' => $data['new_disc_for_3'],
					'dinners' => $data['new_dinners'],
					'suppers' => $data['new_suppers'],
					'article_id' => $table->article_id
				);

// для отладки - вывод в файл
//				$p = date("Y-m-d, H:i:s").": Информация об обновлении тура с Tour id=".$tr."\n".implode(',', $archiveData)."\n";
//				file_put_contents($f, $p, FILE_APPEND);
	
				// Заносим данные в таблицу
				$table->bind( $archiveData );
				if ( $table->store() ) return true;
				return false;
				break;
			case 2:		// удаление тура
				$arrOfPrices = explode("/", $data['tour_id']);
				$tr = $arrOfPrices[0];
				$table = $this->getTable( 'tour_price' );
				$table->load($tr);

// для отладки - вывод в файл
//				$p = "Информация об удалении тура с Tour id=".$tr."\n";
//				file_put_contents($f, $p, FILE_APPEND);

				if ( $table->delete() ) return true;
				return false;
		}	
	}
}