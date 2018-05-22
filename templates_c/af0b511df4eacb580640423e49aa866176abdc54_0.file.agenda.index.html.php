<?php
/* Smarty version 3.1.30, created on 2018-05-22 11:04:30
  from "/home/csp37/public_html/scpvolley/templates/agenda.index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b03dd1e7bd2e3_60847139',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af0b511df4eacb580640423e49aa866176abdc54' => 
    array (
      0 => '/home/csp37/public_html/scpvolley/templates/agenda.index.html',
      1 => 1526979680,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:home.header.html' => 1,
    'file:home.footer.html' => 1,
  ),
),false)) {
function content_5b03dd1e7bd2e3_60847139 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:home.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<main class="scp_contenu">
    <div class="container">
        <h1>Agenda</h1>
        <div id='calendar'>
        </div>
    </div>
</main>

<?php $_smarty_tpl->_subTemplateRender("file:home.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
