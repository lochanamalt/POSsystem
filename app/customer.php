<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lochana-PC
 * Date: 2018-02-02
 * Time: 2:44 PM
 */
$id='';
$name='';
$mail='';
$phone='';
$city='';
if(isset($_POST['testbtn'])) {
    $connection = mysqli_connect("127.0.0.1", "root", "1234", "phpdb", "3306");
    $id = $_POST['cid'];
    $name = $_POST['cname'];
    $mail = $_POST['cemail'];
    $phone = $_POST['cphone'];
    $city = $_POST['ccity'];
    $test = $_POST['testbtn'];
    if (!$connection) {
        echo "Could not able to establish the connection", "<br>";
        echo mysqli_connect_error();
        die;
    }

    if ($test == 'search') {

        $resultSet = $connection->query("SELECT * FROM customer WHERE id='$id'");
       if( $result = (bool) (($connection -> affected_rows) > 0)){
           $output = array();
           foreach ($resultSet->fetch_all() as $row){
               $output[] = $row;
           }
           echo json_encode($output);

       }


    }

    else if($test=='update'){

        $result =$connection->query("UPDATE customer SET cus_name='$name' , E_mail='$mail' , phone_no='$phone' , city='$city' WHERE id='$id'");
        $result = (bool) (($connection -> affected_rows) > 0);

        if ($result){
           echo true;

        }else{
            echo false;

        }
        $update = true;
    }

    else if($test=='new'){
        $result =$connection->query("INSERT INTO customer VALUES ('$id','$name','$mail','$phone','$city')");

        if(($connection ->affected_rows)>0  && $result){
            echo true;
        }else{
            echo false;
            $result=false;
        }
    }

    else if($test=='delete'){
        $result =$connection->query("DELETE FROM customer WHERE id='$id'" );


        if(($connection ->affected_rows)>0  && $result){
          echo true;
        }
        else {
            echo false;
            $result=false;
        }
    }
    else if($test=='view'){
        $resultSet=$connection->query("SELECT * FROM customer");
        if( $result = (bool) (($connection -> affected_rows) > 0)){
            $output = array();
            foreach ($resultSet->fetch_all() as $row){
                $output[] = $row;
            }
            echo json_encode($output);

        }
    }


}
