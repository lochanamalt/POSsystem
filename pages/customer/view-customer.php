<?php include "../headerdiv.php"
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
                <li><a href="#">View</a></li>

            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <main class="container">
                        <h1>View Customer</h1>
                        <table class="table table-bordered table-hover table-striped" id="table">
                            <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>E-mail</th>
                                <th>Contact No</th>
                                <th>City</th>
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
        }).done(function (response) {
            var customers =JSON.parse(response);
            for(var index in customers) {
                $('tbody').append('<tr><td>' + customers[index][0] + '</td><td>' + customers[index][1] + '</td><td>'
                + customers[index][2] + '</td><td>' + customers[index][3] + '</td><td>' + customers[index][4] + '</td></tr>');
    }
        }).fail(function ( xhr ,status,error) {
            console.log(error);
        });
    }
</script>