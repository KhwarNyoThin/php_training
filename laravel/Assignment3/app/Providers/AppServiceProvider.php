<?php

namespace App\Providers;

use App\Contracts\Dao\Customer\CustomerDaoInterface;
use App\Contracts\Services\Customer\CustomerServiceInterface;
use App\Dao\Customer\CustomerDao;
use App\Services\Customer\CustomerService;


use App\Contracts\Dao\Product\ProcuctDaoInterface;
use App\Contracts\Dao\Product\ProductDaoInterface;
use App\Contracts\Services\Product\ProductServiceInterface;
use App\Dao\Product\ProductDao;
use App\Services\Product\ProductService;

use App\Contracts\Dao\Sale\SaleDaoInterface;
use App\Contracts\Services\Sale\SaleServiceInterface;
use App\Dao\Sale\SaleDao;
use App\Services\Sale\SaleService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(CustomerDaoInterface::class, CustomerDao::class);
      $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
      $this->app->bind(ProductDaoInterface::class, ProductDao::class);
      $this->app->bind(ProductServiceInterface::class, ProductService::class);
      $this->app->bind(SaleDaoInterface::class, SaleDao::class);
      $this->app->bind(SaleServiceInterface::class, SaleService::class);
      
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
