<?php

namespace App\Dto\Catalog\Machines;

class Tags
{
    /**
     * @var array
     */
    private $tags;

    public function __construct(?array $tags)
    {
        $this->tags = $tags ?? [];
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
