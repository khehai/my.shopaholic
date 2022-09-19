<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="/admin/products/create"><button type="button" class="btn btn-sm btn-outline-secondary">New Item</button></a>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button>
        </div>
</div>

<div class="table-responsive">
    <?php if(count($products) > 0):?>
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product title</th>
                <th scope="col">Product status</th>
                <th scope="col">Product image</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product):?>
            <tr>
                <td><?=$product->id?></td>
                <td><?=$product->title?></td>
                <td><?=$product->status?></td>
                <td><img src="<?=$product->image?>" width=40 height=40></td>
                <td>
                    <a href="/admin/products/edit/<?=$product->id?>"><button class="btn btn-warning">Edit</button></a>
                    <form action="/admin/products/destroy/<?=$product->id?>" method="POST" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?=$product->id?>">
          
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
    <?php else:?>
        <h4>No products yet</h4>
    <?php endif?>
</div>