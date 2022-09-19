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
            <?php require_once VIEWS.'/layouts/_flash-message.php'; ?>
  			    {{content}}
  		  </div>
  		<?php require_once VIEWS.'/layouts/app/footer.php';?>
	  </div>
	  <div class="modal" id="login" tabindex="-1">
        <div class="modal-dialog">
          <div class="form-signin">
            <form>
              <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Password</label>
              </div>

              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" name="remember" value="remember-me">Remember me
                </label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
              <a href="#" class="w-100 btn btn-lg btn-secondary close">Cansel</a>
              <p class="mt-5 mb-3 text-muted">© 2022</p>
            </form>
          </div>
        </div>
      </div>
	  
			<div class="modal" id="register" tabindex="-1">
        <div class="modal-dialog">
          <div class="form-signin">
            <form>
              <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

              <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Password</label>
              </div>
              <div class="form-floating">
                <input type="password" name="confirmpassword" class="form-control" id="floatingConfirmPassword">
                <label for="floatingConfirmPassword">Confirm Password</label>
              </div>
              
              <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
              <a href="#" class="w-100 btn btn-lg btn-secondary close">Cansel</a>
              <p class="mt-5 mb-3 text-muted">© 2022</p>
            </form>
          </div>
        </div>
      </div>
	  <script src="/js/main.js"></script>
	  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>