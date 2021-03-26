<div class="table-responsive mb-4 mt-4">
    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
        <thead>
            <tr>
                <th>سفارش</th>
                <th> تاریخ </th>
                <th> وضعیت </th>
                <th>مجموع</th>
                <th> تنظیمات </th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach (get_post() as $row){
                // var_dump($row);
            $order_id = $row['order_id'];
            $pdo = new PDO("mysql:host=127.0.0.1;dbname=shadcome",'newuser','password');
            $stmt = $pdo->prepare("SELECT wp_posts.* FROM wp_posts WHERE ID IN (:order_id)");
            $stmt->execute([
                'order_id'=>$order_id,
            ]);
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($results);die();

            // $pdo = new PDO("mysql:host=127.0.0.1;dbname=shadcome",'newuser','password');
            // $sql = $pdo->prepare("SELECT * FROM wp_postmeta WHERE post_id = :order_id");
            // $sql->execute([
            //     'order_id'=>$order_id,
            // ]);
            // $result_name = $sql->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <td><a href="index.php?id=<?= $order_id ?>"><?= $order_id ?></a></td>
                <td><?php echo $results['post_date']; ?></td>
                <td><?php echo $results['post_status'];?></td>
                <td><?php echo number_format($row['order_total']); ?> تومان</td>
                <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></td>
            </tr>
            <?php } ?>
            
        </tbody>
    </table>
</div>