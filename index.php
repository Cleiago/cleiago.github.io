<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <link rel="stylesheet" href="index.css">

	<title>Cleiago Comics</title>

</head>
<body>
	
    <nav>
      <div class="nav-wrapper">
      <a href="#" data-activates="mobile-sidenav" class="button-collapse"><i class="mdi-navigation-menu"></i><span class="controller controller-nav-mobile" id="btRB"></span></a>
        <a class="brand-logo right" href="/">CLEIAGO</a>
        <ul id="nav-mobile" class="light hide-on-med-and-down">
          <span class="controller controller-nav" id="btRB"></span>
          <ul id="dropdown2" class="dropdown-content">
            <li><a href="#!" class="black-text text">Lista Clientes</a></li>
            <li><a href="#!" class="black-text text">Cadastrar Clientes</a></li>
          </ul>
          <span class="controller controller-nav" id="btRB"></span>
          <ul id="dropdown3" class="dropdown-content">
            <li><a href="#!" class="black-text text">Lista Produtos</a></li>
            <li><a href="#!" class="black-text text">Cadastrar Produtos</a></li>
          </ul>
          <a class="red lighten-2 btn dropdown-button" href="#!" data-activates="dropdown2">Clientes<i class= "mdi-navigation-expand-more right"></i></a>
          <a class="red lighten-2 btn dropdown-button" href="#!" data-activates="dropdown3">Produtos<i class= "mdi-navigation-expand-more right"></i></a>
         
        </ul>
        <ul id="mobile-sidenav" class="side-nav">
         <span class="controller controller-nav" id="btRB"></span>
          <ul id="dropdown4" class="dropdown-content">

            
                <li><a href="cadClientes.php" class="black-text text">Cadastrar Clientes</a></li>;
                <li><a href="verClientes.php" class="black-text text">Lista Clientes</a></li>;
              
        

          </ul>
          <span class="controller controller-nav" id="btRB"></span>
          <ul id="dropdown5" class="dropdown-content">
            <li><a href="#!" class="black-text text">Lista Produtos</a></li>
            <li><a href="#!" class="black-text text">Cadastrar Produtos</a></li>
          </ul>
          <a class="white btn dropdown-button" href="#!" data-activates="dropdown4">Clientes<i class= "mdi-navigation-expand-more right"></i></a>
          <a class="white btn dropdown-button" href="#!" data-activates="dropdown5">Produtos<i class= "mdi-navigation-expand-more right"></i></a> 
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
                <h5 class="white-text">CLEIAGO COMICS</h5>
              </div>
              <div class="col l4 offset-l2 s12">
                <ul>
                  <li><a class="grey-text text-lighten-3" target="_blank" href="kombiweb.github.io">Quem somos?</a></li>
                  <li><a class="grey-text text-lighten-3" target="_blank" href="www.google.com.br">Do que sobrevivemos?</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            </div>
          </div>
        </footer>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.parallax').parallax();
    });
    
    
    
      console.debug($(".dropdown-button").dropdown());
      $('.button-collapse').sideNav({
      menuWidth: 300, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: false // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );
      


  </script>
	
</body>
</html>