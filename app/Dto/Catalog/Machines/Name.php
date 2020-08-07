<?php

namespace App\Dto\Catalog\Machines;

class Name
{
    private $short;
    private $full;

    public function __construct(string $short, string $full)
    {
        $this->short = $short;
        $this->full = $full;
    }

    /**
     * @return string
     */
    public function getShort(): string
    {
        return $this->short;
    }

    /**
     * @return string
     */
    public function getFull(): string
    {
        return $this->full;
    }
}
