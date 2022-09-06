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
<div class="container">
    <div>    
        <div class="col-md-7 col-lg-8">
            <h4>Create new product</h4>
            <form class="needs-validation" method="POST" action="/admin/products/store" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="form-label">Product Title:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="title" placeholder="Enter product Name">
                        <div class="invalid-feedback">
                            product title is required!
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Product Price:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="price" placeholder="Enter product price">
                        <div class="invalid-feedback">
                            product price is required!
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="form-label">Product Brand:</label>
                    <select class="input-select" name="brand_id">
                        <option value="">Choose...</option>
                        <?php foreach ($brands as $brand):?>
                            <option value="<?=$brand->id?>"><?=$brand->name?></option>
                        <?php endforeach?>
                        <div class="invalid-feedback">
                            Product brand is required!
                        </div>
                    </select>
                </div>
                <div class="col-sm-6">
                <label class="form-label">Product Category:</label>
                    <select class="input-select" name="category_id">
                        <option value="">Choose...</option>
                        <?php foreach ($categories as $category):?>
                            <option value="<?=$category->id?>"><?=$category->name?></option>
                        <?php endforeach?>
                        <div class="invalid-feedback">
                            Product category is required!
                        </div>
                    </select>
                </div>
            </div>
            <hr class="my-4">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="form-label">Product Badge:</label>
                    <select class="input-select" name="badge_id">
                        <option value="">Choose...</option>
                        <?php foreach ($badges as $badge):?>
                            <option value="<?=$badge->id?>"><?=$badge->title?></option>
                        <?php endforeach?>
                        <div class="invalid-feedback">
                            Product badge is required!
                        </div>
                    </select>
                </div>
                <div class="col-sm-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="status">
                        <label class="form-check-label"> Active</label>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row g-3">
                <label class="form-label">Product description</label>
                <textarea class="form-controll" name="description"></textarea>
            </div>
            
            <hr class="my-4">
            <div class="row g-3">
                <label class="form-label">Choose a File</label>
                <input type="file" class="form-control" name="image">
            </div>
            
            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Create</button>
            </form>
        </div>
    </div>
</div>
