<div class="container">
    <div>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <span>Brands</span>
            </div>

        </div>
        <div class="col-md-7 col-lg-8">
            <h4>Edit brand</h4>
            <form class="needs-validation" method="POST" action="/admin/brands/update">
            <input type="hidden" name="id" value="<?=$brand->id?>">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Brand Name:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" value="<?=$brand->name?>">
                        <div class="invalid-feedback">
                            Brand name is required!
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Brand Description:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="description" value="<?=$brand->description?>">
                        <div class="invalid-feedback">
                            Brand description is required!
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
  