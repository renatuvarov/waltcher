<?php

namespace App\Dto\Catalog\Machines;

use App\Dto\Common\Values\ContentImages;
use App\Dto\Common\Values\Meta;
use App\Dto\Common\Values\Slug;
use Illuminate\Http\UploadedFile;

class Dto
{
    /**
     * @var Name
     */
    private $name;

    /**
     * @var Description
     */
    private $description;

    /**
     * @var MailData
     */
    private $mailData;

    /**
     * @var Meta
     */
    private $meta;

    /**
     * @var UploadedFile|null
     */
    private $mainImage;

    /**
     * @var ContentImages
     */
    private $contentImages;

    /**
     * @var Properties
     */
    private $properties;

    /**
     * @var Tags
     */
    private $tags;

    /**
     * @var Slug
     */
    private $slug;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var int|null
     */
    private $gallery_id;
    /**
     * @var bool|null
     */
    private $is_landing;

    public function __construct(
        Name $name,
        Description $description,
        MailData $mailData,
        Meta $meta,
        ?UploadedFile $mainImage,
        ContentImages $contentImages,
        Properties $properties,
        Tags $tags,
        Slug $slug,
        Type $type,
        ?int $gallery_id,
        ?bool $is_landing)
    {
        $this->name = $name;
        $this->description = $description;
        $this->mailData = $mailData;
        $this->meta = $meta;
        $this->mainImage = $mainImage;
        $this->contentImages = $contentImages;
        $this->properties = $properties;
        $this->tags = $tags;
        $this->slug = $slug;
        $this->type = $type;
        $this->gallery_id = $gallery_id;
        $this->is_landing = $is_landing;
    }

    /**
     * @return bool|null
     */
    public function isLanding(): ?bool
    {
        return $this->is_landing;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /**
     * @return MailData
     */
    public function getMailData(): MailData
    {
        return $this->mailData;
    }

    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }

    /**
     * @return UploadedFile|null
     */
    public function getMainImage(): ?UploadedFile
    {
        return $this->mainImage;
    }

    /**
     * @return ContentImages
     */
    public function getContentImages(): ContentImages
    {
        return $this->contentImages;
    }

    /**
     * @return Properties
     */
    public function getProperties(): Properties
    {
        return $this->properties;
    }

    /**
     * @return Tags
     */
    public function getTags(): Tags
    {
        return $this->tags;
    }

    /**
     * @return Slug
     */
    public function getSlug(): Slug
    {
        return $this->slug;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getGalleryId(): ?int
    {
        return $this->gallery_id;
    }

    public function hasGalleryId(): bool
    {
        return ! is_null($this->gallery_id);
    }
}
