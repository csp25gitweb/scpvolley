<?php
/* Smarty version 3.1.30, created on 2018-05-15 09:08:24
  from "C:\xampp\htdocs\s_dev\test\scpvolley\templates\admin.adherent.form.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5afa876874bbe5_16454749',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c5f7f0f2511e4cf2e2e291693d8986a7fa5bb2bb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\s_dev\\test\\scpvolley\\templates\\admin.adherent.form.html',
      1 => 1526309335,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5afa876874bbe5_16454749 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['adherent']->value->get_id_adherent() != -1) {?>
<input id='ad_delete' name='ad_delete' type='button' value='Supprimer cet adhérent'>
<?php }?>

<form id='ad_form' method="POST" action="">
    <input type='hidden' name='form_post' value='1'>
    <input type='hidden' name='ad_id_adherent' value='<?php echo $_smarty_tpl->tpl_vars['adherent']->value->get_id_adherent();?>
'>
    <label name='nom'>
        <p>Nom</p>
        <input type='text' name='ad_nom' id='ad_nom' value='<?php echo $_smarty_tpl->tpl_vars['adherent']->value->get_nom();?>
'>
    </label>

    <label name='prenom'>
        <p>Prénom</p>
        <input type='text' name='ad_prenom' id='ad_prenom' value='<?php echo $_smarty_tpl->tpl_vars['adherent']->value->get_prenom();?>
'>
    </label>

    <label name='naissance'>
        <p>Date de naissance</p>
        <input type='date' name='ad_naissance' id='ad_naissance' value='<?php echo $_smarty_tpl->tpl_vars['adherent']->value->get_date_naissance();?>
'>
    </label>
    
    <label name='genre'>
        <p>Genre</p>
        <label><input type='radio' name='ad_genre' id='ad_genre' value='M' <?php if ($_smarty_tpl->tpl_vars['adherent']->value->get_genre() == 'M') {?>checked<?php }?>>Homme</label>
        <label><input type='radio' name='ad_genre' id='ad_genre' value='F' <?php if ($_smarty_tpl->tpl_vars['adherent']->value->get_genre() == 'F') {?>checked<?php }?>>Femme</label>
    </label>
    
    <label name='licence'>
        <p>Numéro de licence</p>
        <input type='text' name='ad_licence' id='ad_licence' value='<?php echo $_smarty_tpl->tpl_vars['adherent']->value->get_no_licence();?>
'>
    </label>
    
    <br/>
    <br/>
    <input type='button' id='ad_valider' value='Valider'>
</form>
<?php }
}
