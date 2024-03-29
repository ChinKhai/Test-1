<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="jumbotron.css" rel="stylesheet">
    <title>Update Product</title>
</head>

<body>
    <div class="container">
        <h1>Update Product</h1>
            <form method="POST" action="<?=base_url('update_product/'.$productData['product_id'])?>" onsubmit= "return validation()" >
            Product Name:<input type="text" id="product_name" name="product_name" class="form-control"  value="<?=$productData['product_name']?>"/><br/><br/>
            Quantity:<input type="int" id="quantity" name="quantity" class="form-control"   value="<?=$productData['quantity']?>"/><br/>
            <input type="hidden" name="id" value="<?=$productData['product_id']?>"/><br/>


            <div class="button-group">
                    <button class="btn btn-success" type="submit">Submit</button>
                <a href="<?= base_url('/product_list') ?>"><button type="button" class="btn btn-secondary">Go Back</button></a>
            </div>
            </form>
        </div>
    </div>

    <script>
        function validation(){
            var pname=$("#product_name").val();
            var quantity=$("#quantity").val();
            if(pname==""){
                alert("Your product name is empty. Please key in your product name.");
                return false;
            }else if (quantity==""){
                alert("Your quantity is empty.")
                return false;
            }else{
                alert("Update Product Successfully!!!")
                return true;
                return header("Location: " . base_url('/product_list'));
            }
        }

    </script>




<script src="..\..\css\bootstrap.css"></script>
    <script src="..\..\css\bootstrap-grid.css"></script>

</body>
</html>


