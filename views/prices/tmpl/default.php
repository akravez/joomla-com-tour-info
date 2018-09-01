<?php
/** @var $this Tours_InfoViewPrices */
defined( '_JEXEC' ) or die; // No direct access
JHtml::_('behavior.formvalidator');
?>
<div class="item-page">
<?php
    //Получаем данные из конфиг файла
    $params = JComponentHelper::getParams( 'com_tours_info' );
    $category = $params->get( 'tour_ctg' );
$query="SELECT id, title FROM #__content WHERE catid=".$category." AND id != ALL (SELECT article_id FROM #__tour_price) ORDER BY title ASC";
$this->form->setFieldAttribute("article_id", "query", $query);
?>
	<h2>Завести новый тур или обновить существующий</h2>

	<form action="<?php echo JRoute::_( 'index.php?view=Prices' ) ?>" method="post" class="form-validate">

		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel( 'newold' ); ?></div>
			<div class="controls"><?php echo $this->form->getInput( 'newold' ); ?></div>
		</div>
<div class="container">
			<div class="controls span-8"><?php echo $this->form->renderField( 'new_tour_name' ); ?></div>
			<div class="controls span-8"><?php echo $this->form->renderField( 'new_tour_days' ); ?></div>
</div>
<div class="container">
			<div class="controls"><?php echo $this->form->renderField( 'article_id' ); ?></div>
			<div class="controls span-18"><?php echo $this->form->renderField( 'tour_id' ); ?></div>
			<div class="controls span-5 prepend-1 last"><?php echo $this->form->renderField( 'old_tour_days' ); ?></div>
</div>
<div class="container">
			<div class="controls span-24" style="text-align: center"><?php echo $this->form->renderField( 'current_prices_note' ); ?></div>
			<div class="controls span-8"><?php echo $this->form->renderField( 'base_price' ); ?></div>
			<div class="controls span-4"><?php echo $this->form->renderField( 'add_for_1' ); ?></div>
			<div class="controls span-4"><?php echo $this->form->renderField( 'disc_for_3' ); ?></div>
			<div class="controls span-4"><?php echo $this->form->renderField( 'dinners' ); ?></div>
			<div class="controls span-4 last"><?php echo $this->form->renderField( 'suppers' ); ?></div>
			
</div>		
<div class="container">
			<div><?php echo $this->form->renderField( 'space' ); ?></div>
			<div class="controls span-24" style="text-align: center"><?php echo $this->form->renderField( 'new_prices_note' ); ?></div>
			<div class="controls span-8"><?php echo $this->form->renderField( 'new_base_price' ); ?></div>
			<div class="controls span-4"><?php echo $this->form->renderField( 'new_add_for_1' ); ?></div>
			<div class="controls span-4"><?php echo $this->form->renderField( 'new_disc_for_3' ); ?></div>
			<div class="controls span-4"><?php echo $this->form->renderField( 'new_dinners' ); ?></div>
			<div class="controls span-4 last"><?php echo $this->form->renderField( 'new_suppers' ); ?></div>		
</div>		
		<div class="control-group form-inline">
			<div class="controls"><?php echo $this->form->renderField( 'changed_name' ); ?></div>
		</div>

		<input type="hidden" name="task" value="Prices.save" />
		<input type="submit" style="color: blue; font-weight: bold; padding: 5px 10px; border-radius: 5px;" value="СОЗДАТЬ" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</form>
</div>
<script>
var $j=jQuery.noConflict();
$j("#jform_tour_id").change(setPrice);
$j("[id^='jform_newold']").change(clearPrice);
function setPrice() {
	var arrOfPrices = $j("#jform_tour_id").val().split('/');
	$j("#jform_base_price").val(arrOfPrices[1]);
	$j("#jform_add_for_1").val(arrOfPrices[2]);
	$j("#jform_disc_for_3").val(arrOfPrices[3]);
	$j("#jform_dinners").val(arrOfPrices[4]);
	$j("#jform_suppers").val(arrOfPrices[5]);
	$j("#jform_old_tour_days").val(arrOfPrices[6]);
	$j("#jform_new_base_price").val(arrOfPrices[1]);
	$j("#jform_new_add_for_1").val(arrOfPrices[2]);
	$j("#jform_new_disc_for_3").val(arrOfPrices[3]);
	$j("#jform_new_dinners").val(arrOfPrices[4]);
	$j("#jform_new_suppers").val(arrOfPrices[5]);
}
function clearPrice() { 
	switch (this.value) {
		case "1":	// выбрано 'завести новый тур'
			$j("#jform_new_tour_name").val("").addClass("required").attr({"aria-required":"true", "required":"required"});
			$j("#jform_new_tour_days").val("1").addClass("required").attr({"aria-required":"true", "required":"required"});
			$j("#jform_new_base_price").val("1000");
			$j("#jform_new_add_for_1").val("0");
			$j("#jform_new_disc_for_3").val("0");
			$j("#jform_new_dinners").val("0");
			$j("#jform_new_suppers").val("0");
			$j(":submit").val("СОЗДАТЬ");
			break;
		case "0":	// выбрано 'изменить тур'
			$j("#jform_new_tour_name").removeClass("required").removeAttr("aria-required required");
			$j("#jform_new_tour_days").removeClass("required").removeAttr("aria-required required");
			setPrice();
			$j(":submit").val("ОБНОВИТЬ");
			break;
		case "2":	// выбрано 'удалить тур'
			$j("#jform_new_tour_name").removeClass("required").removeAttr("aria-required required");
			$j("#jform_new_tour_days").removeClass("required").removeAttr("aria-required required");
			setPrice();
			$j(":submit").val("УДАЛИТЬ");
			break;
	}
}

</script>
