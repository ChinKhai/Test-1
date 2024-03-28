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
            <h1>Product List</h1>
            <a href="<?=base_url('add_product') ?>">
                <button class="btn btn-success" style="color:white">Add Product</button>
            </a>
    </div>
    <br/>

        <table class="table text-center">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Product Name</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Created at</th>
            <th class="text-center">Motified at</th>
            <th></th>
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
                    <td>N/A</td>
                    <?php
                }else{
                    ?>                
                    <td><?=$row['motified_date']?></td>
                    <?php
                }
                ?>
                <td><a href="update_product" class="btn btn-primary">
                    <i class="glyphicon glyphicon-pencil"></i></a>

                    <a href="delete_product" class="btn btn-danger">
                    <i class="glyphicon glyphicon-trash"></i></a>
                </td>
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



