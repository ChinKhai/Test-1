<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="jumbotron.css" rel="stylesheet">
    <title>Add Product</title>
</head>

<body>
    <div class="container">
        <div class="starter-template">
            <h1>Add Product</h1>
            <form method="POST" action="<?=base_url('submit')?>" onsubmit= "return validation()" >
            Product Name:<input type="text" id="product_name" name="product_name" class="form-control"/><br/><br/>
            Quantity:<input type="int" id="quantity" name="quantity" class="form-control"/><br/>
            <div class="button-group">
                    <button class="btn btn-success" type="submit">Submit</button>
                <a href="<?= base_url('/') ?>"><button type="button" class="btn btn-secondary">Go Back</button></a>
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
                alert("Add Product Successfully!!!")
                return true;
            }
        }

    </script>

    <script src="..\..\css\bootstrap.css"></script>
    <script src="..\..\css\bootstrap-grid.css"></script>

</body>
</html>



