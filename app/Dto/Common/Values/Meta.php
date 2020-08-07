<?php

namespace App\Dto\Common\Values;

use Webmozart\Assert\Assert;

class Meta
{
    private $description;

    public function __construct(string $description)
    {
        Assert::stringNotEmpty($description);
        Assert::lengthBetween($description, 10, 255);

        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
