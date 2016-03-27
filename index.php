<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>SIRGLAB Umariana Login</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="styles/login2.css" />
    <link rel="stylesheet" href="styles/login.css" />
    
  </head>
  <?php include 'header.php';?>
    <body>
        <br/>
        <br/>
    <div class="wrapper">
        <form class="login" action="includes/process_login.php" method="post" name="login_form">  
    <p class="title">Inicio Sesion</p>
    <input type="text" name="email" placeholder="Correo" autofocus/>
    <i class="fa fa-user"></i>
    <input type="password" name="password" placeholder="Contraseña" />
    <i class="fa fa-key"></i>
    <a href="#">No recuerda su contraseña comuniquese con el admin</a>
   <button onclick="formhash(this.form, this.form.password);">
      <i class="spinner"></i>
      <span class="state">Log in</span>
    </button>
  </form>
  </p>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
