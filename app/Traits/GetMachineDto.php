<?php

namespace App\Traits;

use App\Dto\Catalog\Machines\Description;
use App\Dto\Catalog\Machines\Dto;
use App\Dto\Catalog\Machines\MailData;
use App\Dto\Common\Values\Meta;
use App\Dto\Catalog\Machines\Name;
use App\Dto\Catalog\Machines\Properties;
use App\Dto\Catalog\Machines\Tags;
use App\Dto\Catalog\Machines\Type;
use App\Dto\Common\Values\ContentImages;
use App\Dto\Common\Values\Slug;

trait GetMachineDto
{
    public function getDto(): Dto
    {
        return new Dto(
            new Name($this->input('short_name'), $this->input('name')),
            new Description($this->input('short_description'), $this->input('description')),
            new MailData(
                $this->input('mail'),
                $this->file('pdf'),
                $this->input('remove_pdf')
            ),
            new Meta($this->input('meta_description', $this->input('name'))),
            $this->file('img'),
            new ContentImages($this->input('images'), $this->input('for_removing')),
            new Properties($this->input('properties')),
            new Tags($this->input('tags')),
            new Slug($this->input('slug') ?? $this->input('name')),
            new Type($this->input('type')),
            $this->input('gallery_id'),
            $this->input('is_landing') ?? false
        );
    }
}
