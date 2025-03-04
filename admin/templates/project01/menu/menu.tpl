<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="/" class="d-flex">
			<div class="logo">
				<a href="/">
					<img src="{$domain}public/images/favicon-removebg-preview.png" width="70px" height="70px" alt="">
				</a>
			</div>
			<div class="mt-3">
				<h4>Hello World</h4>
			</div>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">Menu</span>
		</li>
		{foreach from=$lPermission item=item}
			<li class="menu-item {if $m==$item['m']}active open{/if}">
				<a href="javascript:void(0);" class="menu-link menu-toggle">
					<i class="menu-icon {$item['icon']}"></i>
					<div>{$item['title']}</div>
				</a>
				{if count($item['subItems']) > 0}
					<ul class="menu-sub">
						{foreach from=$item['subItems'] item=value}
							<li class="menu-item {if $act==$value['act']}active{/if}">
								<a href="/a-{$value['url_domain']}" class="menu-link">
									<div>{$value['title']}</div>
								</a>
							</li>
						{/foreach}
					</ul>
				{/if}
			</li>
		{/foreach}
		{* Quản lý nhân viên *}
		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">Nhân viên</span>
		</li>
		<li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons bx bx-dock-top"></i>
				<div >Account Settings</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item">
					<a href="pages-account-settings-account.html" class="menu-link">
						<div >Account</div>
					</a>
				</li>
				<li class="menu-item">
					<a href="pages-account-settings-notifications.html" class="menu-link">
						<div >Notifications</div>
					</a>
				</li>
				<li class="menu-item">
					<a href="pages-account-settings-connections.html" class="menu-link">
						<div >Connections</div>
					</a>
				</li>
			</ul>
		</li>
		{* Quản lý nhân viên *}

		{* Quản lý khách hàng *}
		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">Khách hàng</span>
		</li>
		<li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons bx bx-dock-top"></i>
				<div >Account Settings</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item">
					<a href="pages-account-settings-account.html" class="menu-link">
						<div >Account</div>
					</a>
				</li>
				<li class="menu-item">
					<a href="pages-account-settings-notifications.html" class="menu-link">
						<div >Notifications</div>
					</a>
				</li>
				<li class="menu-item">
					<a href="pages-account-settings-connections.html" class="menu-link">
						<div >Connections</div>
					</a>
				</li>
			</ul>
		</li>
		{* Quản lý khách hàng *}
	</ul>
</aside>

