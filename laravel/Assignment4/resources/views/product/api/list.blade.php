<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/product-list-api.css') }}">
  <title>Document</title>
</head>
<body>
  <table>
    <a href="/api-view/product/create">Create</a>
    <thead>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Operation</th>
    </thead>
    <tbody></tbody>
  </table>

  <script>
    $.ajax({
    url: "/api/product/list",
    type: 'GET',
    dataType: 'json', // added data type
        success: function(res) {
            res.forEach(product => {
                $('tbody').append(
                    `<tr><td>${product.id}</td>
                    <td>${product.productName}</td>
                    <td>${product.price}</td>
                    <td><button onclick="deletePost(${product.id})" >Delete</button> 
                    <a href="/api-view/product/edit/${product.id}">Edit</a></td></tr>`);
            });
        }
    });
    function deletePost(id) {

      if(confirm("Are you sure you want to delete")) {
        $.ajax({
        url: `/api/product/delete/${id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        },
        error: function(result) {
            alert("fail");
        }
        });
      }

        
    }
    </script>
</body>
</html>