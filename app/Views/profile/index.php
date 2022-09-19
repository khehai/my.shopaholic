<section class="py-5">
  <div class="container p-0">
    <div class="row">
      <div class="col-lg-3 mb-5 mb-lg-0">
        <!-- SHOP SIDEBAR-->
        <?php require_once VIEWS.'/profile/_profile.php'; ?>
      </div>
        <!-- SHOP LISTING-->
        <div class="col-lg-9 mb-5 mb-lg-0">
        <section class="pt-2">
            <header class="text-center">
              <p class="small text-muted small text-uppercase mb-1">User Profile</p>
                <h2 class="h5 text-uppercase mb-4"><?=$user->first_name ." ".$user->last_name?></h2>
                
            </header>
          </section>
            <div class="row">
              
                <?php require_once VIEWS.'/layouts/_flash-message.php'; ?>                            
            </div>
        </div>
    </div>
  </div>
</section>

