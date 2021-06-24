<?php


namespace App\Services\Impl;


use App\Repositories\CustomerRepositoryImpl;
use App\Services\CustomerServiceImpl;

class CustomerService implements CustomerServiceImpl
{
    protected CustomerRepositoryImpl $customerRepository;
    public function __construct(CustomerRepositoryImpl $customerRepository)
    {
        $this->customerRepository=$customerRepository;
    }

    public function getAll()
    {

        return $this->customerRepository->getAll();
    }

    public function findById($id)
    {
        $customer = $this->customerRepository->findById($id);

        $statusCode = 200;
        if (!$customer) {
            $statusCode = 404;
        }

        return [
            'statusCode' => $statusCode,
            'customers' => $customer
        ];
    }

    public function create($request)
    {
        $customer = $this->customerRepository->create($request);

        $statusCode = 201;
        if (!$customer) {
            $statusCode = 500;
        }

        return [
            'statusCode' => $statusCode,
            'customers' => $customer
        ];
    }

    public function update($request, $id)
    {
        $oldCustomer = $this->customerRepository->findById($id);

        if (!$oldCustomer) {
            $newCustomer = null;
            $statusCode = 404;
        } else {
            $newCustomer = $this->customerRepository->update($request, $oldCustomer);
            $statusCode = 200;
        }

        return [
            'statusCode' => $statusCode,
            'customers' => $newCustomer
        ];
    }

    public function destroy($id)
    {
        $customer = $this->customerRepository->findById($id);

        $statusCode = 404;
        $message = "User not found";
        if ($customer) {
            $this->customerRepository->destroy($customer);
            $statusCode = 200;
            $message = "Delete success!";
        }

        return [
            'statusCode' => $statusCode,
            'message' => $message
        ];
    }
}
