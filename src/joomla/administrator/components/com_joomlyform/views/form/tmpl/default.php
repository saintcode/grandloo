<?php
if (isset($_GET['page']))
	{
		$CurrentPage = $_GET['page'];
	} else{
		$CurrentPage = 1;
	}
$PreviousPage = $CurrentPage-1;
$NextPage = $CurrentPage+1;
$form = JRequest::getVar('form'); 
?>
<div class="container-fluid">
	<div class="row-fluid">
		<p class="text-right"><a href="<?php echo JURI::base();?>index.php?option=com_joomlyform&view=list" class="text-right"><?php echo JText::_('COM_JOOMLY_FORM_BACK_LIST');?></a></p>	
		<h2><?php echo JText::_('COM_JOOMLY_FORM').": ".JRequest::getVar('form');?></h2> 
		<table id="myTable" class="table "> 
			<thead> 
				<tr> 
					<th>id</th>
					<th><?php echo JText::_('COM_JOOMLY_FORM_DATE');?></th>
					<th><?php echo JText::_('COM_JOOMLY_FORM_SITE_PAGE');?></th>
					<th>IP</th>
					<?php if (count($this->captions)>0){
							foreach ($this->captions as $caption){
								echo "<th>".$caption."</th>";
							}		
					}?>
					<th></th>	
					<th></th>
				</tr> 
			</thead>
			<tbody>
				<?php foreach($this->list as $feed){ ?>
					<tr <?php if ($feed->read == 1){echo 'class="read"';};?>>
						<?php foreach($feed as $key=>$v){
							if ($key !== 'read'){
								echo '<td>'.substr($v, 0, 30).'</td>';
							}	
						}?>
						<td><a href="index.php?option=com_joomlyform&view=feedback&form=<?php echo $form;?>&id=<?php echo $feed->id;?>"><?php echo JText::_('COM_JOOMLY_FORM_OPEN');?></a></td>
						<td><i class="icon-trash delete_class" id="<?php echo $feed->id;?>"></i></td>
					</tr>
				<?php }
				?>
				</tr>
			</tbody>	
		</table>	
		<div>
			<ul class="pager">
				<li><a href="index.php?option=com_joomlyform&view=form&form=<?php echo $form;?>&page=<?php echo $PreviousPage;?>" class="previous"><?php echo JText::_('COM_JOOMLY_FORM_PREVIOUS');?></a></li>
				<li><a href="index.php?option=com_joomlyform&view=form&form=<?php echo $form;?>&page=<?php echo $NextPage;?>" class="next"><?php echo JText::_('COM_JOOMLY_FORM_NEXT');?></a></li>
			</ul>
		</div>	
	</div>
</div>
<script>
(function( $ ) {
	$( document ).ready(function() {
		var current = <?php echo $CurrentPage;?>;
		if (current==1){
			$(".previous").addClass( "disabled" );
			$('.previous').click(function() { return false; });
		}	
		var max = <?php echo $this->MaxPage;?>;
		if (current>= max){
			$(".next").addClass( "disabled" );
			$('.next').click(function() { return false; });
		}	
		
	});
	$( ".delete_class" ).click(function() {
		var con = confirm( "Delete this feed?" );
		if (con == true){
			//$(this).tooltip('hide');
			$(this).parents('tr').remove();
			var del_id = $(this).attr('id');
			var table = "#__joomly_<?php echo $form;?>";
			console.log(table);
			$.ajax({
			  type:'POST',
			  url:'index.php?option=com_joomlyform&task=deletefeed',
			  data:{delete_id: del_id, table: table},
			  success:function(data) {
				if(data) { 
				} else {  }
			   }
			});
		}   
	});
})(jQuery);
</script>