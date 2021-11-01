<?php 

namespace App\Contracts\Services\Product;

use Illuminate\Http\Request;

interface ProductServiceInterface {
 
  /**
   * To get product list
   * @return array $productList product list
   */
  public function getProductList();

  /**
   * To save product
   * @param Request $request request with inputs
   * @return Object $product saved product
   */
  public function saveProduct(Request $request);

  /**
   * To get Product by id
   * @param string $id Product id
   * @return Object $Product Product object
   */
  public function getProductById($id);
 
  /**
   * To update Product by id
   * @param Request $request request with inputs
   * @param string $id Product id
   * @return Object $Product Product Object
   */
  public function updatedProductById(Request $request, $id);

  /**
   * To delete Product by id
   * @param string $id Product id
   * @return string $message message success or not
   */
  public function deleteProductById($id);

  /**
   * To upload csv file for Product
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadProductCSV($validated);

  /**
   * To download Product csv file
   */
  public function downloadProductCSV();

  /**
   * To save Product via API
   * @param array $validated Validated values from request
   * @return Object created Product object
   */
  // public function saveProductAPI($validated);

  
  
}