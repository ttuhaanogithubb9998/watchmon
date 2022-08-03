<?php
// var_dump($categories);
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Create Product</h5>
                    <!-- <small class="text-muted float-end">Default label</small> -->
                </div>
                <div class="card-body">
                    <form action="create" method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="basic-default-name" placeholder="Name Product" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-description">Description</label>
                            <div class="col-sm-10">
                                <textarea id="basic-default-description" class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-price">Price</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input name='price' type="number" placeholder="" id="basic-default-price" class="form-control" aria-label="john.doe" aria-describedby="basic-default-email2" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Stock</label>
                            <div class="col-sm-10">
                                <input name='stock' type="number" id="basic-default-phone" class="form-control phone-mask" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-sale">Price Sale</label>
                            <div class="col-sm-10">
                                <input name="priceSale" type="number" placeholder="%" id="basic-default-sale" class="form-control phone-mask" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-file">Images</label>
                            <div class="col-sm-10">
                                <input accept='image/png, image/jpg' name=files[] type="file" multiple id="basic-default-file" class="form-control phone-mask" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-file">Category</label>
                            <div class="col-sm-10">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">

                                        <?php
                                        foreach ($categories as $category) {
                                        ?>
                                            <label class="list-group-item">
                                                <input value="<?php echo $category['id']?>" class="form-check-input me-1" name='categoriesId[]' type="checkbox"  />
                                                <?php echo $category['name'] ?>
                                            </label>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class=" col-sm-10 mt-3">
                                <input name ="state" class="form-check-input" checked type="checkbox" value='1' id="check-state" />
                                <label class="form-check-label" for="check-state"> State </label>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        <div style="text-align: center;width:100%">
                            <span class="text-<?php echo $type; ?>">
                                <?php echo $message; ?>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>