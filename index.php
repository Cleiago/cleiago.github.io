<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>Cleiago Comics</title>
</head>
<body>
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="#!">Cadastrar Clientes</a></li>
    <li class="divider"></li>
    <li><a href="#!">Lista Clientes</a></li>
  </ul>
  <ul id="dropdown2" class="dropdown-content">
    <li><a href="#!">Cadastrar Produtos</a></li>
    <li class="divider"></li>
    <li><a href="#!">Lista Produtos</a></li>
  </ul>
	<nav>
    	<div class="nav-wrapper">
    		<a href="#!" class="brand-logo right">CLEIAGO COMICS</a>
    		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    		<ul class="light hide-on-med-and-down">
    			<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Clientes<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Produtos<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
    		</ul>
    		<ul class="side-nav" id="mobile-demo">
    			<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Clientes<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Produtos<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
    		</ul>
    	</div>
  	</nav>
	<div>

  <div class="parallax-container">
    <div class="parallax"><img src="images/imeg1.jpg"></div>
  </div>
  <div class="section white">
    <div class="row container">
      <h2 class="header">CLEIAGO COMICS</h2>
      <p class="grey-text text-darken-3 lighten-3">Tudo em Games e  HQ's, para a compra e locação </p>
    </div>
  </div>
  <div class="parallax-container">
    <div class="parallax"><img src="images/imeg2.jpg"></div>
  </div>

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
  <?php 
    if(isset($_SESSION["login"])){
      echo "<p><a href=\"logout.php\"><button>Log Out</button></a></p>";
      echo "<p><a href=\"cadClientes.php\"><button>Cadastrar Clientes</button></a></p>";
      echo "<p><a href=\"verClientes.php\"><button>Lista de Clientes</button></a></p>";
      echo "<p><a href=\"cadProdutos.php\"><button>Cadastrar Produtos</button></a></p>";
      echo "<p><a href=\"verProdutos.php\"><button>Lista de Produtos</button></a></p>";
      echo "<p><a href=\"aluga.php\"><button>Empréstimo</button></a></p>";
      echo "<p><a href=\"devolucao.php\"><button>Devolução</button></a></p>";
      echo "<p><a href=\"compra.php\"><button>Compra</button></a></p>";
    }else{
      echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=index.php\">";
    }
  ?>
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('.parallax').parallax();
    });
    
    
      $(".dropdown-button").dropdown();
      


  </script>
	
</body>
</html>