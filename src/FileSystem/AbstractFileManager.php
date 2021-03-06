<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 01.08.18
 * Time: 11:02
 */

namespace App\FileSystem;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class AbstractFileManager
{
    protected $fileName;
    protected $uploadDir;

    public function __construct(FileNameInterface $fileName, string $uploadDir )
    {
        $this->fileName = $fileName;
        $this->uploadDir = $uploadDir;
    }

    public function upload(UploadedFile $file)
    {

        try {
            $newFileName = $this->fileName->getName($file->getClientOriginalName());
            $file->move($this->uploadDir, $newFileName);

            return $newFileName;
        } catch (FileException $e) {
            return null;
        }

    }
}