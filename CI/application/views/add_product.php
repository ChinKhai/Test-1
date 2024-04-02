<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js"></script>
</head>
<body ng-app="Test-1" ng-controller="addCtrl">
<div class="container">
    <div class="starter-template">
    <h1>Add Product</h1>
    <form>
        Product Name:<input type="text" ng-model="name" class="form-control"/><br/><br/>
        Quantity:<input type="int" ng-model="quantity" class="form-control"/><br/>
            <div class="button-group">
                <button class="btn btn-success" type="submit" ng-click="submit()">Submit</button>
                <button type="button" class="btn btn-secondary" ng-click="goback()">Go Back</button>
            </div>
    </form>
</div>
</div>




    <script>
    var test=angular.module("Test-1",[]);

    test.controller("addCtrl",function($scope,$http,$window){

        $scope.submit=function(){
            if($scope.name==""){
                alert("Your product name is empty. Please key in your product name.");
                return false;
            }else if ($scope.quantity==""){
                alert("Your quantity is empty.")
                return false;
            }else{
                var data={
                    product_name:$scope.name,
                    quantity:$scope.quantity
                };
                $http.post('<?=base_url("submit")?>', data)
                    .then(function(result){
                        alert("Add Product Successfully!!!");
                        $window.location.href = '<?=base_url("product_list")?>';
                    })
                    .catch(function(error){
                        console.error('Error',error);
                        alert("Failed to add product. Please try again.");
                    })
            }
        }

        $scope.goback=function(){
            $window.location.href='<?=base_url("product_list")?>'
        }
    });

    </script>
</body>
</html>




// <!-- <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
//     <link href="jumbotron.css" rel="stylesheet">
//     <title>Add Product</title>
// </head>

// <body>
//     <div class="container">
//         <div class="starter-template">
//             <h1>Add Product</h1>
//             <form method="POST" action="<?=base_url('submit')?>" onsubmit= "return validation()" >
//             Product Name:<input type="text" id="product_name" name="product_name" class="form-control"/><br/><br/>
//             Quantity:<input type="int" id="quantity" name="quantity" class="form-control"/><br/>
//             <div class="button-group">
//                     <button class="btn btn-success" type="submit">Submit</button>
//                 <a href="<?= base_url('product_list') ?>"><button type="button" class="btn btn-secondary">Go Back</button></a>
//             </div>
//             </form>
//         </div>
//     </div>

//     <script>
//         function validation(){
//             var pname=$("#product_name").val();
//             var quantity=$("#quantity").val();
//             if(pname==""){
//                 alert("Your product name is empty. Please key in your product name.");
//                 return false;
//             }else if (quantity==""){
//                 alert("Your quantity is empty.")
//                 return false;
//             }else{
//                 alert("Add Product Successfully!!!")
//                 return true;
//             }
//         }

//     </script>

// </body>
// </html>


//  -->
