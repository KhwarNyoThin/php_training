<?php

namespace App\Http\Controllers\Customer;

use App\Contracts\Services\Customer\CustomerServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerEditRequest;
use App\Http\Requests\CustomerUploadRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
  private $customerService;

  public function __construct(CustomerServiceInterface $customerService) 
  {
    $this->customerService = $customerService;
  }

  /**
   * To show Customer list
   *
   * @return View Customer list
   */
  public function showCustomerList()
  {
    
    $customerList = $this->customerService->getCustomerList();
    
    // info($customerList);
    return view('customer.list', compact('customerList'));
  }

  /**
   * To delete Customer by id
   * @return View Customer list
   */
  public function deleteCustomerById($customerId)
  {
    $msg = $this->customerService->deleteCustomerById($customerId);
    return redirect()->route('customerlist');
  }

  /**
   * To show create customer view
   * 
   * @return View create customer
   */
  public function showcustomerCreateView()
  {
    return view('customer\create');
  }

  /**
   * To check customer create form and redirect to confirm page.
   * @param customerCreateRequest $request Request form customer create
   * @return View customer create confirm
   */
  public function submitCustomerCreateView(CustomerCreateRequest $request)
  {
    // validation for request values
    $validated = $request->validated();
    return redirect()
      ->route('customer.create.confirm')
      ->withInput();
  }

  /**
   * To show customer create confirm view
   *
   * @return View customer create confirm view
   */
  public function showCustomerCreateConfirmView()
  {
    if (old()) {
      return view('customer.create-confirm');
    }
    return redirect()->route('customerlist');
  }

  /**
   * To submit customer create confirm view
   * @param Request $request
   * @return View customer list
   */
  public function submitCustomerCreateConfirmView(Request $request)
  {
    $customer = $this->customerService->saveCustomer($request);
    return redirect()->route('customerlist');
  }

  /**
   * To submit Customer create confirm view
   * @param Request $request
   * @return View Customer list
   */
  

  /**
   * Show customer edit
   * 
   * @return View customer edit
   */
  public function showCustomerEdit($customerId)
  {
    $customer = $this->customerService->getCustomerById($customerId);
    return view('customer.edit', compact('customer'));
  }

  /**
   * Submit customer edit
   * @param Request $request
   * @param $customerId
   * @return View customer edit confirm view
   */
  public function submitCustomerEditView(CustomerEditRequest $request, $customerId)
  {
    // validation for request values
    $validated = $request->validated();
    return redirect()
      ->route('customer.edit.confirm', [$customerId])
      ->withInput();
  }

  /**
   * To show customer edit confirm view
   * @param $customerId
   * @return View customer edit confirm view
   */
  public function showCustomerEditConfirmView($customerId)
  {
    if (old()) {
      return view('customer.edit-confirm');
    }
    return redirect()->route('customerlist');
  }

  /**
   * To submit profile edit confirmation view
   * @param Request $request Request from customer edit confirm
   * @param string $customerId customer id
   * @return View customer list
   */
  public function submitCustomerEditConfirmView(Request $request, $customerId)
  {
    $customer = $this->customerService->updatedCustomerById($request, $customerId);
    return redirect()->route('customerlist');
  }

  /**
   * To show create customer view
   * 
   * @return View create customer
   */
  public function showCustomerUploadView()
  {
    return view('customer.upload');
  }

  /**
   * To submit CSV upload view
   * 
   * @param Request $request Request from customer upload
   * @return view customer list
   */
  public function submitCustomerUploadView(CustomerUploadRequest $request)
  {
    // validation for request values
    $validated = $request->validated();
    $content = $this->customerService->uploadcustomerCSV($validated);
    if (!$content['isUploaded']) {
      return redirect('/customer/upload')->with('error', $content['message']);
    } else {
      return redirect()->route('customerlist');
    }
  }

  /**
   * To download customer csv file
   * @return File Download CSV file
   */
  public function downloadCustomerCSV()
  {
    return $this->customerService->downloadCustomerCSV();
  }


  /**
   * To search customer with all keywords
   * @return view customer list
   */
  public function searchCustomer()
  {
    $from = $_GET['from-date'];
    $to = $_GET['to-date'];
    $search_text = $_GET['search-text'];

    if($search_text != "") {
      $customerList = Customer::where('customerName', 'LIKE', '%'.$search_text.'%')
      ->orWhere('address', 'LIKE', '%'.$search_text.'%')
      ->orWhere('phone', 'LIKE', '%'.$search_text.'%')
      ->orWhere('email', 'LIKE', '%'.$search_text.'%')
      ->get();
    }
    else {
      $customerList = Customer::where('created_at', '>=', $from)
      ->where('created_at', '<=', $to)
      ->get();
    }

    return view('customer.list', compact('customerList'));
  }


}
