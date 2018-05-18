<?php include ("../headerdiv.php");
ob_clean();
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Item
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Item</a></li>
                <li class="active">Manage Item</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Manage Item</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form enctype="application/x-www-form-urlencoded" action="../../app/item.php" method="post" role="form" id="formSubmit">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Item Code</label>
                                    <input type="text" class="form-control" name="icode" placeholder="Enter Item Code" id="txtCode">
                                    <button type="button" class="btn btn-primary" id="btnSearch">Search</button>

                                </div>
                                <div class="form-group">
                                    <label>Item Description</label>
                                    <input type="text" class="form-control" name="iname" placeholder="Enter Item Description" id="txtName">
                                </div>
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <input type="text" class="form-control" name="isup" placeholder="Enter Supllier" id="txtSup">
                                </div>
                                <div class="form-group">
                                    <label>Unit Price</label>
                                    <input type="text" class="form-control" name="iprice" placeholder="Enter Unit Price" id="txtPrice">
                                </div>
                                <div class="form-group">
                                    <label>Item Quantity</label>
                                    <input type="text" class="form-control" name="iquantity" placeholder="Enter Item Quantity" id="txtqunatity">
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

<?php include ("../footerdiv.php");
ob_clean();
?>
<script>
    $("#btnSearch").click(function () {
        $("#alert").css('display',"none");
        $.ajax({
            method :'POST',
            url:'../../app/item.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                icode : $("#txtCode").val(),
                iname : $("#txtName").val(),
                iprice : $("#txtPrice").val(),
                isup : $("#txtSup").val(),
                iquantity : $("#txtqunatity").val(),
                testbtn : "search"
            }
        }).done(function (response) {
            console.log(response);
            var item =JSON.parse(response);
            $("#txtcode").val(item[0][0]);
            $("#txtName").val(item[0][1]);
            $("#txtSup").val(item[0][2]);
            $("#txtPrice").val(item[0][3]);
            $("#txtqunatity").val(item[0][4]);
        }).fail(function ( xhr ,status,error) {
            console.log(error);
        });
    });
    $("#btnUpdate").click(function () {

        $.ajax({
            method :'POST',
            url:'../../app/item.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                icode : $("#txtCode").val(),
                iname : $("#txtName").val(),
                iprice : $("#txtPrice").val(),
                isup : $("#txtSup").val(),
                iquantity : $("#txtqunatity").val(),
                testbtn : "update"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Item has been successfully updated");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Item has not been  updated");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });


    $("#btnDelete").click(function () {
        $.ajax({
            method :'POST',
            url:'../../app/item.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                icode : $("#txtCode").val(),
                iname : $("#txtName").val(),
                iprice : $("#txtPrice").val(),
                isup : $("#txtSup").val(),
                iquantity : $("#txtqunatity").val(),
                testbtn : "delete"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Item has been successfully deleted");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Item has not been  deleted");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });


    $("#btnNew").click(function () {
        $.ajax({
            method :'POST',
            url:'../../app/item.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                icode : $("#txtCode").val(),
                iname : $("#txtName").val(),
                iprice : $("#txtPrice").val(),
                isup : $("#txtSup").val(),
                iquantity : $("#txtqunatity").val(),
                testbtn : "new"
            }
        }).done(function (response) {
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Item has been successfully saved");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Item has not been  saved");
            }
        }).fail(function ( xhr ,status,error) {

            console.log(error);
        });
        clearAll();
    });

    function clearAll() {
        $("#txtCode").val('');
        $("#txtName").val('');
        $("#txtPrice").val('');
        $("#txtSup").val('');
       $("#txtqunatity").val('');
    }
</script>