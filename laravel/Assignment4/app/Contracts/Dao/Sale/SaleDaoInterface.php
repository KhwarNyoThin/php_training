<?php

namespace App\Contracts\Dao\Sale;

use Illuminate\Http\Request;

interface SaleDaoInterface {

  /**
   * To get sale list
   * @return $saleList
   */
  public function getSaleList();

  /**
   * To save sale
   * @param Request $request request with inputs
   * @return Object $sale saved sale
   */
  public function saveSale(Request $request);

  /**
   * To get Sale by id
   * @param string $id Sale id
   * @return Object $Sale Sale object
   */
  public function getSaleById($id);
 
  /**
   * To update Sale by id
   * @param Request $request request with inputs
   * @param string $id Sale id
   * @return Object $Sale Sale Object
   */
  public function updatedSaleById(Request $request, $id);

  /**
   * To delete Sale by id
   * @param string $id Sale id
   * @return string $message message success or not
   */
  public function deleteSaleById($id);

  /**
   * To upload csv file for Sale
   * @param array $validated Validated values
   * @param string $uploadedUserId uploaded user id
   * @return array $content Message and Status of CSV Uploaded or not
   */
  public function uploadSaleCSV($validated);

  /**
   * To save Sale via API
   * @param array $validated Validated values from request
   * @return Object created Sale object
   */
  public function saveSaleAPI($validated);

  /**
   * To update Sale by id via api
   * @param array $validated Validated values from request
   * @param string $SaleId Sale id
   * @return Object $Sale Sale Object
   */
  // public function updatedSaleByIdAPI($validated, $saleId);
}