<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Qasedak\File\Repositories\Interfaces\FileRepositoryInterface;

class FileController extends Controller
{
    /**
     * @var FileRepositoryInterface
     */
    private $fileRepo;

    public function __construct(FileRepositoryInterface $fileRepository)
    {

        $this->fileRepo = $fileRepository;
    }
    /**
     * @param $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getFile($fileName)
    {
        return $this->fileRepo->getFile($fileName);
    }
}
