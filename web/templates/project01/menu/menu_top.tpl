<ul>
	{foreach from=$menu item=item}
		{if $item.level == 1}
			<li class="{if $_SERVER['REQUEST_URI'] == $item.link}active{/if}">
				<a href="{$item.link}" title="{$item.name}" target="{$item.open_page}">
					{$item.name}
					{if isset($item['root_menu'])}
						{if count($item['root_menu'])>0}
							<i class="fa fa-angle-down"></i>
						{/if}
					{/if}
				</a>
				{if isset($item['root_menu'])}
					{if count($item['root_menu'])>0}
						{include file="`$tpldirect`menu/menu_sub.tpl" l=$item['root_menu']}
					{/if}
				{/if}
			</li>
		{/if}
	{/foreach}
</ul>