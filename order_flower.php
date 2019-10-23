<?php require_once('config.php') ?> 
<?php 
if (!empty($_POST)){ 
$result = $_POST; 
$insert = []; 
$sql = ''; 
$sql2 = ''; 
$order_flower_id = $_POST['order_flower_id']; 
$packaging_id = $_POST['packaging_id']; 
$sum = $_POST['sum']; 
$client_id = $_POST['client_id']; 

foreach ($result as $key => $obj) { 
if($key !== 'packaging_id' && $key !== 'sum' && $key !== 'client_id' && $key !== 'order_flower_id'){ 
$chars = preg_split('/,/', $obj, -1, PREG_SPLIT_NO_EMPTY); 
foreach($chars as $k => $item){ 
$insert[$k][$key] = $item; 
} 
} 
} 

foreach($insert as $key => $item){ 
if($key === 0){ 
$sql .= 'INSERT INTO order_flower(order_id, flower_color_id, quantity) 
VALUES ('.$item['order_id'].', '.$item['flower_color_id'].' , '.$item['quantity'].')'; 
}else{ 
$sql .= ', ('.$item['order_id'].', '.$item['flower_color_id'].' , '.$item['quantity'].')'; 
} 
} 

$sql2 .= 'INSERT INTO basket(client_id, order_flower_id, packaging_id, quantity, sum) 
VALUES ('.$client_id.', '.$order_flower_id.' , '.$packaging_id.' , 1 , '.$sum.')'; 

mysqli_query($conn, $sql); 
mysqli_query($conn, $sql2); 
echo json_encode($insert); 
} 
?>