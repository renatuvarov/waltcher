<?php

namespace App\UseCases\Catalog;

use App\Contracts\UpdatesContentImages;
use App\Dto\Catalog\Machines\Dto;
use App\Dto\Catalog\Machines\MailData;
use App\Entities\Catalog\Machine;
use App\Handlers\FileManager;
use App\Repositories\GalleryRepository;
use App\Traits\UpdatesImagesTrait;
use Illuminate\Http\UploadedFile;

class UpdateMachine implements UpdatesContentImages
{
    use UpdatesImagesTrait;

    /**
     * @var FileManager
     */
    private $manager;

    /**
     * @var GalleryRepository
     */
    private $galleryRepository;

    public function __construct(FileManager $manager, GalleryRepository $galleryRepository)
    {
        $this->manager = $manager;
        $this->galleryRepository = $galleryRepository;
    }

    public function action(Machine $machine, Dto $dto): Machine
    {
        $machine->setTags($dto->getTags());
        $machine->setProperties($dto->getProperties());

        if ($dto->hasGalleryId()) {
            $this->galleryRepository->findByIdOrFail($dto->getGalleryId())->withMachine($machine);
        }

        $machine->update([
            'name' => $dto->getName()->getFull(),
            'short_name' => $dto->getName()->getShort(),
            'short_description' => $dto->getDescription()->getShort(),
            'meta_description' => $dto->getMeta()->getDescription(),
            'description' => clean($dto->getDescription()->getFull(), 'youtube'),
            'mail' => $dto->getMailData()->getText(),
            'slug' => $dto->getSlug()->get(),
            'img' => $this->mainImage($dto->getMainImage(), $machine),
            'is_landing' => $dto->isLanding(),
            'type' => $dto->getType()->getType(),
            'pdf' => $this->pdf($machine, $dto->getMailData()),
            'images' => empty(
                $images = $this->updateImagesList(
                    $dto->getContentImages()->getContentImages(),
                    $dto->getContentImages()->getForRemoving()
                )
            ) ? null : $images,
        ]);

        return $machine;
    }

    private function mainImage(?UploadedFile $new, Machine $machine)
    {
        return is_null($new) ? $machine->img : $this->manager->replace(
            $machine->img, $new, 'machines'
        );
    }

    private function pdf(Machine $machine, MailData $data)
    {
        if ($data->removePdf()) {
            $this->manager
                ->delete($machine->pdf, true);
        } elseif ($data->hasPdf()) {
            return $this->manager
                ->replace((string)$machine->pdf, $data->getPdf(), 'machine/pdf', true);
        }

        return null;
    }
}
