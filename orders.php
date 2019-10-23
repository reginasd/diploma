<?php require_once('config.php') ?>
<?php
if(!empty($_POST['flower'])){
 
    $flowers = $_POST['flower'];
 
 
 
    $sql = '';
    $i = 0;
 
    foreach($flowers as $item){
         if($i === 0){
            $sql .= 'INSERT INTO orders(client_id, order_flower_id, quantity, status, sum, packaging_id, date, duedate, note)
              VALUES (
                  "'.$item['client_id'].'",
                  "'.$item['order_flower_id'].'",
                  "'.$item['quantity'].'",
                  "'.$item['status'].'",
                  "'.$item['sum'].'",
                  "'.$item['packaging_id'].'",
                  now(),
                  "'.$item['duedate'].'",
                  "'.$item['note'].'"
              )';
            $i++;
        }else{
            $sql .= ', VALUES (
              "'.$item['client_id'].'",
              "'.$item['order_flower_id'].'",
              "'.$item['quantity'].'",
              "'.$item['status'].'",
              "'.$item['sum'].'",
              "'.$item['packaging_id'].'",
              now(),
              "'.$item['duedate'].'",
              "'.$item['note'].'"
          )';
        }
    }
 
    //echo $sql;
 
   mysqli_query($conn, $sql);   /* запись в базу */
   
     //header("Location: korzina.php"); /* Перенаправление браузера  если нужно */
    //exit;
}else{
    echo 'Выберите хотя бы один букет';
}
?>