<?php
include ("../headerdiv.php");
ob_clean();
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Customer
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Customer</a></li>
                <li class="active">Manage Customer</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Manage Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form enctype="application/x-www-form-urlencoded" action="../../app/customer.php" method="post" role="form" id="formSubmit">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" class="form-control" name="cid" placeholder="Enter Customer ID"  id="txtID">
                                    <button type="button" class="btn btn-primary" id="btnSearch">Search</button>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="cname" placeholder="Enter Customer Name"  id="txtName">
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" name="cemail" placeholder="Enter Customer E-Mail"  id="txtMail">
                                </div>
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="tel" class="form-control" name="cphone" placeholder="Enter Customer Contact No" id="txtContact">
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="ccity" placeholder="Enter City"   id="txtCity">
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="btnNew">New</button>
                                    <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
                                    <button type="button" class="btn btn-primary" id="btnDelete">Delete</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div id="alert">
                        <h4><i id="icon"></i> Alert!</h4>
                       <label id="msg"></label>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->



<?php
include ("../footerdiv.php");
ob_clean();
?>
<script>
    $("#btnSearch").click(function () {
        $("#alert").css('display',"none");
        $.ajax({
           method :'POST',
           url:'../../app/customer.php',
           async : true,
           contentType : 'application/x-www-form-urlencoded',
           data : {
               cid : $("#txtID").val(),
               cname : $("#txtName").val(),
               cemail : $("#txtMail").val(),
               cphone : $("#txtContact").val(),
               ccity : $("#txtCity").val(),
               testbtn : "search"
           }
       }).done(function (response) {
           console.log(response);
            var customer =JSON.parse(response);
            $("#txtID").val(customer[0][0]);
            $("#txtName").val(customer[0][1]);
            $("#txtMail").val(customer[0][2]);
            $("#txtContact").val(customer[0][3]);
            $("#txtCity").val(customer[0][4]);
        }).fail(function ( xhr ,status,error) {
            console.log(error);
        });
    });
    $("#btnUpdate").click(function () {

        $.ajax({
            method :'POST',
            url:'../../app/customer.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                cid : $("#txtID").val(),
                cname : $("#txtName").val(),
                cemail : $("#txtMail").val(),
                cphone : $("#txtContact").val(),
                ccity : $("#txtCity").val(),
                testbtn : "update"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
              $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Customer has been successfully updated");
            }else{
             $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Customer has not been  updated");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });


    $("#btnDelete").click(function () {
        $.ajax({
            method :'POST',
            url:'../../app/customer.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                cid : $("#txtID").val(),
                cname : $("#txtName").val(),
                cemail : $("#txtMail").val(),
                cphone : $("#txtContact").val(),
                ccity : $("#txtCity").val(),
                testbtn : "delete"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Customer has been successfully deleted");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Customer has not been  deleted");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });


    $("#btnNew").click(function () {
        $.ajax({
            method :'POST',
            url:'../../app/customer.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                cid : $("#txtID").val(),
                cname : $("#txtName").val(),
                cemail : $("#txtMail").val(),
                cphone : $("#txtContact").val(),
                ccity : $("#txtCity").val(),
                testbtn : "new"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Customer has been successfully saved");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Customer has not been  saved");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });
    
    function clearAll() {
        $("#txtID").val("");
        $("#txtName").val("");
        $("#txtMail").val("");
        $("#txtContact").val("");
        $("#txtCity").val("");
    }
</script>