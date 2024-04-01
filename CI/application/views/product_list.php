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
?>
<div class="container">
    <h1>Product List</h1>

    <a href="<?=base_url('add_product') ?>">
        <button class="btn btn-success" style="color:white">Add Product</button>
    </a>
<form class="text-right" action="<?= base_url('product_list/search') ?>" method="GET">
    <div class="form-inline justify-content-end">
        <div class="form-group mb-2">
            <input class="form-control form-control-sm" type="text" name="page_number" placeholder="Page..." style="width: 80px;">
        </div>
        <button class="btn btn-primary btn-sm" type="submit">Go</button>
    </div>
</form>
    <br/>

<table class="table text-center">
    <thead>
        <tr>
            <th class="text-center">Product Id</th>
            <th class="text-center">Product Name</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Created at</th>
            <th class="text-center">Motified at</th>
            <th></th>
        </tr>
    </thead>
<tbody>
    <?php       
        if(!empty($List)){
            foreach($List as $row){
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
                <td><a href="<?=base_url('update_product/').$row['product_id']?>" class="btn btn-primary">
                    <i class="glyphicon glyphicon-pencil"></i></a>

                    <a href="<?=base_url('delete_product/').$row['product_id']?>" class="btn btn-danger">
                    <i class="glyphicon glyphicon-trash"></i></a>

                    <a href="javascript:;" onclick="addqtyAjax('<?=$row['product_id']?>')" class="btn btn-success">
                    <i class="glyphicon glyphicon-plus"></i></a>
                </td>
            </tr>
            <?php
            }
        }
        ?>
</tbody>
</table>

<nav class="text-center">
    <?=$pagination?> 
</form>

</nav>

</div>
    
    <script src="..\..\css\bootstrap.css"></script>
    <script src="..\..\css\bootstrap-grid.css"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function addqtyAjax(pid){
            console.log(pid);

            $.post("<?=base_url('addqtyAPI')?>",{quantity:1,product_id:pid},function(result){
                console.log(result);
                result=JSON.parse(result);
                if(result.status=="OK"){
                    alert('Add Successfully!');
                }else{
                    alert('Something wrong!');
                }
            });
        }
    </script>
    <style>
    </style>
</body>
</html>



