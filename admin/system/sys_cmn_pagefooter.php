<table width="100%" align="right" class="labels">	
	<tr>
		<td width="80%" align="right">
		<?  if ($page > 1) { ?>
					<a href="<?=$msHref?>&page=<?=$page-1?>"> << </a>
			<? } 
		    for ($i = 1; $i <= $pager->numPages; $i++) 
			{  ?>
					| 			
		        <? if ($i == $pager->page)  { ?>
		        		<?=$i?>
				<? } else  { ?>
						<a href="<?=$msHref?>&page=<?=$i?>"> <?=$i?> </a>				
				<? }
			}  
		    if ($page == $pager->numPages) {?>
		    		&nbsp;
		    <? } else { ?>
					<a href="<?=$msHref?>&page=<?=($page + 1);?>"> >>  </a> 	    	
			<? }            
		?>
		</td>
		<td width="10%">&nbsp;</td>
	</tr>
</table>
