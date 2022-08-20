<!DOCTYPE html>

<html>
  <head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Shopaholic | Shoppng Cart project</title>
	    <meta name="description" content="Shopaholic - Shoppng Cart project">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="robots" content="all,follow">

	    <!-- Favicon-->
	    <link rel="shortcut icon" href="/icons/favicon.png">
	    <!-- Google fonts-->
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
	    <link rel="stylesheet" href="/css/styles.css">
  </head>

  <body>
    <?php require_once VIEWS.'/layouts/app/icons.php';?>
    <div><!-- page-holder -->
  		<?php require_once VIEWS.'/layouts/app/nav.php';?>
  		<!-- container -->
  	    <div class="container">
  			{{ content }}
  		</div>
  		<?php require_once VIEWS.'/layouts/app/footer.php';?>
	  </div>
    
      <!-- FontAwesome CSS  -->

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
  </body>

</html>