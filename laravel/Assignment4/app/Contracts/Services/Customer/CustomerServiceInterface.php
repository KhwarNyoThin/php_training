<?php 

namespace App\Contracts\Services\Customer;

use Illuminate\Http\Request;

interface CustomerServiceInterface {

  /**
   * To get customer list
   * @return array $customerList customer list
   */
  public function getCustomerList();

  /**
   * To save customer
   * @param Request $request request with inputs
   * @return Object $customer saved customer
   */
  public function saveCustomer(Request $request);

  /**
   * To get Customer by id
   * @param string $id Customer id
   * @return Object $Customer Customer object
   */
  public function getCustomerById($id);
 
  /**
   * To update Customer by id
   * @param Request $request request with inputs
   * @param string $id Customer id
   * @return Object $Customer Customer Object
   */
  public function updatedCustomerById(Request $request, $id);

  /**
   * To delete customer by id
   * @param string $id customer id
   * @return string $message message success or not
   */
  public function deleteCustomerById($id);

  /**
   * To upload csv file for Customer
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadCustomerCSV($validated);

  /**
   * To download Customer csv file
   */
  public function downloadCustomerCSV();

  /**
   * To save Customer via API
   * @param array $validated Validated values from request
   * @return Object created Customer object
   */
  public function saveCustomerAPI($validated);

  /**
   * To update Customer by id via api
   * @param array $validated Validated values from request
   * @param string $CustomerId Customer id
   * @return Object $Customer Customer Object
   */
  public function updatedCustomerByIdAPI($validated, $customerId);
  
}