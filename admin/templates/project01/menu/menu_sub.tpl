<ul class="sub">
    {foreach from=$l item=items}
        <li class="{if count($items['root_menu'])>0}li-sub{/if}">
            <a href="{$items.link}" target="{$items.open_page}" title="{$items.name}">{$items.name}
                {if count($items['root_menu'])>0}
                    <i class="fa fa-angle-right"></i>
                {/if}
            </a>
            {if count($items['root_menu'])>0}
                <ul class="sub">
                    {foreach from=$items['root_menu'] item=itemss}
                        <li>
                            <a href="{$itemss.link}" target="{$itemss.open_page}" title="{$itemss.name}">{$itemss.name}</a>
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </li>
    {/foreach}
</ul>