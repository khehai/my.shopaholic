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
              <h2 class="h5 text-uppercase mb-4"><?=$user->first_name ." ".$user->last_name?></h2>
              <p class="small text-muted small text-uppercase mb-1">Yours Orders</p>
            </header>
          </section>
            <div class="row">
              
                <?php require_once VIEWS.'/layouts/_flash-message.php'; ?>

                <div class="table-responsive">
                  <?php if (count($orders)>0):?>

                <table class="table table-striped table-sm">
                  <thead>
                    <tr class="bg-primary">
                      <th scope="col">#</th>
                      <th scope="col">Ordered date</th>
                      <th scope="col">Ordered status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($orders as $order):?>
                    <tr>
                      <td><?=$order->id;?></td>
                      <td><?=$order->order_date;?></td>
                      <td><?=$order->status;?></td>
                      <td>
                        <a href="/admin/orders/edit/<?=$order->id?>"><button class="btn btn-warning">Edit</button></a>
                        <form action="/admin/orders/destroy/<?=$order->id?>" method="POST" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?=$order->id?>">
                            <input type="submit" class="btn btn-xs btn-danger" value="delete">
                        </form>
                      </td>
                    </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
              <?php else:?>
                <h2>No orders yet</h2>
              <?php endif?>
              </div>                            
            </div>
        </div>
    </div>
  </div>
</section>