<section class="py-5">
    <div class="container p-0">
        <div class="row">
            <?php require_once VIEWS.'/profile/_profile.php'; ?>
            <div class="col-lg-9 order-1 order-lg-2 mb-5 mx-3 mb-lg-0">
                <section class="pt-2">
                    <header class="text-center">
                        <h2 class="h5 text-uppercase mb-4">Детали заказа <?=$order->id?></h2>
                        <dt>Дата заказа: <?=$order->order_date?>
                        <dt>Статус: <?=$order->status;?>
                        <h2 class='mb-5 mt-3 mb-lg-0'>Товары в заказе</h2>
                    </header>
                </section>
                
                <div class="row mt-3">
                    <table>
                      <thead>
                        <tr>
                          <th scope="col">Image</th>
                          <th scope="col">Товар</th>
                          <th scope="col">Status</th>
                          <th scope="col">Цена</th>
                          <th scope="col">Amount</th>
                          
                        </tr>
                      </thead>

                      <tbody>
                       
                        <?php foreach((array)$products as $product):?>
                          <tr>
                              <td><img src="<?=$product['image'];?>" width=200 class="img-fluid"></td>
                              <td><?=$product['name']?></td>
                              <td><?=$order->status?></td>
                              <td><?=$product['price'];?></td>
                              <td><?=$product['amount'];?></td>
                          </tr>
                          
                        <?php endforeach;?>

                          <tr>
                              <th colspan="5">Сумма заказа: <?='' . $total.' грн';?></th>
                          </tr>

                      </tbody>
                    </table>
                </div>
                    
            </div>
        </div>

        <div class="row">
           <?php require_once VIEWS.'/layouts/partials/_flash-message.php'; ?>
        </div>
    </div>
        
</section>