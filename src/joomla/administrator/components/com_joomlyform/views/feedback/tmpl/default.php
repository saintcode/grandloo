<div class="row-fluid">
	<div class="row-fluid">
		<div>
			<div class="span6">
				<h2><?php echo JText::_('COM_JOOMLY_FORM_FEEDBACK');?></h2>
			</div>	
			<div class="span6">
				<p class="text-right"><a href="<?php echo JURI::base();?>index.php?option=com_joomlyform&view=form&form=<?php echo JRequest::getVar('form');?>" class="text-right"><?php echo JText::_('COM_JOOMLY_FORM_BACK_LIST');?></a></p>
			</div>
		</div>
		<div>
			<table id="myTable" class="table table-striped">
				<tbody>			
				<?php 
					$i = 0;
					foreach ($this->feedback as $key=>$value){
					if ($key !== "read"){
						if ($key == "id")
						{
							echo '<tr><th>id:</th><td> '.$value.'</td></tr>';
						} else if ($key == "created_at")
						{
							echo '<tr><th>'.JText::_('COM_JOOMLY_FORM_DATE').':</th><td> '.$value.'</td></tr>';
						} else if ($key == "ip")
						{
							echo '<tr><th>IP:</th><td> '.$value.'</td></tr>';
						} else if ($key == "page")
						{
							echo '<tr><th>'.JText::_('COM_JOOMLY_FORM_SITE_PAGE').':</th><td> '.$value.'</td></tr>';
						} else
						{
							echo '<tr><th>'.$this->captions[$i].':</th><td> '.$value.'</td></tr>';
							$i +=1;
						}
					}
				}?>
				</tbody>
			</table>
		</div>
	</div>
</div>
