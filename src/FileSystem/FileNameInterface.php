<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 01.08.18
 * Time: 10:53
 */

namespace App\FileSystem;


interface FileNameInterface
{
    public function getName(string $originName ): string;

}