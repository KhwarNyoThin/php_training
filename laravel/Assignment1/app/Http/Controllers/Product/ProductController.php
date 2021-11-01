<?php

namespace App\Http\Controllers\Product;

use App\Contracts\Services\Product\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductUploadRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  private $productService;

  public function __construct(ProductServiceInterface $productService) 
  {
    $this->productService = $productService; 
  }

  /**
   * To show post list
   *
   * @return View Post list
   */
  public function showProductList()
  {
    
    $productList = $this->productService->getProductList();
    
    return view('product.list', compact('productList'));
  }

  /**
   * To delete Product by id
   * @return View Product list
   */
  public function deleteProductById($productId)
  {
    $msg = $this->productService->deleteProductById($productId);
    return redirect()->route('productlist');
  }

  /**
   * To show create product view
   * 
   * @return View create product
   */
  public function showProductCreateView()
  {
    return view('product\create');
  }

  /**
   * To check product create form and redirect to confirm page.
   * @param productCreateRequest $request Request form product create
   * @return View product create confirm
   */
  public function submitProductCreateView(ProductCreateRequest $request)
  {
    // validation for request values
    $validated = $request->validated();
    return redirect()
      ->route('product.create.confirm')
      ->withInput();
  }

  /**
   * To show product create confirm view
   *
   * @return View product create confirm view
   */
  public function showProductCreateConfirmView()
  {
    if (old()) {
      return view('product.create-confirm');
    }
    return redirect()->route('productlist');
  }

  /**
   * To submit product create confirm view
   * @param Request $request
   * @return View product list
   */
  public function submitProductCreateConfirmView(Request $request)
  {
    $product = $this->productService->saveproduct($request);
    return redirect()->route('productlist');
  }

  /**
   * Show product edit
   * 
   * @return View product edit
   */
  public function showProductEdit($productId)
  {
    $product = $this->productService->getProductById($productId);
    return view('product.edit', compact('product'));
  }

  /**
   * Submit product edit
   * @param Request $request
   * @param $productId
   * @return View product edit confirm view
   */
  public function submitProductEditView(ProductEditRequest $request, $productId)
  {
    // validation for request values
    $validated = $request->validated();
    return redirect()
      ->route('product.edit.confirm', [$productId])
      ->withInput();
  }

  /**
   * To show product edit confirm view
   * @param $productId
   * @return View product edit confirm view
   */
  public function showProductEditConfirmView($productId)
  {
    if (old()) {
      return view('product.edit-confirm');
    }
    return redirect()->route('productlist');
  }

  /**
   * To submit profile edit confirmation view
   * @param Request $request Request from product edit confirm
   * @param string $productId product id
   * @return View product list
   */
  public function submitProductEditConfirmView(Request $request, $productId)
  {
    $product = $this->productService->updatedProductById($request, $productId);
    return redirect()->route('productlist');
  }

  /**
   * To show create product view
   * 
   * @return View create product
   */
  public function showProductUploadView()
  {
    return view('product.upload');
  }

  /**
   * To submit CSV upload view
   * 
   * @param Request $request Request from product upload
   * @return view product list
   */
  public function submitProductUploadView(ProductUploadRequest $request)
  {
    // validation for request values
    $validated = $request->validated();
    $content = $this->productService->uploadproductCSV($validated);
    if (!$content['isUploaded']) {
      return redirect('/product/upload')->with('error', $content['message']);
    } else {
      return redirect()->route('productlist');
    }
  }

  /**
   * To download product csv file
   * @return File Download CSV file
   */
  public function downloadProductCSV()
  {
    return $this->productService->downloadProductCSV();
  }
}
