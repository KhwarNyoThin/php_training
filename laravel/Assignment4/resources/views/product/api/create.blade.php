<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
</head>
<body>
    <h1>Add a new product</h1>
    <label for="product-name">Product Name</label>
    <input type="text" name="product-name" id="product-name"> <br><br>
    <label for="price">Price</label>
    <input type="text" name="price" id="price"> <br><br>
    <button onclick="createProduct()">Create</button>

    <script>
        function createProduct() {
          console.log("hello");
          var createdData = {
            productName : $('#product-name').val(),
            price : $('#price').val()
          }
          $.ajax({
            url: "/api/product/create",
            type: 'POST',
            dataType: 'json',
            data: createdData,
            success: function(res) {
              window.location.replace('/api/product');
        }
      })
    }
    </script>
</body>
</html>