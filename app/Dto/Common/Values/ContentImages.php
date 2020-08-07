<?php

namespace App\Dto\Common\Values;

class ContentImages
{
    /**
     * @var array
     */
    private $contentImages;
    /**
     * @var array
     */
    private $forRemoving;

    public function __construct(?array $contentImages, ?array $forRemoving)
    {
        $this->contentImages = $contentImages ?? [];
        $this->forRemoving = $forRemoving ?? [];
    }

    /**
     * @return array
     */
    public function getContentImages(): array
    {
        return $this->contentImages;
    }

    /**
     * @return array
     */
    public function getForRemoving(): array
    {
        return $this->forRemoving;
    }
}
