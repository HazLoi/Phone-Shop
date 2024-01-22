<?php /* Smarty version Smarty-3.1.18, created on 2024-01-22 14:50:17
         compiled from "D:\a_project_2024\phone_shop\web\templates\project01\menu\menu_sub.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195886597165ae1e39455830-58176957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9921cd60e0c4b0d6275ec9249c487e1463e4db91' => 
    array (
      0 => 'D:\\a_project_2024\\phone_shop\\web\\templates\\project01\\menu\\menu_sub.tpl',
      1 => 1705909233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195886597165ae1e39455830-58176957',
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
  'unifunc' => 'content_65ae1e394d4ca2_52181042',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_65ae1e394d4ca2_52181042')) {function content_65ae1e394d4ca2_52181042($_smarty_tpl) {?><ul class="sub">
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
