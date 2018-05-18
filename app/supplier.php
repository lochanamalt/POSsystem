
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lochana-PC
 * Date: 2018-02-02
 * Time: 2:44 PM
 */
$id='';
$name='';
$location='';
$phone='';
if(isset($_POST['testbtn'])){
    $connection =mysqli_connect("127.0.0.1","root","1234","phpdb","3306");
    $id=$_POST['sid'];
    $name=$_POST['sname'];
    $phone=$_POST['stel'];
    $location=$_POST['sloc'];
    $test=$_POST['testbtn'];
    if(!$connection){
        echo "Could not able to establish the connection","<br>";
        echo mysqli_connect_error();
        die;
    }

    if($test=='search'){

        $resultSet=$connection->query("SELECT * FROM supplier WHERE supplier_id='$id'");
        if( $result = (bool) (($connection -> affected_rows) > 0)){
            $output = array();
            foreach ($resultSet->fetch_all() as $row){
                $output[] = $row;
            }
            echo json_encode($output);

        }

    }

    else if($test=='update'){

        $result =$connection->query("UPDATE supplier SET supplier_name='$name' ,location='$location' , contact_no='$phone'  WHERE supplier_id='$id'");
        $result = (bool) (($connection -> affected_rows) > 0);
      if ($result){
            echo true;
        }else{
            echo false;
        }
        $update = true;
    }
    else if($test=='delete'){
        $result =$connection->query("DELETE FROM supplier WHERE supplier_id='$id'" );


        if(($connection ->affected_rows)>0  && $result){
            echo true;
        }
        else {
            echo true;
            $result=false;
        }
    }
    else if($test=='new'){
        $result =$connection->query("INSERT INTO supplier VALUES ('$id','$name','$location','$phone')");

        if(($connection ->affected_rows)>0  && $result){
            echo true;
        }else{
            echo false;
            $result=false;
        }
    }else if($test=='view'){
        $resultSet = $connection->query("SELECT * FROM supplier");
        if ($result = (bool)(($connection->affected_rows) > 0)) {
            $output = array();
            foreach ($resultSet->fetch_all() as $row) {
                $output[] = $row;
            }
            echo json_encode($output);

        }
    }
}


