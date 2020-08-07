<?php

namespace App\Dto\Catalog\Machines;

use App\Entities\Catalog\Machine;
use Webmozart\Assert\Assert;

class Type
{
    private $type;

    public function __construct(string $type)
    {
        Assert::stringNotEmpty($type);
        Assert::oneOf($type, array_keys(Machine::getTypes()));

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
