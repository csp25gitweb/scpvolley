<?php
/* Smarty version 3.1.30, created on 2018-05-22 11:44:17
  from "/home/csp37/public_html/scpvolley/templates/home.home.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b03e671dbfe16_83990754',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f9ba20c9e809f6de063fecf94bba76b1c400077' => 
    array (
      0 => '/home/csp37/public_html/scpvolley/templates/home.home.html',
      1 => 1526982253,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:home.header.html' => 1,
    'file:home.footer.html' => 1,
  ),
),false)) {
function content_5b03e671dbfe16_83990754 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->_subTemplateRender("file:home.header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<!-- JUMBOTRON -->
	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-12 text-center">
					<h1>Bienvenue au Sporting Club de Plaisance Section Volley-Ball</h1>
					<p>Créée en 1987, la section volley-ball représente le seul sport avec ballon de l’association. Le club se classe dans les 5 premiers Clubs de Volley-Ball de la région, avec un effectif actuel supérieur à 100 joueurs. Il engage des équipes compétitions filles et garçons dans quasiment toutes les catégories, ainsi que des équipes loisirs. Il accueille les joueurs et les joueuses à partir de 5 ans. Pour la saison 2017-2018, la section à obtenu le label de club formateur Futur de la FFBV.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- JUMBOTRON fin -->
	
	<!-- MAIN CONTAINER -->
	<div class="container">
	
		<!-- CAROUSEL ACTUALITES -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2>Actualités du club</h2>
			</div>
			
			<div class="panel-body">
				<div id="carousel_actualites" class="carousel slide">
					<ol class="carousel-indicators">
						<li data-target="#carousel_actualites" data-slide-to="0" class="active"></li>
						<li data-target="#carousel_actualites" data-slide-to="1" class=""></li>
						<li data-target="#carousel_actualites" data-slide-to="2" class=""></li>
					</ol>
					<div class="carousel-inner">
						<div class="item active">
							<a href="#"><img class="img-responsive" src="images/photo1.jpg" alt=""></a>
							<div class="carousel-caption scp_carousel_caption">
								<h3><a href="#">Titre actualité</a></h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac vulputate quam, ut iaculis lectus. Ut quis nisi venenatis, facilisis velit vel, pellentesque magna.</p>
							</div>
						</div>
						<div class="item">
							<a href="#"><img class="img-responsive" src="images/photo2.jpg" alt=""></a>
							<div class="carousel-caption scp_carousel_caption">
								<h3><a href="#">Titre actualité 2</a></h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac vulputate quam, ut iaculis lectus. Ut quis nisi venenatis, facilisis velit vel, pellentesque magna.</p>
							</div>
						</div>
						<div class="item">
							<a href="#"><img class="img-responsive" src="images/photo1.jpg" alt=""></a>
							<div class="carousel-caption scp_carousel_caption">
								<h3><a href="#">Titre actualité 3</a></h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac vulputate quam, ut iaculis lectus. Ut quis nisi venenatis, facilisis velit vel, pellentesque magna.</p>
							</div>
						</div>
					</div>
					
					<a class="left carousel-control" href="#carousel_actualites" data-slide="prev">
						<span class="icon-prev"></span>
					</a>
					
					<a class="right carousel-control" href="#carousel_actualites" data-slide="next">
						<span class="icon-next"></span>
					</a>
				</div>
			</div>
		</div>
		<!-- CAROUSEL ACTUALITES fin -->
		
		<!-- PANEL NOS PARTENAIRES -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3>Nos partenaires</h3>
			</div>
			
			<div class="panel-body">
				<div class="row text-center">
                                    
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['partenaires']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
					<!-- item partenaire -->
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                            <img class="img-circle" src="<?php echo $_smarty_tpl->tpl_vars['value']->value->get_lien_logo();?>
" style="width: 140px; height: 140px;">
						<h4><?php echo $_smarty_tpl->tpl_vars['value']->value->get_titre();?>
</h4>
						<p><?php echo $_smarty_tpl->tpl_vars['value']->value->get_description();?>
</p>
						<p><a class="btn btn-primary" href="#">En savoir plus</a></p>
                                        </div>
                                        <span>&nbsp;</span>
					<!-- item partenaire fin -->
                                         <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				</div>
			</div>
		</div>
		<!-- PANEL NOS PARTENAIRES fin -->
		
	</div>
	<!-- MAIN CONTAINER -->
        
<?php $_smarty_tpl->_subTemplateRender("file:home.footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
