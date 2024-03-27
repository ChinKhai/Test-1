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
            <form method="POST" action="submit" onsubmit="alert('Add Product Successfully')" >
            Product Name:<input type="text" name="product_name" class="form-control"/><br/><br/>
            Quantity:<input type="int" name="quantity" class="form-control"/><br/>
            <div class="button-group">
                    <button class="btn btn-success">Submit</button>
                <a href="<?= base_url('/') ?>"><button type="button" class="btn btn-secondary">Go Back</button></a>
            </div>
            </form>
        </div>
    </div>

    <script src="..\..\css\bootstrap.css"></script>
    <script src="..\..\css\bootstrap-grid.css"></script>

</body>
</html>



