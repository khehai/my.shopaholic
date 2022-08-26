<div class="table-responsive">

    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Brand name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brands as $brand):?>
            <tr>
                <td><?=$brand->id?></td>
                <td><?=$brand->name?></td>
                <td>
                    <a href="/admin/brands/edit/<?=$brand->id?>"><button class="btn btn-warning">Edit</button></a>
                    <form action="/admin/brands/destroy/<?=$brand->id?>" method="POST" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?=$brand->id?>">
          
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>