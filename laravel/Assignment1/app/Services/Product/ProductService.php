<?php

namespace App\Services\Product;

use App\Contracts\Dao\Product\ProductDaoInterface;
use App\Contracts\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface {

  private $productDao;
  public function __construct(ProductDaoInterface $productDao)
  {
    $this->productDao = $productDao;
  }

  /**
   * To get product list
   * @return array $productList Post list
   */
  public function getProductList()
  {
    return $this->productDao->getProductList();
  }

  /**
   * To save product
   * @param Request $request request with inputs
   * @return Object $product saved product
   */
  public function saveProduct(Request $request)
  {
    return $this->productDao->saveProduct($request);
  }

  /**
   * To get product by id
   * @param string $id product id
   * @return Object $product product object
   */
  public function getProductById($id)
  {
    return $this->productDao->getproductById($id);
  }

  /**
   * To update product by id
   * @param Request $request request with inputs
   * @param string $id product id
   * @return Object $product product Object
   */
  public function updatedProductById(Request $request, $id)
  {
    return $this->productDao->updatedProductById($request, $id);
  }

  /**
   * To delete product by id
   * @param string $id product id
   * @return string $message message success or not
   */
  public function deleteProductById($id)
  {
    return $this->productDao->deleteProductById($id);
  }

  /**
   * To upload csv file for product
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadProductCSV($validated)
  {
    $fileName = $validated['csv_file']->getClientOriginalName();
    Storage::putFileAs(config('path.csv').
      config('path.separator'), $validated['csv_file'], $fileName);
    return $this->productDao->uploadproductCSV($validated);
  }

  /**
   * To download product csv file
   * @return File Download CSV file
   */
  public function downloadProductCSV()
  {
    $productList = $this->productDao->getProductList();
    $filename = "product.csv";
    //write csv file
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('productName', 'price'));

    foreach ($productList as $row) {
      fputcsv($handle, array(
        $row->titproductNamele, $row->price
      ));
    }

    fclose($handle);

    $headers = array(
      'Content-Type' => 'text/csv',
    );

    return response()
      ->download($filename, $filename, $headers)
      ->deleteFileAfterSend();
  }
}