{foreach from=$menu item=item}
	<div class="col-md-4 col-sm-6 col-xs-6">
		 {if $item.level == 1}
			  <div class="title"><a href="{$item.link}" target="{$item.open_page}" title="{$item.name}">{$item.name}</a></div>
			  {if count($item['root_menu']) > 0} 
					<ul>
						 {foreach from=$item['root_menu'] item=items}
							  {if $items.level == 2}
									<li><a href="{$items.link}" target="{$items.open_page}" title="{$items.name}">{$items.name}</a></li>
							  {/if}    
						 {/foreach}
					</ul>
			  {/if}
		 {/if}
	</div>
{/foreach}