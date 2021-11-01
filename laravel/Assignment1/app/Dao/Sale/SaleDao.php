<?php

namespace App\Dao\Sale;


use App\Models\Sale;
use App\Contracts\Dao\Sale\SaleDaoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleDao implements SaleDaoInterface {

  /**
   * To get post list
   * @return array $postList Post list
   */
  public function getSaleList()
  {
    $saleList = DB::table('sale')
        // ->join('sale', 'sale.id', '=', 'sale.saleID')
        // ->join('product', 'product.id', '=', 'sale.productID')
        ->whereNull('sale.deleted_at')
        ->get();
    return $saleList;
  }

  /**
   * To save sale
   * @param Request $request request with inputs
   * @return Object $sale saved sale
   */
  public function saveSale(Request $request)
  {
    $sale = new sale();
    $sale->saleID = $request['saleID'];
    $sale->productID = $request['productID'];
    $sale->ordered_date = $request['ordered_date'];
    $sale->save();
    return $sale;
  }

  /**
   * To get sale by id
   * @param string $id sale id
   * @return Object $sale sale object
   */
  public function getSaleById($id)
  {
    $sale = sale::find($id);
    return $sale;
  }

  /**
   * To update sale by id
   * @param Request $request request with inputs
   * @param string $id sale id
   * @return Object $sale sale Object
   */
  public function updatedSaleById(Request $request, $id)
  {
    $sale = sale::find($id);
    $sale->saleID = $request['saleID'];
    $sale->productID = $request['productID'];
    $sale->ordered_date = $request['ordered_date'];
    
    $sale->save();
    return $sale;
  }



  /**
   * To delete sale by id
   * @param string $id sale id
   * @return string $message message success or not
   */
  public function deleteSaleById($id)
  {
    $sale = Sale::find($id);
    if ($sale) {
      $sale->save();
      $sale->delete();
      return 'Deleted Successfully!';
    }
    return 'Sale Not Found!';
  }


  /**
   * To upload csv file for sale
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadSaleCSV($validated)
  {
    $path =  $validated['csv_file']->getRealPath();
    $csv_data = array_map('str_getcsv', file($path));
    // save sale to Database accoding to csv row
    foreach ($csv_data as $index => $row) {
      if (count($row) >= 2) {
        try {
          $sale = new sale();
          $sale->customerID = $row[0];
          $sale->productID = $row[1];
          $sale->ordered_date = $row[2];
          $sale->save();
        } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          //error handling for duplicated sale
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
   * To save sale via API
   * @param array $validated Validated values from request
   * @return Object created sale object
   */
  public function saveSaleAPI($validated)
  {
    $sale = new sale();
    $sale->saleName = $validated['saleName'];
    $sale->address = $validated['address'];
    $sale->save();
    return $sale;
  }

}