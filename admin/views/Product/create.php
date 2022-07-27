<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Create Product</h5>
                    <small class="text-muted float-end">Default label</small>
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
                                <textarea placeholder="Description" name="description" type="text" class="form-control" id="basic-default-description">
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-price">Price</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="number" placeholder="/1000" id="basic-default-price" class="form-control" aria-label="john.doe" aria-describedby="basic-default-email2" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Stock</label>
                            <div class="col-sm-10">
                                <input type="number" id="basic-default-phone" class="form-control phone-mask" aria-describedby="basic-default-phone" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-sale">Price Sale</label>
                            <div class="col-sm-10">
                                <input type="number" placeholder="%" id="basic-default-sale" class="form-control phone-mask" aria-describedby="basic-default-phone" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-file">Images</label>
                            <div class="col-sm-10">
                                <input type="file" multiple id="basic-default-file" class="form-control phone-mask" aria-describedby="basic-default-phone" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        <div style="text-align: center;width:100%">
                            <span class ="text-<?php echo $type;?>">
                                <?php echo $message; ?>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>