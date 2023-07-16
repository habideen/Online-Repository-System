<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google\Client;
use Google\Service\Drive\Drive;
use Illuminate\Http\Request;
use Masbug\Flysystem\GoogleDriveAdapter;

// require_once base_path('vendor/autoload.php');

class GoogleController extends Controller
{
    public function google(Request $request)
    {
        // $client = new Client();
        // $client->setClientId(['client_id']);
        // $client->setClientSecret(['client_secret']);
        // $client->refreshToken(['refresh_token']);
        // $client->setApplicationName('My Google Drive App');

        // $service = new Drive($client);

        // // variant 1
        // $adapter = new GoogleDriveAdapter($service, 'My_App_Root');

        // $local_filepath = '/home/user/downloads/file_to_upload.ext';
        // $remote_filepath = 'MyFolder/file.ext';

        // $localAdapter = new \League\Flysystem\Local\LocalFilesystemAdapter('/');
        // $localfs = new \League\Flysystem\Filesystem($localAdapter, [\League\Flysystem\Config::OPTION_VISIBILITY => \League\Flysystem\Visibility::PRIVATE]);

        // $fs = new \League\Flysystem\Filesystem($adapter, [\League\Flysystem\Config::OPTION_VISIBILITY => \League\Flysystem\Visibility::PRIVATE]);
        // // $fs = new FlySy
        // try {
        //     $time = Carbon::now();
        //     $fs->writeStream($remote_filepath, $localfs->readStream($local_filepath), [new \League\Flysystem\Config()]);

        //     $speed = !(float)$time->diffInSeconds() ? 0 : filesize($local_filepath) / (float)$time->diffInSeconds();
        //     echo 'Elapsed time: ' . $time->diffForHumans(null, true) . PHP_EOL;
        //     echo 'Speed: ' . number_format($speed / 1024, 2) . ' KB/s' . PHP_EOL;
        // } catch (\League\Flysystem\UnableToWriteFile $e) {
        //     echo 'UnableToWriteFile!' . PHP_EOL . $e->getMessage();
        // }
    } // google
}
