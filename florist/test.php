<?php
if(!empty($_POST['flower'])){
    $flowers = $_POST['flower'];
    $sql = '';
 
    foreach($flowers as $key => $item){
         if($key === 0){
            $sql .= 'INSERT into supply_flower(supply_id, flower_color_id, quantity, sum)
               VALUES ('.$item['supply_id'].', '.$item['flower_color_id'].' , '.$item['quantity'].' , '.$item['sum'].')';
        }else{
            $sql .= ', VALUES ('.$item['supply_id'].', '.$item['flower_color_id'].' , '.$item['quantity'].' , '.$item['sum'].')';
        }
    }
   
    echo $sql;
 
}else{
    echo "Выберите хотя бы один цветок.";
}
?>