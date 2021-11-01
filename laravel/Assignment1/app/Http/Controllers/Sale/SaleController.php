<?php

namespace App\Http\Controllers\Sale;

use App\Contracts\Services\Sale\SaleServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleCreateRequest;
use App\Http\Requests\SaleEditRequest;
use App\Http\Requests\SaleUploadRequest;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
  private $saleService;

  public function __construct(SaleServiceInterface $saleService) 
  { 
    $this->saleService = $saleService;
  }

  /**
   * To show post list
   *
   * @return View Post list
   */
  public function showSaleList()
  {
    
    $saleList = $this->saleService->getSaleList();
    
    info($saleList);
    return view('sale.list', compact('saleList'));
  }

  /**
   * To delete Sale by id
   * @return View Sale list
   */
  public function deleteSaleById($saleId)
  {
    $msg = $this->saleService->deleteSaleById($saleId);
    return redirect()->route('salelist');
  }

  /**
   * To show create Sale view
   * 
   * @return View create Sale
   */
  public function showSaleCreateView()
  {
    info("to confirm page");
    return view('sale\create');
  }

  /**
   * To check Sale create form and redirect to confirm page.
   * @param SaleCreateRequest $request Request form Sale create
   * @return View Sale create confirm
   */
  public function submitSaleCreateView(SaleCreateRequest $request)
  {
    info("to confirm page");
    // validation for request values
    $validated = $request->validated();
    info("to confirm page");
    return redirect()
      ->route('sale.create.confirm')
      ->withInput();
  }

  /**
   * To show Sale create confirm view
   *
   * @return View Sale create confirm view
   */
  public function showSaleCreateConfirmView()
  {
    if (old()) {
      return view('sale.create-confirm');
    }
    return redirect()->route('salelist');
  }

  /**
   * To submit Sale create confirm view
   * @param Request $request
   * @return View Sale list
   */
  public function submitSaleCreateConfirmView(Request $request)
  {
    $Sale = $this->saleService->saveSale($request);
    return redirect()->route('salelist');
  }

  /**
   * Show sale edit
   * 
   * @return View sale edit
   */
  public function showSaleEdit($saleId)
  {
    $sale = $this->saleService->getSaleById($saleId);
    return view('sale.edit', compact('sale'));
  }

  /**
   * Submit sale edit
   * @param Request $request
   * @param $saleId
   * @return View sale edit confirm view
   */
  public function submitSaleEditView(SaleEditRequest $request, $saleId)
  {
    // validation for request values
    $validated = $request->validated();
    return redirect()
      ->route('sale.edit.confirm', [$saleId])
      ->withInput();
  }

  /**
   * To show sale edit confirm view
   * @param $saleId
   * @return View sale edit confirm view
   */
  public function showSaleEditConfirmView($saleId)
  {
    if (old()) {
      return view('sale.edit-confirm');
    }
    return redirect()->route('salelist');
  }

  /**
   * To submit profile edit confirmation view
   * @param Request $request Request from sale edit confirm
   * @param string $saleId sale id
   * @return View sale list
   */
  public function submitSaleEditConfirmView(Request $request, $saleId)
  {
    $user = $this->saleService->updatedSaleById($request, $saleId);
    return redirect()->route('salelist');
  }

  /**
   * To show create sale view
   * 
   * @return View create sale
   */
  public function showSaleUploadView()
  {
    return view('sale.upload');
  }

  /**
   * To submit CSV upload view
   * 
   * @param Request $request Request from sale upload
   * @return view sale list
   */
  public function submitSaleUploadView(SaleUploadRequest $request)
  {
    // validation for request values
    $validated = $request->validated();
    $content = $this->saleService->uploadsaleCSV($validated);
    if (!$content['isUploaded']) {
      return redirect('/sale/upload')->with('error', $content['message']);
    } else {
      return redirect()->route('salelist');
    }
  }

  /**
   * To download sale csv file
   * @return File Download CSV file
   */
  public function downloadSaleCSV()
  {
    return $this->saleService->downloadSaleCSV();
  }
}
