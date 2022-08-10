<?php
$userImgFolder = 'upload/image/user/';
$actionUrl = 'admin/user/';


// var_dump($users);
?>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Users</h5>
            <small class="text-muted float-end"><a href="<?php echo BASE_URL . $actionUrl . 'create' ?>">New User</a></small>
        </div>
        <!-- Search -->
        <div style="padding:10px" class="input-group input-group-merge">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input id="search" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
        </div>
        <!-- /Search -->

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>UserName</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-0"></i> <strong class="username"><?php echo $user['userName'] ?></strong></td>
                            <td>
                                <div class="card h-50 overflow-hidden">
                                    <img style="height:80px; width:100px; object-fit:container ;" src="<?php echo BASE_URL . $userImgFolder . $user['image'] ?>" alt="Avatar" />
                                </div>
                            </td>
                            <td>
                                <div class="name me-4"><?php echo $user['name']; ?></div>
                            </td>
                            <td class="address"><?php echo $user['address']; ?></td>
                            <td class="email"><?php echo $user['email']; ?></td>
                            <td class="phone"><?php echo $user['phone']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo BASE_URL . $actionUrl . 'edit?id=' . $user['id'] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="<?php echo BASE_URL . $actionUrl . 'delete?id=' . $user['id'] ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<script type="text/javascript">
    let search = document.getElementById('search');
    console.log(search);
    search.onkeyup = function() {

        let textFind = this.value.toUpperCase();
        let trs = document.querySelectorAll('tbody tr');
        trs.forEach((tr) => {
            let userName = tr.querySelectorAll('tbody tr .username').innerText;
            let name = tr.querySelector('tbody tr .name').innerText;
            let phone = tr.querySelector('tbody .phone').innerText;
            let address = tr.querySelector('tbody .address').innerText;
            let email = tr.querySelector('tbody .email').innerText;
            let string = userName + ' ' + name + " " + address + ' ' + phone + " " + email;



            if (string.toUpperCase().indexOf(textFind) != -1) {
                tr.style.display = 'table-row'
            } else {
                tr.style.display = 'none'
            }


            // console.log(textFind)

        })

    }
</script>