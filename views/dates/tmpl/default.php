<?php
/** @var $this Tours_InfoViewDates */
defined( '_JEXEC' ) or die; // No direct access
?>
<div class="item-page">
	<h2>Добавление и удаление дат в туре</h2>

	<form action="<?php echo JRoute::_( 'index.php?view=Dates' ) ?>" method="post" class="form-validate">

		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel( 'newold' ); ?></div>
			<div class="controls"><?php echo $this->form->getInput( 'newold' ); ?></div>
		</div>
		<div class="controls"><?php echo $this->form->renderField( 'tour_id' ); ?></div>
		<div class="controls"><?php echo $this->form->renderField( 'dates' ); ?></div>
		<div>&nbsp;</div>
		<div class="controls"><?php echo $this->form->renderField( 'date_start' ); ?></div>

		<input type="hidden" name="task" value="Dates.save" />
		<input type="submit" style="color: blue; font-weight: bold; padding: 5px 10px; border-radius: 5px;" value="Добавить новые даты" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</form>
</div>
<script>
var $j=jQuery.noConflict();
$j("#jform_tour_id").css({"font-style": "italic"});
$j("#jform_dates").css({"font-family": "monospace", "font-weight": "bold;"});
$j("#jform_dates").attr("size", "12");
$j("[id^='jform_newold']").change(textonbutton);
function textonbutton() { 
	switch (this.value) {
		case "1":
			$j(":submit").val("Добавить новые даты");
			break;
		case "0":
			$j(":submit").val("Удалить выбранные даты");
			break;
	}
}
</script>
