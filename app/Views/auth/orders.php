<section class="py-5">

  <div class="container p-0">
    <div class="row">
      <?php require_once VIEWS.'/profile/_profile.php'; ?>
        <div class="col-lg-9 mx-3 mb-lg-0">
          
          <section class="pt-2">
            <header class="text-center">
              <p class="small text-muted small text-uppercase mb-1">Обработка заказов</p>
                <h2 class="h5 text-uppercase mb-4">Мои заказы</h2>
                <?php if(count($orders)>0):?>
                  <h2 class='mb-2 mb-lg-0'>Количество заказов <?=count($orders)?></h2>
                <?php else:?>
                  <h2 class='mb-2 mb-lg-0'>No Orders yet</h2>
                <?php endif;?>
            </header>
          </section>

          <div class="row mt-3">
            <?php if(count($orders)>0):?>
            <table>
              <thead>
                <tr>
                  <th scope="col">Order</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($orders as $order):?>
                  <tr>
                  <td><?=$order->id?></td>
                  <td><?=$order->formated_date?></td>
                  <td><?=$order->status?></td>
                  <td><a title="Show order" href="/profile/orders/view/<?=$order->id;?>"><button class="btn btn-warning">View</button></a>
                    <a title="Check Order" href="/profile/orders/check/<?= $order->id;?>"><button class="btn btn-danger">Check out</button></a></td>
                </tr>
              <?php endforeach;?>
              </tbody>
            </table>
              <?php endif;?>
          </div>

        </div>          

    </div>
    <div class="row">
          <?php require_once VIEWS.'/layouts/partials/_flash-message.php'; ?>                          
    </div>
    
  </div>
 
</section>