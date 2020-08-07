<?php

namespace App\Dto\Catalog\Machines;

use Illuminate\Http\UploadedFile;
use Webmozart\Assert\Assert;

class MailData
{
    /**
     * @var string
     */
    private $text;
    /**
     * @var UploadedFile|null
     */
    private $pdf;
    /**
     * @var bool
     */
    private $removePdf;

    public function __construct(string $text, ?UploadedFile $pdf, ?bool $removePdf)
    {
        Assert::stringNotEmpty($text);

        $this->text = $text;
        $this->pdf = $pdf;
        $this->removePdf = $removePdf ?? false;
    }

    /**
     * @return bool
     */
    public function removePdf(): bool
    {
        return $this->removePdf;
    }

    public function hasPdf(): bool
    {
        return ! is_null($this->pdf);
    }

    /**
     * @return UploadedFile|null
     */
    public function getPdf(): ?UploadedFile
    {
        return $this->pdf;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
