<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

use Illuminate\Support\Facades\Storage;
use App\Awesome;
//use ImageOptimizer;

class ImageController extends Controller
{
/*
    public function show(Filesystem $filesystem, $path)
    {
	    $filesystem = Storage::disk('common');
	    
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $filesystem->getDriver(),
//            'cache' => new \League\Flysystem\Filesystem(
//				new Awesome( storage_path('common') )
//			),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);
		
		$image = $server->getImageResponse($path, request()->all());
// 		ImageOptimizer::optimize($image);
		
        return $image;
    }
*/
    
    public function show(Filesystem $filesystem, $path){
	   	$filesystem = Storage::disk('common');
	    
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory(app('request')),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.cache',
            'base_url' => 'img',
        ]);

        return $server->getImageResponse($path, request()->all());
    }
    
    public function optimize(){
		$files = \File::allFiles(public_path('uploads/.cache'));
		
		foreach($files as $file){
				
/*
			if( strpos($file->getPathname(), '.cache') || strpos($file->getPathname(), '.quarantine') || strpos($file->getPathname(), '.tmb') )
				continue;
*/
			
			$pathToImage = $file->getPathname();
			$pathToOptimizedImage = str_replace('/img/', '/img2/', $file->getPathname());
			
			\ImageOptimizer::optimize($pathToImage);			
/*
			try {
				\ImageOptimizer::optimize($pathToImage, $pathToOptimizedImage);
			}catch(Exception $e){
				if($e->getCode() === 0){
					File::makeDirectory(dirname($pathToOptimizedImage), 0777, true);
					\ImageOptimizer::optimize($pathToImage, $pathToOptimizedImage);
				}
			}
*/
			
		}	    
    }
}
