<?php 
include 'app/controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    change_password($password , $new_password); 
}
 ?>
<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <form class="section work-experience" method="post">
        <div class="info">
            <h5 class="">تغییر حساب کاربری</h5>
            <div class="row">
                <div class="col-md-12 text-right mb-5">
                    <div class="alert alert-info" style="text-align: center;">
                        <span >برای تغییر رمز عبور باید رمز عبور قبلی را وارد نمایید.</span>
                    </div>
                    <?php if(isset($_SESSION['errors'])): ?>
                            <?php foreach($_SESSION['errors'] as $error): ?>
                            <div class="alert alert-danger" role="alert" style="text-align: center">
                               <span><?= $error ?></span>
                            </div> 
                            <?php endforeach ?>
                        <?php endif ?>
                </div>
                <div class="col-md-11 mx-auto">

                    <div class="work-section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">رمز عبور</label>
                                            <input type="password" class="form-control mb-4" id="password" name="password" placeholder="رمز عبور قبلی" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new_password">رمز عبور جدید</label>
                                            <input type="password" class="form-control mb-4" id="new_password" name="new_password" placeholder="رمز عبور جدید" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ذخیره</button>

                </div>
            </div>
        </div>
    </form>
</div>