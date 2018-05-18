<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lochana-PC
 * Date: 2018-02-14
 * Time: 2:52 AM
 */
if(!(isset($_POST['oid']) && isset($_POST['date']) && isset($_POST['cid']) && isset($_POST['orderDetails']))){
    echo "Enter Valid Information";
    die;
}

$orderID = $_POST['oid'];
$date = $_POST['date'];
$customerID = $_POST['cid'];
$subTotal =$_POST['subtot'];
$orderDetails = json_decode($_POST['orderDetails'],true);
$length =$_POST['length'];
$connection = mysqli_connect("127.0.0.1", "root", "1234", "phpdb", "3306");

if (!$connection) {
    echo "Could not able to establish the connection", "<br>";
    echo mysqli_connect_error();
    die;
}

$connection->autocommit(true);

$result = $connection->query("INSERT INTO `order` VALUES ('$orderID', '$customerID', '$date' , '$subTotal')");

$result = $result && ($connection->affected_rows > 0);


if ($result){

    foreach ($orderDetails as $orderDetail){

        $result = $connection->query("INSERT INTO order_details VALUES ('$orderID', '$orderDetail[0]', '$orderDetail[3]' , '$orderDetail[4]')");
        $result = $result && ($connection->affected_rows > 0);


        if (!$result) {
            echo false;
            $connection->rollback();
            break;
        }

        $result = $connection->query("SELECT quantity FROM `item` WHERE item_code = '$orderDetail[0]' ");
        $qty = $result->fetch_row()[0] - $orderDetail[3];

        $result = $connection->query("UPDATE `item` SET quantity = $qty WHERE item_code = '$orderDetail[0]'");
        $result = $result && ($connection->affected_rows > 0);
        echo "Wadea goada" . $connection->affected_rows;
        if (!$result) {
            echo false;
            $connection->rollback();
            break;
        }
    }


    echo mysqli_error($connection);
    $connection->commit();
}else{
    echo false;
    $connection ->rollback();
}

$connection->autocommit(true);
