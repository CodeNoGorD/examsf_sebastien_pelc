<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{

    public function __construct(
        private readonly SluggerInterface $slugger,
        private readonly Filesystem $filesystem,
        private readonly string $picturesDirectory
    )
    {
    }

    public function upload(UploadedFile $file, string $picturesDirectory): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename . '-' . uniqid("", true) . '.' . $file->guessExtension();

        try {
            $file->move($picturesDirectory, $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function removeFile($path):void
    {
        $this->filesystem->remove(['symlink', $path, 'activity.log']);
    }

    /**
     * @return string
     */
    public function getPicturesDirectory(): string
    {
        return $this->picturesDirectory;
    }
}
