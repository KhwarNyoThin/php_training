<?php

namespace App\Http\Controllers\API\Customer;

use App\Contracts\Services\Customer\CustomerServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateAPIRequest;
use App\Http\Requests\CustomerEditAPIRequest;
use App\Http\Requests\CustomerUploadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAPIController extends Controller
{
  /**
   * Customer Interface
   */
  private $customerInterface;

  public function __construct(CustomerServiceInterface $customerServiceInterface)
  {
    $this->customerInterface = $customerServiceInterface;
  }

  /**
   * This is to get customer list.
   * @return Response json with customer list
   */
  public function getCustomerList()
  {
    $customerList = $this->customerInterface->getCustomerList();
    return response()->json($customerList);
  }

  /**
   * To delete customer by id via api
   * @param string $customerid user id
   * @return Response message
   */
  public function deleteCustomerById($customerId)
  {
    $deletedUserId = Auth::guard('api')->user()->id;
    $msg = $this->customerInterface->deleteCustomerById($customerId, $deletedUserId);
    return response(['message' => $msg]);
  }

  /**
   * To create customer via API
   * @param CustomerCreateAPIRequest $request request via API
   * @return Response json created user
   */
  public function createCustomer(CustomerCreateAPIRequest $request)
  {
    // validation for request values
    $validated = $request->validated();
    $customer = $this->customerInterface->saveCustomerAPI($validated);
    return response()->json($customer);
  }

  /**
   * To Update customer via API
   * @param CustomerEditAPIRequest $request request via API
   * @param string $customerId customer id
   * @return Response json updated customer.
   */
  public function updateCustomer(CustomerEditAPIRequest $request, $customerId)
  {
    // validation for request values
    $validated = $request->validated();
    $customer = $this->customerInterface->updatedCustomerByIdAPI($validated, $customerId);
    return response()->json($customer);
  }

  /**
   * To get customer by id via API
   * @param string $customerId customer id
   * @return Response json customer object
   */
  public function getCustomerById($customerId)
  {
    $customer = $this->customerInterface->getCustomerById($customerId);
    return response()->json($customer);
  }

  public function uploadCustomerCSVFile(CustomerUploadRequest $request)
  {
    $validated = $request->validated();
    $uploadedUserId = Auth::guard('api')->user()->id;
    $content = $this->customerInterface->uploadCustomerCSV($validated, $uploadedUserId);
    if (!$content['isUploaded']) {
      return response()->json(['error' => $content['message']], JsonResponse::HTTP_BAD_REQUEST);
    } else {
      return response()->json(['message' => $content['message']]);
    }
  }
}
