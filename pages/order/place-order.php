<?php
include ("../headerdiv.php");
ob_clean();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Orders
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Orders</a></li>
            <li class="active">Place Orders</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Place Orders</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form enctype="application/x-www-form-urlencoded" action="../../app/supplier.php" method="post" role="form" id="formSubmit">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="input">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control pull-right" name="date" id="pickDate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Order ID</label>
                                        <input class="form-control" name="orderID" id="txtOrderID" placeholder="Enter Order ID">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer ID</label>
                                            <select class="form-control" id="txtCustomer">
                                            </select>
                                        </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Item ID</label>
                                    <select class="form-control"  id="txtItem">
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input class="form-control" name="customerName" id="txtCustomerName" placeholder="Customer Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control" name="description" id="txtDescription" placeholder="Description">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Quantity on Hand</label>
                                <input class="form-control" name="qtyOnHand" id="txtQtyOnHand" placeholder="Quantity on Hand">
                            </div>
                            <div class="form-group">
                                <label>Unit Price</label>
                                <input class="form-control" name="unitPrice" id="txtPrice" placeholder="Unit Price">
                            </div>
                            <div class="form-group">
                                <label>Ordered Quantity</label>
                                <input class="form-control" name="orderedQty" id="txtOrderedQty" placeholder="Ordered Quantity">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btnAdd">Add Item</button>
                                <button type="button" class="btn btn-primary" id="btnRemove">Remove Item</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Order Details</h3>
                    </div>
                    <div class="box-body">
                        <table id="tblOrder" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="box-footer">
                        <button type="button" class="btn btn-success" id="btnPlaceOrder" data-toggle="modal" data-target="#modal-success">Place Order</button>
                        <div class="description-block pull-right">
                            <div class="description-header">
                                Sub Total
                            </div>
                            <div class="description-text">
                              <lable  id="netTotal">0.00</lable>
                            </div>
                        </div>
                    </div>


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
<script src="../json2.js"></script>
<script src="../json_parse.js"></script>
<script src="../cycle.js"></script>
<script src="../json_parse_state.js"></script>


<script>
    var subTotal=0;

    loadAllCustomers();
    loadAllItems();

    $("#btnAdd").click(function (ev) {
        var itemID = $("#txtItem option:selected").text();
        var description = $("#txtDescription").val();
        var unitPrice = $("#txtPrice").val();
        var qty = $("#txtOrderedQty").val();
        var total = parseFloat(unitPrice) * parseFloat(qty);
        $('tbody').append('<tr><td>' + itemID + '</td><td>' + description + '</td><td>'
            + unitPrice + '</td><td>' + qty+ '</td><td>' + total + '</td></tr>');

        subTotal = subTotal + total;
        if (isNaN(qty)){
            $("#netTotal").text('0.0');
        }else{
            $("#netTotal").text(subTotal);

        }
    });


    $("#txtItem").on('change', function (ev) {
        var itemID = $("#txtItem option:selected").text();

        $.ajax({
            method :'POST',
            url:'../../app/item.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                icode : itemID,
                iname : '',
                iprice : '',
                isup : '',
                iquantity : '',
                testbtn : "search"
            }
        }).done(function (response) {
            var item =JSON.parse(response);
            $("#txtDescription").val(item[0][1]);
            $("#txtQtyOnHand").val(item[0][4]);
            $("#txtPrice").val(item[0][3]);
        }).fail(function ( xhr ,status,error) {
            console.log(error);
        });
        $("#txtOrderedQty").focus();
    });


    $("#txtCustomer").on('change', function (ev) {
        var cusID = $("#txtCustomer option:selected").text();
        console.log(cusID);
        $.ajax({
            method :'POST',
            url:'../../app/customer.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                cid : cusID,
                cname : '',
                cemail : '',
                cphone : '',
                ccity : '',
                testbtn : "search"
            }
        }).done(function (response) {
            var customer =JSON.parse(response);
            $("#txtCustomerName").val(customer[0][1]);

        }).fail(function ( xhr ,status,error) {
            console.log(error);
        });
    });


//
//    $("#txtOrderedQty").keydown(function (ev) {
//        if (ev.which === 86 && ev.ctrlKey === true) return;
//
//        var accepetKeys = [46,8,37,38,39,40];
//
//        if (accepetKeys.indexOf(ev.which) !== -1){
//            return;
//        }
//
//        if (!((ev.which >= 96 && ev.which <= 105) || (ev.which >= 48 && ev.which <= 57))){
//            ev.preventDefault();
//        }
//    });
//

    $("#btnPlaceOrder").click(function (ev) {

        var array = [];


        $('#tblOrder tr').has('td').each(function() {
            var arrayItem = {};
            $('td', $(this)).each(function(index, item) {
                arrayItem[[index]] = $(item).html();
            });
            array.push(arrayItem);
        });


        var length = $("#tblOrder tr").length;

       var orderDetails = JSON.stringify(array);

        $.ajax({
            method: 'POST',
            url : '../../app/order.php',
            async: true,
            contentType: 'application/x-www-form-urlencoded',
            data: {
                oid : $("#txtOrderID").val(),
                date : $("#pickDate").val(),
                cid : $("#txtCustomer option:selected").text(),
                subtot : subTotal ,
                length : length ,
                orderDetails : orderDetails
            }
        }).done(function(response){
            $("#alert").css("display","inline-block")
            if(response){
                $("#alert").addClass("alert alert-success alert-dismissible");
                $("#icon").addClass("icon fa fa-check");
                $("#msg").text("Order has been successfully placed");
            }else{
                $("#alert").addClass("alert alert-danger alert-dismissible");
                $("#icon").addClass("icon fa fa-ban");
                $("#msg").text("Order has not been  placed");
            }
        }).fail(function(xhr, status, error){
            console.log(error);
        });
    });

    function loadAllCustomers() {
        $("#alert").css('display',"none");
        $.ajax({
            method :'POST',
            url:'../../app/customer.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                cid :'',
                cname :'',
                cemail : '',
                cphone : '',
                ccity : '',
                testbtn : "view"
            }
        }).done(function(response){
            var customers = JSON.parse(response);
            for(var index in customers){
                $("#txtCustomer").append('<option>' + customers[index][0] + '</option>').trigger('change');
            }
        }).fail(function(xhr, status, error){
            console.log(error);
        });
    }

    function loadAllItems() {
        $("#alert").css('display',"none");
        $.ajax({
            method :'POST',
            url:'../../app/item.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                icode :'',
                iname :'',
                isup : '',
                iprice : '',
                iquantity : '',
                testbtn : "view"
            }
        }).done(function(response){
            var items = JSON.parse(response);
            for(var index in items){
                $("#txtItem").append('<option>' + items[index][0] + '</option>').trigger('change');

            }
        }).fail(function(xhr, status, error){
            console.log(error);
        });
    }


</script>