<?php /* Smarty version Smarty-3.1.18, created on 2025-02-17 22:37:43
         compiled from "D:\a_project_2024\General\admin\templates\project01\menu\menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1639677567a8532b8a1f24-21421372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f13327927e220020f2c7de843066430bbfead513' => 
    array (
      0 => 'D:\\a_project_2024\\General\\admin\\templates\\project01\\menu\\menu.tpl',
      1 => 1739765179,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1639677567a8532b8a1f24-21421372',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_67a8532b92c234_29246363',
  'variables' => 
  array (
    'domain' => 0,
    'lPermission' => 0,
    'm' => 0,
    'item' => 0,
    'act' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67a8532b92c234_29246363')) {function content_67a8532b92c234_29246363($_smarty_tpl) {?><aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="/" class="d-flex">
			<div class="logo">
				<a href="/">
					<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
public/images/favicon-removebg-preview.png" width="70px" height="70px" alt="">
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
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lPermission']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
			<li class="menu-item <?php if ($_smarty_tpl->tpl_vars['m']->value==$_smarty_tpl->tpl_vars['item']->value['m']) {?>active open<?php }?>">
				<a href="javascript:void(0);" class="menu-link menu-toggle">
					<i class="menu-icon <?php echo $_smarty_tpl->tpl_vars['item']->value['icon'];?>
"></i>
					<div><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</div>
				</a>
				<?php if (count($_smarty_tpl->tpl_vars['item']->value['subItems'])>0) {?>
					<ul class="menu-sub">
						<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['subItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
							<li class="menu-item <?php if ($_smarty_tpl->tpl_vars['act']->value==$_smarty_tpl->tpl_vars['value']->value['act']) {?>active<?php }?>">
								<a href="/a-<?php echo $_smarty_tpl->tpl_vars['value']->value['url_domain'];?>
" class="menu-link">
									<div><?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
</div>
								</a>
							</li>
						<?php } ?>
					</ul>
				<?php }?>
			</li>
		<?php } ?>
		
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
		
	</ul>
</aside>

<?php }} ?>
