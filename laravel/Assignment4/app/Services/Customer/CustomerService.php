<?php

namespace App\Services\Customer;

use App\Contracts\Dao\Customer\CustomerDaoInterface;
use App\Contracts\Services\Customer\CustomerServiceInterface;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerService implements CustomerServiceInterface {

  private $customerDao;
  public function __construct(CustomerDaoInterface $customerDao)
  {
    $this->customerDao = $customerDao;
  }

  /**
   * To get customer list
   * @return array $customerList customer list
   */
  public function getCustomerList()
  {
    return $this->customerDao->getCustomerList();
  }

  /**
   * To save customer
   * @param Request $request request with inputs
   * @return Object $customer saved customer
   */
  public function saveCustomer(Request $request)
  {
    return $this->customerDao->saveCustomer($request);
  }

  /**
   * To get customer by id
   * @param string $id customer id
   * @return Object $customer customer object
   */
  public function getCustomerById($id)
  {
    return $this->customerDao->getcustomerById($id);
  }

  /**
   * To update customer by id
   * @param Request $request request with inputs
   * @param string $id customer id
   * @return Object $customer customer Object
   */
  public function updatedCustomerById(Request $request, $id)
  {
    return $this->customerDao->updatedCustomerById($request, $id);
  }



  /**
   * To delete customer by id
   * @param string $id customer id
   * @return string $message message success or not
   */
  public function deleteCustomerById($id)
  {
    return $this->customerDao->deleteCustomerById($id);
  }


  /**
   * To upload csv file for customer
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadCustomerCSV($validated)
  {
    $fileName = $validated['csv_file']->getClientOriginalName();
    Storage::putFileAs(config('path.csv').
      config('path.separator'), $validated['csv_file'], $fileName);
    return $this->customerDao->uploadcustomerCSV($validated);
  }

  /**
   * To download customer csv file
   * @return File Download CSV file
   */
  public function downloadCustomerCSV()
  {
    $customerList = $this->customerDao->getCustomerList();
    $filename = "customer.csv";
    //write csv file
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('customerName', 'address', 'phone', 'email'));

    foreach ($customerList as $row) {
      fputcsv($handle, array(
        $row->titcustomerNamele, $row->address, $row->phone, $row->email
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

  /**
   * To save customer via API
   * @param array $validated Validated values from request
   * @return Object created customer object
   */
  public function saveCustomerAPI($validated)
  {
    return $this->customerDao->saveCustomerAPI($validated);
  }

  /**
   * To update customer by id via api
   * @param array $validated Validated values from request
   * @param string $id Customer id
   * @return Object $customer Customer Object
   */
  public function updatedCustomerByIdAPI($validated, $customerId)
  {
    return $this->customerDao->updatedCustomerByIdAPI($validated, $customerId);
  }
}