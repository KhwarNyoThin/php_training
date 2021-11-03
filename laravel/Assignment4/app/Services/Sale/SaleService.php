<?php

namespace App\Services\Sale;

use App\Contracts\Dao\Sale\SaleDaoInterface;
use App\Contracts\Services\Sale\SaleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaleService implements SaleServiceInterface {

  private $saleDao;
  public function __construct(SaleDaoInterface $saleDao)
  {
    $this->saleDao = $saleDao;
  }

  /**
   * To get post list
   * @return array $postList Post list
   */
  public function getSaleList()
  {
    return $this->saleDao->getSaleList();
  }

  /**
   * To save sale
   * @param Request $request request with inputs
   * @return Object $sale saved sale
   */
  public function saveSale(Request $request)
  {
    return $this->saleDao->saveSale($request);
  }

  /**
   * To get sale by id
   * @param string $id sale id
   * @return Object $sale sale object
   */
  public function getSaleById($id)
  {
    return $this->saleDao->getsaleById($id);
  }

  /**
   * To update sale by id
   * @param Request $request request with inputs
   * @param string $id sale id
   * @return Object $sale sale Object
   */
  public function updatedSaleById(Request $request, $id)
  {
    return $this->saleDao->updatedSaleById($request, $id);
  }

  /**
   * To delete sale by id
   * @param string $id sale id
   * @return string $message message success or not
   */
  public function deleteSaleById($id)
  {
    return $this->saleDao->deleteSaleById($id);
  }

  /**
   * To upload csv file for sale
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadSaleCSV($validated)
  {
    $fileName = $validated['csv_file']->getClientOriginalName();
    Storage::putFileAs(config('path.csv').
      config('path.separator'), $validated['csv_file'], $fileName);
    return $this->saleDao->uploadSaleCSV($validated);
  }

  /**
   * To download sale csv file
   * @return File Download CSV file
   */
  public function downloadSaleCSV()
  {
    $saleList = $this->saleDao->getSaleList();
    $filename = "sale.csv";
    //write csv file
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('customerID', 'productID', 'ordered_date'));

    foreach ($saleList as $row) {
      fputcsv($handle, array(
        $row->custoemerID, $row->productID, $row->ordered_date
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