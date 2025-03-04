<?php /* Smarty version Smarty-3.1.18, created on 2025-03-04 10:12:39
         compiled from "D:\a_project_2024\General\admin\templates\project01\manage\setting.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172515128267b35a8647ee86-17697484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6d1db8861c1abb5514a0b7436c4b63e27fab831' => 
    array (
      0 => 'D:\\a_project_2024\\General\\admin\\templates\\project01\\manage\\setting.tpl',
      1 => 1741057958,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172515128267b35a8647ee86-17697484',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_67b35a864ad833_19260207',
  'variables' => 
  array (
    'domain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_67b35a864ad833_19260207')) {function content_67b35a864ad833_19260207($_smarty_tpl) {?><div class="layout-page">
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-2 top10">
                    <label>Authorize button</label>
                    <button class="form-control btn btn-primary" id="authorize_button">Authorize Google
                        Drive</button>
                </div>
            </div>
            <div class="row">
                <pre id="content_sync_gg_drive"></pre>
            </div>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
</div>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/apis-google.js?"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/js_act/personnel_hidden.js?"></script>
<?php }} ?>
