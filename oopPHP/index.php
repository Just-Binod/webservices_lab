<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

include "Product.php";

$products = new Product();

$res = $products->getProducts();
?>
<table border="1">
    <tr>
        <th>Name</th>
        <th>description</th>
    </tr>
    <?php foreach($res as $val):?>
    <tr>
        <td><a href="detail.php?id=<?php echo $val['id']?>"><?php echo $val['name']?></a></td>
        <td><?php echo $val['desc']?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php

// $result = $products->createProduct();

// if($result){
//     echo "created";
// }else{
//     echo "Please try agian";
// }