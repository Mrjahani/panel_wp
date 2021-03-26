<?php 

$order_id = $_GET['id'];

$pdo = new PDO("mysql:host=127.0.0.1;dbname=shadcome",'newuser','password');
$stmt = $pdo->prepare("SELECT * FROM wp_postmeta WHERE post_id = :order_id");
$stmt->execute([
	'order_id'=>$order_id,
]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


$sql = $pdo->prepare("SELECT * FROM wp_woocommerce_order_items WHERE order_id = :order_id");
$sql->execute([
	'order_id'=>$order_id,
]);
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows);die();
// foreach ($results as $result) {

// 	if($result['meta_key'] == '_billing_first_name'){
// 		var_dump($result['meta_value']);
// 	}

// 	if($result['meta_key'] == '_billing_last_name'){
// 		var_dump($result['meta_value']);
// 	}

// 	if($result['meta_key'] == '_order_total'){
// 		var_dump($result['meta_value']);
// 	}

// 	if($result['meta_key'] == '_billing_city'){
// 		var_dump($result['meta_value']);
// 	}


// 	if($result['meta_key'] == '_billing_address_1'){
// 		var_dump($result['meta_value']);
// 	}

// 	if($result['meta_key'] == '_billing_postcode'){
// 		var_dump($result['meta_value']);
// 	}

// 	if($result['meta_key'] == '_billing_phone'){
// 		var_dump($result['meta_value']);
// 	}

// 	if($result['meta_key'] == '_cart_discount'){
// 		var_dump($result['meta_value']);
// 	}

// 	if($result['meta_key'] == '_billing_address_index'){
// 		var_dump($result['meta_value']);
// 	}
// }

 ?>
<?php foreach ($results as $result) { ?>        
<div class="row mb-12">
	<?php if($result['meta_key'] == '_billing_first_name'){?>
    <div class="col-6">
		<label for="exampleFormControlInput1">نام</label>
        <input type="text" class="form-control" placeholder="نام کوچک" value="<?= $result['meta_value'] ?> ">
    </div>
	<?php } ?>
	<?php if($result['meta_key'] == '_billing_last_name'){?>
    <div class="col-6">
		<label for="exampleFormControlInput1">نام خانوادگی</label>
        <input type="text" class="form-control" placeholder="نام کوچک" value="<?= $result['meta_value'] ?> ">
    </div>
	<?php } ?>
	<?php if($result['meta_key'] == '_order_total'){?>
    <div class="col-6">
		<label for="exampleFormControlInput1">جمع قیمت</label>
        <input type="text" class="form-control" placeholder="نام کوچک" value="<?= number_format($result['meta_value']) ?> ">
    </div>
	<?php } ?>
	<?php if($result['meta_key'] == '_billing_address_1'){?>
    <div class="col-6">
		<label for="exampleFormControlInput1">آدرس کاربر</label>
        <input type="text" class="form-control" placeholder="نام کوچک" value="<?= $result['meta_value'] ?> ">
    </div>
	<?php } ?>
	<?php if($result['meta_key'] == '_billing_postcode'){?>
    <div class="col-6">
		<label for="exampleFormControlInput1">کد پستی</label>
        <input type="text" class="form-control" placeholder="نام کوچک" value="<?= $result['meta_value'] ?> ">
    </div>
	<?php } ?>
   <?php if($result['meta_key'] == '_billing_phone'){?>
    <div class="col-6">
		<label for="exampleFormControlInput1">شماره تماس</label>
        <input type="text" class="form-control" placeholder="نام کوچک" value="<?= $result['meta_value'] ?> ">
    </div>
	<?php } ?>
	<?php if($result['meta_key'] == '_cart_discount'){?>
    <div class="col-6">
		<label for="exampleFormControlInput1">مقدار تخفیف</label>
        <input type="text" class="form-control" placeholder="نام کوچک" value="<?= $result['meta_value'] ?> ">
    </div>
	<?php } ?>
	
</div>
<?php } ?>
<br>
<div class="row mb-12">
	<?php foreach($rows as $row): ?>
    <div class="col-6">
		<label for="exampleFormControlInput1">نام محصولات</label>
        <input type="text" class="form-control" placeholder="نام کوچک" value="<?= $row['order_item_name'] ?> ">
    </div>
	<?php endforeach ?>
</div>

