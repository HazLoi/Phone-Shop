<?php /* Smarty version Smarty-3.1.18, created on 2024-01-22 13:43:24
         compiled from "D:\a_project_2024\phone_shop\web\templates\project01\menu\menu_top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29853008365acf37bab8686-34764011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbaa3950bceb90ca2052a3e7b268cd170aa5bfcc' => 
    array (
      0 => 'D:\\a_project_2024\\phone_shop\\web\\templates\\project01\\menu\\menu_top.tpl',
      1 => 1705905803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29853008365acf37bab8686-34764011',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_65acf37baf0848_22682603',
  'variables' => 
  array (
    'menu' => 0,
    'item' => 0,
    '_SERVER' => 0,
    'tpldirect' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65acf37baf0848_22682603')) {function content_65acf37baf0848_22682603($_smarty_tpl) {?><ul>
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
		<?php if ($_smarty_tpl->tpl_vars['item']->value['level']==1) {?>
			<li class="<?php if ($_smarty_tpl->tpl_vars['_SERVER']->value['REQUEST_URI']==$_smarty_tpl->tpl_vars['item']->value['link']) {?>active<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" target="<?php echo $_smarty_tpl->tpl_vars['item']->value['open_page'];?>
">
					<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

					<?php if (isset($_smarty_tpl->tpl_vars['item']->value['root_menu'])) {?>
						<?php if (count($_smarty_tpl->tpl_vars['item']->value['root_menu'])>0) {?>
							<i class="fa fa-angle-down"></i>
						<?php }?>
					<?php }?>
				</a>
				<?php if (isset($_smarty_tpl->tpl_vars['item']->value['root_menu'])) {?>
					<?php if (count($_smarty_tpl->tpl_vars['item']->value['root_menu'])>0) {?>
						<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpldirect']->value)."menu/menu_sub.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('l'=>$_smarty_tpl->tpl_vars['item']->value['root_menu']), 0);?>

					<?php }?>
				<?php }?>
			</li>
		<?php }?>
	<?php } ?>
</ul><?php }} ?>
