<?php
// var_dump($userEdit);
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit User</h5>
                    <!-- <small class="text-muted float-end">Default label</small> -->
                </div>
                <div class="card-body">
                    <form action="edit" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $userEdit['id']; ?>" />
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-userName">UserName</label>
                            <div class="col-sm-10">
                                <p><?php echo $userEdit['userName']; ?></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                            <div class="col-sm-10">
                                <input value="<?php echo $userEdit['name']; ?>" type="text" class="form-control" name="name" id="basic-default-name" placeholder="" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-password">Password</label>
                            <div class="col-sm-10">
                                <input value="" type="text" class="form-control" name="password" id="basic-default-password" placeholder="" />
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-address">Address</label>
                            <div class="col-sm-10">
                                <input value="<?php echo $userEdit['address']; ?>" type="text" class="form-control" name="address" id="basic-default-address" placeholder="" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                            <div class="col-sm-10">
                                <input value="<?php echo $userEdit['email']; ?>" type="email" class="form-control" name="email" id="basic-default-email" placeholder="" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone</label>
                            <div class="col-sm-10">
                                <input value="<?php echo $userEdit['phone']; ?>" type="text" class="form-control" name="phone" id="basic-default-phone" placeholder="" />
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-file">Images</label>
                            <div class="col-sm-10">
                                <input  accept='image/png, image/jpg' name=image type="file" multiple id="basic-default-file" class="form-control phone-mask" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class=" col-sm-10 mt-3">
                                <input name ="state" class="form-check-input" checked type="checkbox" value='1' id="check-state" />
                                <label class="form-check-label" for="check-state"> State </label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class=" col-sm-10 mt-3">
                                <input  name ="isAdmin" class="form-check-input"  type="checkbox" value='1' id="check-isAdmin" />
                                <label class="form-check-label" for="check-isAdmin">  Admin </label>
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