<?php include "../headerdiv.php" ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Supplier
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Supplier</a></li>
                <li><a href="#">View</a></li>

            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <main class="container">
                        <h1>View Supplier</h1>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Supplier ID</th>
                                <th>Supplier Name</th>
                                <th>Location</th>
                                <th>Contact No</th>
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

  <?php include  "../footerdiv.php" ?>
<script>
    loadAll();
    function loadAll() {

        $("#alert").css('display',"none");
        $.ajax({
            method :'POST',
            url:'../../app/supplier.php',
            async : true,
            contentType : 'application/x-www-form-urlencoded',
            data : {
                sid :'',
                sname :'',
                sloc : '',
                stel : '',
                testbtn : "view"
            }
        }).done(function (response) {
            var suppliers =JSON.parse(response);
            for(var index in suppliers) {
                $('tbody').append('<tr><td>' + suppliers[index][0] + '</td><td>' + suppliers[index][1] + '</td><td>'
                    + suppliers[index][2] + '</td><td>' + suppliers[index][3] +'</td></tr>');
            }
        }).fail(function ( xhr ,status,error) {
            console.log(error);
        });
    }
</script>
