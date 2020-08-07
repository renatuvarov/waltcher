<?php

namespace App\Dto\Catalog\Machines;

use Webmozart\Assert\Assert;

class Description
{
    private $short;
    private $full;

    public function __construct(string $short, string $full)
    {
        Assert::stringNotEmpty($short);
        Assert::stringNotEmpty($full);

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
