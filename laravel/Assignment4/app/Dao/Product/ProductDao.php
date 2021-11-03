<?php

namespace App\Dao\Product;


use App\Models\Product;
use App\Contracts\Dao\Product\ProductDaoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class ProductDao implements ProductDaoInterface {

  /**
   * To get product list
   * @return array $productList Product list
   */
  public function getProductList()
  {
    $productList = Product::all();
    return $productList;
  }

  /**
   * To save product
   * @param Request $request request with inputs
   * @return Object $product saved product
   */
  public function saveProduct(Request $request)
  {
    $product = new product();
    $product->productName = $request['productName'];
    $product->price = $request['price'];
    $product->save();
    return $product;
  }

  /**
   * To get product by id
   * @param string $id product id
   * @return Object $product product object
   */
  public function getProductById($id)
  {
    $product = product::find($id);
    return $product;
  }

  /**
   * To update product by id
   * @param Request $request request with inputs
   * @param string $id product id
   * @return Object $product product Object
   */
  public function updatedProductById(Request $request, $id)
  {
    $product = product::find($id);
    $product->productName = $request['productName'];
    $product->price = $request['price'];
    
    $product->save();
    return $product;
  }

  /**
   * To upload csv file for product
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadProductCSV($validated)
  {
    $path =  $validated['csv_file']->getRealPath();
    $csv_data = array_map('str_getcsv', file($path));
    // save product to Database accoding to csv row
    foreach ($csv_data as $index => $row) {
      if (count($row) >= 2) {
        try {
          $product = new product();
          $product->productName = $row[0];
          $product->price = $row[1];
          
          $product->save();
        } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          //error handling for duplicated product
          if ($errorCode == '1062') {
            $content = array(
              'isUploaded' => false,
              'message' => 'Row number (' . ($index + 1) . ') is duplicated title.'
            );
            return $content;
          }
        }
      } else {
        // error handling for invalid row.
        $content = array(
          'isUploaded' => false,
          'message' => 'Row number (' . ($index + 1) . ') is invalid format.'
        );
        return $content;
      }
    }
    $content = array(
      'isUploaded' => true,
      'message' => 'Uploaded Successfully!'
    );
    return $content;
  }

  /**
   * To save product via API
   * @param array $validated Validated values from request
   * @return Object created product object
   */
  public function saveProductAPI($validated)
  {
    $product = new product();
    $product->productName = $validated['productName'];
    $product->price = $validated['price'];
    $product->save();
    return $product;
  }



  /**
   * To delete product by id
   * @param string $id product id
   * @return string $message message success or not
   */
  public function deleteProductById($id)
  {
    $product = Product::find($id);
    if ($product) {
      $product->save();
      $product->delete();
      return 'Deleted Successfully!';
    }
    return 'Product Not Found!';
  }

  /**
   * To update product by id via api
   * @param array $validated Validated values from request
   * @param string $productId Product id
   * @return Object $product Product Object
   */
  public function updatedProductByIdAPI($validated, $productId)
  {
    $product = Product::find($productId);
    $product->productName = $validated['productName'];
    $product->price = $validated['price'];
    $product->save();
    return $product;
  }

}