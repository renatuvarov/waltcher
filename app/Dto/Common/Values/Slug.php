<?php

namespace App\Dto\Common\Values;

use Illuminate\Support\Str;
use Webmozart\Assert\Assert;

class Slug
{
    private $slug;

    public function __construct(string $slug)
    {
        Assert::stringNotEmpty($slug);

        $this->slug = Str::slug(mb_strtolower($slug));
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->slug;
    }
}
