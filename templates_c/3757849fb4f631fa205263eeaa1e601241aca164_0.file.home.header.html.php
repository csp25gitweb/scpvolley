<?php
/* Smarty version 3.1.30, created on 2018-05-22 11:02:10
  from "/home/csp37/public_html/scpvolley/templates/home.header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b03dc925a2cd8_56048258',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3757849fb4f631fa205263eeaa1e601241aca164' => 
    array (
      0 => '/home/csp37/public_html/scpvolley/templates/home.header.html',
      1 => 1526979680,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b03dc925a2cd8_56048258 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {
echo $_smarty_tpl->tpl_vars['title']->value;
} else { ?>Page - SCP Volley<?php }?></title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="css/bootstrap/theme.css" rel="stylesheet" media="screen">
	<link href="css/styles.css" rel="stylesheet" media="screen">
	<link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
	
	<link href="css/fullcalendar.min.css" rel="stylesheet" media="screen">
</head>

<body>
	
    <!-- MODAL BOX -->
    <div class="modal fade" id="scp_modal">
            <div class="modal-dialog">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <button id="scp_modal_close_button_small" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="scp_modal_title"></h4>
                            </div>
                            <div class="modal-body" id="scp_modal_content">
                            </div>
                            <div class="modal-footer">
                                    <button id="scp_modal_close_button" type="button" class="btn btn-default" data-dismiss="modal"></button>
                                    <button id="scp_modal_valid_button" type="button" class="btn btn-success hidden"></button>
                            </div>
                    </div>
            </div>
    </div>
    <!-- MODAL BOX fin -->

    <!-- MENU NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">

                    <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                            </button>
                            <a href="index.php" class="navbar-left"><img class="margin-top-sm" src="images/logo_scp.png" alt="logo"></a>
                    </div>

                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                            <ul class="nav navbar-nav">
                                    <li><a href="index.php">Accueil</a></li>
                                    <li><a href="#">Actualités</a></li>
                                    <li><a href="index.php?controller=agenda">Agenda</a></li>
                                    <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inscription<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                    <li><a href="#"></a></li>
                                                    <li><a href="#">Modalités</a></li>
                                                    <li><a href="#">FFVB</a></li>
                                                    <li><a href="#">FSGT</a></li>
                                            </ul>
                                    </li>
                                    <li><a href="#">Boutique</a></li>
                                    <li  class="active"><a href="#">Contact</a></li>
                            </ul>
                    </div>

            </div>	
    </nav>
    <!-- MENU NAVBAR fin -->

    <!-- CONTENU -->
    <main class="scp_contenu"><?php }
}
