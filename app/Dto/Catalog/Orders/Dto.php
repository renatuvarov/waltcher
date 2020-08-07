<?php

namespace App\Dto\Catalog\Orders;

class Dto
{
    private $customer_name;
    private $customer_email;
    private $customer_company;
    private $customer_phone;
    private $machine_id;

    public function __construct(
        string $customer_name,
        string $customer_email,
        string $customer_company,
        ?string $customer_phone,
        int $machine_id)
    {
        $this->customer_name = $customer_name;
        $this->customer_email = $customer_email;
        $this->customer_company = $customer_company;
        $this->customer_phone = $customer_phone ?? '';
        $this->machine_id = $machine_id;
    }

    public function getMachineId(): int
    {
        return $this->machine_id;
    }

    public function getName(): string
    {
        return $this->customer_name;
    }

    public function getEmail(): string
    {
        return $this->customer_email;
    }

    public function getCompany(): string
    {
        return $this->customer_company;
    }

    public function getPhone(): string
    {
        return $this->customer_phone;
    }
}
