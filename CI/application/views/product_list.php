<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="jumbotron.css" rel="stylesheet">
</head>

<body>
<?php

include "database.php";


$query= mysqli_query ($link,"SELECT * FROM `product`")
?>
<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <h1>Product List</h1>
        </div>
        <div class="col-sm-2" style="margin-top:20px">
            <a href="<?=base_url('add_product') ?>">
                <button class="btn btn-success" style="color:white">Add Product</button>
            </a>
        </div>
    </div>
        <table class="table">
<thead>
    <tr>
        <th>Id</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Created at</th>
        <th>Motified at</th>
    </tr>
</thead>
<tbody>
    <?php
        if( mysqli_num_rows ($query) > 0){
            while($row = mysqli_fetch_array($query)){
                ?>
            <tr>
                <td><?=$row['product_id']?></td>
                <td><?=$row['product_name']?></td>
                <td><?=$row['quantity']?></td>
                <td><?=$row['created_date']?></td>
                <?php
                if($row['motified_date']==NULL){
                    ?>
                    <td>This product haven't motified before</td>
                    <?php
                }else{
                    ?>                
                    <td><?=$row['motified_date']?></td>
                    <?php
                }
                ?>

            </tr>
            <?php
            }
        }
        ?>
</tbody>
</table>

</div>
    
    <script src="..\..\css\bootstrap.css"></script>
    <script src="..\..\css\bootstrap-grid.css"></script>
    <style>
    </style>
</body>
</html>



