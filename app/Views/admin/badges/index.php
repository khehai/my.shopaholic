<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Badges Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="/admin/badges/create"><button type="button" class="btn btn-sm btn-outline-secondary">New Item</button></a>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button>
        </div>
</div>

<div class="table-responsive">

    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Badge title</th>
                <th scope="col">Badge bg</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($badges as $badge):?>
            <tr>
                <td><?=$badge->id?></td>
                <td><?=$badge->title?></td>
                <td><?=$badge->bg?></td>
                <td>
                    <a href="/admin/badges/edit/<?=$badge->id?>"><button class="btn btn-warning">Edit</button></a>
                    <form action="/admin/badges/destroy/<?=$badge->id?>" method="POST" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?=$badge->id?>">
          
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>

