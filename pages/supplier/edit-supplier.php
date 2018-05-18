<?php include "../headerdiv.php" ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Suppliers
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Suppliers</a></li>
                <li class="active">Manage Supplier</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Manage Supplier</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form enctype="application/x-www-form-urlencoded" action="../../app/supplier.php" method="post" role="form" id="formSubmit">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Supplier ID</label>
                                    <input type="text" class="form-control" name="sid" placeholder="Enter Supplier ID" id="txtId">
                                    <button type="button" class="btn btn-primary" id="btnSearch">Search</button>

                                </div>
                                <div class="form-group">
                                    <label>Supplier Name</label>
                                    <input type="text" class="form-control" name="sname" placeholder="Enter Name" id="txtName">
                                </div>
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" class="form-control" name="sloc" placeholder="Enter Location" id="txtLoc">
                                </div>
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="tel" class="form-control" name="stel" placeholder="Contact No" id="txtContact">
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="button" class="btn btn-primary" id="btnNew">New</button>
                                <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
                                <button type="button" class="btn btn-primary" id="btnDelete">Delete</button>
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
<?php include "../footerdiv.php" ?>
<script>
    $("#btnSearch").click(function () {
        $("#alert").css('display',"none");
        $.ajax({
            method :'POST',
            url:'../../app/supplier.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                sid : $("#txtId").val(),
                sname : $("#txtName").val(),
                stel : $("#txtContact").val(),
                sloc : $("#txtLoc").val(),
                testbtn : "search"
            }
        }).done(function (response) {
            console.log(response);
            var supplier =JSON.parse(response);
            $("#txtId").val(supplier[0][0]);
            $("#txtName").val(supplier[0][1]);
            $("#txtLoc").val(supplier[0][2]);
            $("#txtContact").val(supplier[0][3]);
        }).fail(function ( xhr ,status,error) {
            console.log(error);
        });
    });
    $("#btnUpdate").click(function () {

        $.ajax({
            method :'POST',
            url:'../../app/supplier.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                sid : $("#txtId").val(),
                sname : $("#txtName").val(),
                stel : $("#txtContact").val(),
                sloc : $("#txtLoc").val(),
                testbtn : "update"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Supplier has been successfully updated");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Supplier has not been  updated");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });


    $("#btnDelete").click(function () {
        $.ajax({
            method :'POST',
            url:'../../app/supplier.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                sid : $("#txtId").val(),
                sname : $("#txtName").val(),
                stel : $("#txtContact").val(),
                sloc : $("#txtLoc").val(),
                testbtn : "delete"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Supplier has been successfully deleted");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Supplier has not been  deleted");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });


    $("#btnNew").click(function () {
        $.ajax({
            method :'POST',
            url:'../../app/supplier.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                sid : $("#txtId").val(),
                sname : $("#txtName").val(),
                stel : $("#txtContact").val(),
                sloc : $("#txtLoc").val(),
                testbtn : "new"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Supplier has been successfully saved");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Supplier has not been  saved");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });

    function clearAll() {
        $("#txtId").val("");
        $("#txtName").val("");
        $("#txtContact").val("");
        $("#txtLoc").val("");
    }
</script>
