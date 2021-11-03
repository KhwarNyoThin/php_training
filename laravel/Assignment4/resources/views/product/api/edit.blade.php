<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
</head>
<body>
    <h1>Edit Product</h1>
    <label for="productName">Product Name</label><input type="text" name="productName">
    <label for="Price">Price</label><input type="text" name="price">
    <button onclick="editProduct()">Edit</button>

    <script>
        
        function editProduct() {
          var productId = window.location.pathname.split('/')[3];
          console.log(productId);
          $.ajax({
          url: "/api/product/" + productId,
          type: 'GET',
          dataType: 'json', // added data type
              success: function(res) {
                  $('[name=productName]').val(res.productName);
          
                  $('[name=price]').val(res.price);
                  console.log(res.productName);
                  console.log(res.price);
              }
          });
            var editedData = {
                productName: $('[name=productName]').val(),
                price: $('[name=price]').val(),
            }

            $.ajax({
            url: "/api/product/edit/" + productId,
            type: 'POST',
            data: editedData,
            dataType: 'json', // added data type
                success: function(res) {
                    window.location.replace("/api-view/product");
                }
            });
        }
    </script>
</body>
</html>