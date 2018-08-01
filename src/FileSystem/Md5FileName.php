<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 01.08.18
 * Time: 10:54
 */

namespace App\FileSystem;


class Md5FileName implements FileNameInterface
{
    public function getName(string $originName): string
    {
        return DIRECTORY_SEPARATOR.\md5(\uniqid($originName));
    }
}