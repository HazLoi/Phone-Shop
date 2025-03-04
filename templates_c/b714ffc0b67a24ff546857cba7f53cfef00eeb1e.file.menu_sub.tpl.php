<?php /* Smarty version Smarty-3.1.18, created on 2025-02-17 22:37:38
         compiled from "D:\a_project_2024\General\web\templates\project01\menu\menu_sub.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110526681667b357c29b7b63-84645163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b714ffc0b67a24ff546857cba7f53cfef00eeb1e' => 
    array (
      0 => 'D:\\a_project_2024\\General\\web\\templates\\project01\\menu\\menu_sub.tpl',
      1 => 1705909233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110526681667b357c29b7b63-84645163',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'l' => 0,
    'items' => 0,
    'itemss' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_67b357c29e0626_22574450',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67b357c29e0626_22574450')) {function content_67b357c29e0626_22574450($_smarty_tpl) {?><ul class="sub">
    <?php  $_smarty_tpl->tpl_vars['items'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['items']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['l']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['items']->key => $_smarty_tpl->tpl_vars['items']->value) {
$_smarty_tpl->tpl_vars['items']->_loop = true;
?>
        <li class="<?php if (count($_smarty_tpl->tpl_vars['items']->value['root_menu'])>0) {?>li-sub<?php }?>">
            <a href="<?php echo $_smarty_tpl->tpl_vars['items']->value['link'];?>
" target="<?php echo $_smarty_tpl->tpl_vars['items']->value['open_page'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['items']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['items']->value['name'];?>

                <?php if (count($_smarty_tpl->tpl_vars['items']->value['root_menu'])>0) {?>
                    <i class="fa fa-angle-right"></i>
                <?php }?>
            </a>
            <?php if (count($_smarty_tpl->tpl_vars['items']->value['root_menu'])>0) {?>
                <ul class="sub">
                    <?php  $_smarty_tpl->tpl_vars['itemss'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itemss']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value['root_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itemss']->key => $_smarty_tpl->tpl_vars['itemss']->value) {
$_smarty_tpl->tpl_vars['itemss']->_loop = true;
?>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['itemss']->value['link'];?>
" target="<?php echo $_smarty_tpl->tpl_vars['itemss']->value['open_page'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['itemss']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemss']->value['name'];?>
</a>
                        </li>
                    <?php } ?>
                </ul>
            <?php }?>
        </li>
    <?php } ?>
</ul><?php }} ?>
