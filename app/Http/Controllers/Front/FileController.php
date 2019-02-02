<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Qasedak\File\Repositories\Interfaces\FileRepositoryInterface;
use App\User;

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
    public function getFile(User $user, $fileName)
    {
        return abort(403);
        $this->authorize('view', $user);
        return $this->fileRepo->getFile($fileName);
    }
}
