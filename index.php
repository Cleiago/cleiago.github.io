<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>Cleiago Comics</title>
</head>
<body>
	<nav>
    	<div class="nav-wrapper">
    		<a href="#!" class="brand-logo">CleiAgo COMICS</a>
    		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    		<ul class="right hide-on-med-and-down">
    			<li><a href="sass.html"></a></li>
    			<li><a href="components.html">Components</a></li>
    			<li><a href="javascript.html">Javascript</a></li>
   				<li><a href="mobile.html">Mobile</a></li>
    		</ul>
    		<ul class="side-nav" id="mobile-demo">
    			<li><a href="sass.html">Sass</a></li>
    			<li><a href="components.html">Components</a></li>
    			<li><a href="javascript.html">Javascript</a></li>
    			<li><a href="mobile.html">Mobile</a></li>
    		</ul>
    	</div>
  	</nav>
	<div>
		<h1>Cleiago Comics</h1>
		<?php 
			if(isset($_SESSION["login"])){
				echo "<p><a href=\"cadClientes.php\"><button>Cadastrar Clientes</button></a></p>";
				echo "<p><a href=\"verClientes.php\"><button>Lista de Clientes</button></a></p>";
				echo "<p><a href=\"cadProdutos.php\"><button>Cadastrar Produtos</button></a></p>";
				echo "<p><a href=\"verProdutos.php\"><button>Lista de Produtos</button></a></p>";
			}else{
				echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=index.php\">";
			}
		?>
	</div>
	 <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>