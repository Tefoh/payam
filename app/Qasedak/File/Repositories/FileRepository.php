<?php
namespace App\Qasedak\File\Repositories;

use App\Qasedak\File\Repositories\Interfaces\FileRepositoryInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileRepository implements FileRepositoryInterface
{
    /**
     * @param $fileName
     * @return BinaryFileResponse
     */
    public function getFile ($fileName): BinaryFileResponse
    {
        return response()->download(storage_path($fileName), null, [], null);
    }
}