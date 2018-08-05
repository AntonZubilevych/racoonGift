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
use Imagine\Image\Box;
use Imagine\Imagick\Imagine;

class FileManager
{
    private $fileName;
    private $uploadDir;
    private $img;

    public function __construct(FileNameInterface $fileName, string $uploadDir )
    {
        $this->fileName = $fileName;
        $this->uploadDir = $uploadDir;
        $this->img = new Imagine();
    }

    public function upload(UploadedFile $file)
    {

        try {
            $path = $file->getRealPath();
            $this->img->open($path)
                ->resize(new Box(200, 200))
                ->save($path, ['flatten' => false]);

            $newFileName = $this->fileName->getName($file->getClientOriginalName());
            $file->move($this->uploadDir, $newFileName);
            return $newFileName;
        } catch (FileException $e) {
            return null;
        }

    }
}