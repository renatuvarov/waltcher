<?php

namespace App\UseCases\Catalog;

use App\Dto\Catalog\Machines\Dto;
use App\Entities\Catalog\Machine;
use App\Handlers\FileManager;
use App\Repositories\GalleryRepository;
use Illuminate\Support\Str;
use Psr\SimpleCache\CacheInterface;

class CreateMachine
{
    /**
     * @var FileManager
     */
    private $manager;
    /**
     * @var CacheInterface
     */
    private $cache;
    /**
     * @var GalleryRepository
     */
    private $galleryRepository;

    public function __construct(FileManager $manager, CacheInterface $cache, GalleryRepository $galleryRepository)
    {
        $this->manager = $manager;
        $this->cache = $cache;
        $this->galleryRepository = $galleryRepository;
    }

    public function action(Dto $dto): Machine
    {
        /** @var Machine $machine */
        $machine = Machine::query()->make([
            'name' => $dto->getName()->getFull(),
            'short_name' => $dto->getName()->getShort(),
            'short_description' => $dto->getDescription()->getShort(),
            'meta_description' => $dto->getMeta()->getDescription(),
            'description' => clean($dto->getDescription()->getFull(), 'youtube'),
            'mail' => $dto->getMailData()->getText(),
            'slug' => $dto->getSlug()->get(),
            'img' => $this->manager->load($dto->getMainImage(), 'machines'),
            'pdf' => $this->manager->load($dto->getMailData()->getPdf(), 'machine/pdf', true),
            'is_landing' => $dto->isLanding(),
            'type' => $dto->getType()->getType(),
            'images' => $dto->getContentImages()->getContentImages(),
        ]);

        if ($dto->hasGalleryId()) {
            $this->galleryRepository->findByIdOrFail($dto->getGalleryId())->withMachine($machine);
        }

        $machine->save();

        $machine->setTags($dto->getTags());
        $machine->setProperties($dto->getProperties());

        return $machine;
    }
}
