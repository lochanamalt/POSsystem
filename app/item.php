<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lochana-PC
 * Date: 2018-02-02
 * Time: 2:44 PM
 */
$id='';
$name='';
$sup='';
$up='';
$quantity='';

if(isset($_POST['testbtn'])){
    $connection =mysqli_connect("127.0.0.1","root","1234","phpdb","3306");
    $id=$_POST['icode'];
    $name=$_POST['iname'];
    $sup=$_POST['isup'];
    $up=$_POST['iprice'];
    $quantity=$_POST['iquantity'];
    $test=$_POST['testbtn'];
    if(!$connection){
        echo "Could not able to establish the connection","<br>";
        echo mysqli_connect_error();
        die;
    }

    if($test=='search'){

        $resultSet=$connection->query("SELECT * FROM item WHERE item_code='$id'");

        if( $result = (bool) (($connection -> affected_rows) > 0)){
            $output = array();
            foreach ($resultSet->fetch_all() as $row){
                $output[] = $row;
            }
            echo json_encode($output);

        }

    }

    else if($test=='update'){

        $result =$connection->query("UPDATE item SET item_name='$name' , supplier_id='$sup' , price=$up , quantity=$quantity WHERE item_code='$id'");
        $result = (bool) (($connection -> affected_rows) > 0);

        if ($result){
            echo true;
        }else{
            echo false;
        }
        $update = true;
    }
    else if($test=='delete'){
        $result =$connection->query("DELETE FROM item WHERE item_code='$id'" );


        if(($connection ->affected_rows)>0  && $result){
            echo true;
        }
        else {
          echo false;
            $result=false;
        }
    }
    else if($test=='new'){
        $result =$connection->query("INSERT INTO item VALUES ('$id','$name','$sup','$up','$quantity')");

        if(($connection ->affected_rows)>0  && $result){
            echo true;
        }else{
            echo false;
            $result=false;
        }
    }
    else if($test=='view') {

        $resultSet=$connection->query("SELECT * FROM item");
        if( $result = (bool) (($connection -> affected_rows) > 0)){
            $output = array();
            foreach ($resultSet->fetch_all() as $row){
                $output[] = $row;
            }
            echo json_encode($output);

        }
    }

}


