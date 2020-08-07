<?php

namespace App\Handlers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Psr\Log\LoggerInterface;

class FileManager
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function load($file, string $path, bool $local = false)
    {
        if ($file) {
            return ($local ? '' : $this->start()) . $file->store($path . $this->end(), $local ? 'local' : []);
        }
    }

    public function loadArray($files, string $path): array
    {
        return array_map(function ($item) use ($path) {
            return $this->load($item, $path);
        }, (array)$files);
    }

    public function replace(string $oldFile, UploadedFile $newFile, string $path, bool $local = false): string
    {
        $this->delete($oldFile, $local);
        return $this->load($newFile, $path, $local);
    }

    public function delete($files, bool $local = false): void
    {
        $disk = $this->getDisk($local);

        foreach ((array)$files as $file) {
            try {
                Storage::disk($disk)
                    ->delete($path = $this->preparePathToRemoval($file));
                $this->deleteDirIfEmpty($path, $disk);
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
    }

    private function getDisk(bool $local)
    {
        return $local ? 'local' : 'public';
    }

    private function preparePathToRemoval(string $file): string
    {
        return str_replace($this->start(), '', $file);
    }

    private function deleteDirIfEmpty(string $path, string $disk = 'public'): void
    {
        $dir = str_replace(basename($path), '', $path);

        if (empty(Storage::disk($disk)->allFiles($dir))) {
            Storage::disk($disk)->deleteDirectory($dir);
        }
    }

    private function start(): string
    {
        return '/storage/';
    }

    private function end(): string
    {
        return '/' . date('dmY');
    }
}
