<?php

namespace App\Dao\Customer;

use App\Contracts\Dao\Customer\CustomerDaoInterface;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerDao implements CustomerDaoInterface {

  /**
   * To get customer list
   * @return array $customerList customer list
   */
  public function getCustomerList()
  {
    $customerList = Customer::all();
    return $customerList;
  }

  /**
   * To save customer
   * @param Request $request request with inputs
   * @return Object $customer saved customer
   */
  public function saveCustomer(Request $request)
  {
    $customer = new customer();
    $customer->customerName = $request['customerName'];
    $customer->address = $request['address'];
    $customer->phone = $request['phone'];
    $customer->email = $request['emil'];
    $customer->save();
    return $customer;
  }

  /**
   * To get customer by id
   * @param string $id customer id
   * @return Object $customer customer object
   */
  public function getCustomerById($id)
  {
    $customer = customer::find($id);
    return $customer;
  }

  /**
   * To update customer by id
   * @param Request $request request with inputs
   * @param string $id customer id
   * @return Object $customer customer Object
   */
  public function updatedCustomerById(Request $request, $id)
  {
    $customer = customer::find($id);
    $customer->customerName = $request['customerName'];
    $customer->address = $request['address'];
    $customer->phone = $request['phone'];
    $customer->email = $request['email'];
    
    $customer->save();
    return $customer;
  }

  /**
   * To delete customer by id
   * @param string $id customer id
   * @return string $message message success or not
   */
  public function deleteCustomerById($id)
  {
    $customer = Customer::find($id);
    if ($customer) {
      $customer->save();
      $customer->delete();
      return 'Deleted Successfully!';
    }
    return 'Customer Not Found!';
  }

  /**
   * To upload csv file for customer
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadCustomerCSV($validated)
  {
    $path =  $validated['csv_file']->getRealPath();
    $csv_data = array_map('str_getcsv', file($path));
    // save customer to Database accoding to csv row
    foreach ($csv_data as $index => $row) {
      if (count($row) >= 2) {
        try {
          $customer = new customer();
          $customer->customerName = $row[0];
          $customer->address = $row[1];
          $customer->phone = $row[2];
          $customer->email = $row[3];
          $customer->save();
        } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          //error handling for duplicated customer
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
   * To save customer via API
   * @param array $validated Validated values from request
   * @return Object created customer object
   */
  public function saveCustomerAPI($validated)
  {
    $customer = new customer();
    $customer->customerName = $validated['customerName'];
    $customer->address = $validated['address'];
    $customer->address = $validated['phone'];
    $customer->address = $validated['email'];
    $customer->save();
    return $customer;
  }
}