<?php


namespace App\Repositories\Impl;


use App\Models\Customer;
use App\Repositories\CustomerRepositoryImpl;
use App\Repositories\Eloquent\EloquentRepository;

class CustomerRepository extends EloquentRepository implements CustomerRepositoryImpl
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return Customer::class;
    }
}
