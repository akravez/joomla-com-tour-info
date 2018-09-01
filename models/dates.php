<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Model for edit/create current element
 * @author Alexander Kravez
 */
class Tours_InfoModelDates extends JModelAdmin
{
	/**
	 * Method of loading the current form
	 * @param Array $data
	 * @param Boolean $loadData
	 * @return Object form data
	 */
	public function getForm( $data = array(), $loadData = true )
	{
		$form = $this->loadForm( '', 'dates', array( 'control' => 'jform', 'load_data' => $loadData ) );
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
	 * @return Tabletour_dates
	 */
	public function getTable( $type = 'tour_dates', $prefix = 'Table', $config = array() )
	{
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * Method of loading data to form
	 * @return Object
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState( 'com_tours_info.edit.dates.data', array() );
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
		// для отладки - имя файла для вывода информации
		$f = 'tour_info_db_access.log';

		if ($data['newold'] == 1) {
			// Заведение новых дат
			$table = $this->getTable( 'tour_dates' );
			$table_tour = $this->getTable( 'tour_price' );
			$table_tour->load($data['tour_id']);
			$tourlen = $table_tour->days;

			$startdate = date( "Y-m-d", strtotime( $data['date_start'] ) );
			$enddate = date( "Y-m-d", strtotime( "+" . $tourlen-1 ." days", strtotime( $data['date_start'] ) ) );
			// готовим асс.масссив
			$archiveData = array(
				'date_start' => $startdate,
				'date_end' => $enddate,
				'tour_id' => $data['tour_id']
			);
			// для отладки - вывод в файл
			$p = "Новые даты тура с ID: " . $data['tour_id'] . ": start " . $startdate . ", end " . $enddate . "\n";
			file_put_contents($f, $p, FILE_APPEND);
			//
			//Заносим данные в таблицу
			$table->bind( $archiveData );
			if ( $table->store() )
				return true;
			return false;
		}
		else {
			// Удаление старых дат
			$table = $this->getTable( 'tour_dates' );
			// обрабатываем возвращенное в поле 'dates' значение как массив, т.к. в шаблоне указано "multiple"
			foreach ($data['dates'] as $i) {
				$table->load($i);
				// для отладки - вывод в файл
				$p = "Удаление дат с ID записи=" . $i . "\n";
				file_put_contents($f, $p, FILE_APPEND);
				//
				$table->delete();
			}
			return true;
		}
	}

}