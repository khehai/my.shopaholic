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
<div class="container">
    <div>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <span>Badges</span>
            </div>
        </div>
        <div class="col-md-7 col-lg-8">
            <h4>Edit badge</h4>
            <form class="needs-validation" method="POST" action="/admin/badges/update">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Badge Name:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="title" placeholder="Enter badge Name" value="<?=$badge->title?>">
                        <div class="invalid-feedback">
                            badge title is required!
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Badge Background:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="bg" value="<?=$badge->bg?>">
                        <div class="invalid-feedback">
                            badge bg is required!
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>

