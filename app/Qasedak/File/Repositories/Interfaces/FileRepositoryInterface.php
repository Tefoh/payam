<?php
namespace App\Qasedak\File\Repositories\Interfaces;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface FileRepositoryInterface
{
    public function getFile($fileName) : BinaryFileResponse ;
}