<?php include ("../headerdiv.php")
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
                <li><a href="#">View</a></li>

            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <main class="container">
                        <h1>View Items</h1>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Item Description</th>
                                <th>Item Supplier</th>
                                <th>Unit Price</th>
                                <th>Item Quanity</th>

                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </main>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

<?php include "../footerdiv.php" ?>
<script>
    loadAll();
    function loadAll() {

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
        }).done(function (response) {
            console.log(response);
            var items =JSON.parse(response);
            for(var index in items) {
                $('tbody').append('<tr><td>' + items[index][0] + '</td><td>' + items[index][1] + '</td><td>'
                    + items[index][2] + '</td><td>' + items[index][3] + '</td><td>' + items[index][4] + '</td></tr>');
            }
        }).fail(function ( xhr ,status,error) {
            console.log(error);
        });
    }
</script>