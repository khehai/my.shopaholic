 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Roles Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="/admin/roles/create"><button type="button" class="btn btn-sm btn-outline-secondary">New Item</button></a>
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
        <div class="col-md-7 col-lg-8">
            <h4>Create new role</h4>
            <form class="needs-validation" method="POST" action="/admin/roles/store" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Role Name:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" placeholder="Enter role Name">
                        <div class="invalid-feedback">
                            role name is required!
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