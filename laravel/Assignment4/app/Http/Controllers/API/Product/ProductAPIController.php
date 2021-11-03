<?php

namespace App\Http\Controllers\API\Product;

use App\Contracts\Services\Product\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateAPIRequest;
use App\Http\Requests\ProductEditAPIRequest;
use App\Http\Requests\ProductUploadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAPIController extends Controller
{
  /**
   * Product Interface
   */
  private $productInterface;

  public function __construct(ProductServiceInterface $productServiceInterface)
  {
    $this->productInterface = $productServiceInterface;
  }

  /**
   * This is to get product list.
   * @return Response json with product list
   */
  public function getProductList()
  {
    $productList = $this->productInterface->getProductList();
    return response()->json($productList);
  }

  /**
   * To delete product by id via api
   * @param string $productid user id
   * @return Response message
   */
  public function deleteProductById($productId)
  {
    $msg = $this->productInterface->deleteProductById($productId);
    return response(['message' => $msg]);
  }

  /**
   * To create product via API
   * @param ProductCreateAPIRequest $request request via API
   * @return Response json created user
   */
  public function createProduct(ProductCreateAPIRequest $request)
  {
    // validation for request values
    $validated = $request->validated();
    $product = $this->productInterface->saveProductAPI($validated);
    return response()->json($product);
  }

  /**
   * To Update product via API
   * @param ProductEditAPIRequest $request request via API
   * @param string $productId product id
   * @return Response json updated product.
   */
  public function updateProduct(ProductEditAPIRequest $request, $productId)
  {
    // validation for request values
    $validated = $request->validated();
    $product = $this->productInterface->updatedProductByIdAPI($validated, $productId);
    return response()->json($product);
  }

  /**
   * To get product by id via API
   * @param string $productId product id
   * @return Response json product object
   */
  public function getProductById($productId)
  {
    $product = $this->productInterface->getProductById($productId);
    return response()->json($product);
  }

  public function uploadProductCSVFile(ProductUploadRequest $request)
  {
    $validated = $request->validated();
    $content = $this->productInterface->uploadProductCSV($validated);
    if (!$content['isUploaded']) {
      return response()->json(['error' => $content['message']], JsonResponse::HTTP_BAD_REQUEST);
    } else {
      return response()->json(['message' => $content['message']]);
    }
  }
}
