<div class="container-fluid">
	<div class="row-fluid">
		<h2><?php echo JText::_('COM_JOOMLY_FORM_LIST');?></h2> 
			<?php foreach($this->list as $form){ ?>
				<a style="font-size:25px;" href="index.php?option=com_joomlyform&view=form&form=<?php echo $form->form;?>"><?php echo $form->form;?></a><br> 
			<?php }?>
	</div>
</div>
