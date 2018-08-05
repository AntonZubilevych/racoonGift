<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 05.08.18
 * Time: 15:29
 */

namespace App\FileSystem;

use Imagine\Image\Box;
use Imagine\Imagick\Imagine;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageManager extends AbstractFileManager
{
    protected $img;

    public function __construct(FileNameInterface $fileName, string $uploadDir,Imagine $img)
    {
        parent::__construct($fileName, $uploadDir);
        return $this->img=$img;
    }

    public function resize(UploadedFile $file){
        $path = $file->getRealPath();
        $this->img->open($path)
            ->resize(new Box(200, 200))
            ->save($path, ['flatten' => false]);
    }
}