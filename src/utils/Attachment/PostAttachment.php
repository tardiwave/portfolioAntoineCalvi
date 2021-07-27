<?php

namespace App\Attachment;

use App\Models\Post;
use Intervention\Image\ImageManager;
use finfo;

class PostAttachment {

    const  DIRECTORY = UPLOAD_PATH . DIRECTORY_SEPARATOR . 'posts';

    public static function add(Post $post)
    {

        $directory = self::DIRECTORY;
        if (!empty($_POST['video'])){
            $post->setImage('[Youtube]' . $_POST['video'] . '[Youtube]');
        }
        $image = $post->getImage();
        if (!empty($_FILES['image']['tmp_name']) && is_string($image)){
            echo '<div class="alert alert-success" role="alert">Image téléversée</div>';
            if(!file_exists($directory)){
                mkdir($directory, 0777, true);
            }

            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $fileinfoMIME = finfo_file($fileinfo, $_FILES['image']['tmp_name']);
            $extension = 'jpg';
            switch ($fileinfoMIME) {
                case 'image/jpeg':
                    $extension = 'jpg';
                    break;
                case 'image/png':
                    $extension = 'png';
                    break;
                case 'image/gif':
                    $extension = 'gif';
                    break;
            }
            $filename = uniqid("", true);
            if($fileinfoMIME !=  'image/gif'){
                $manager = new ImageManager(['driver' => 'gd']);
                
                $manager
                    ->make($_FILES['image']['tmp_name'])
                    ->resize(150, null, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->resize(null, 150, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->save($directory . DIRECTORY_SEPARATOR . 'small_' . $filename . '.' . $extension)
                    ->destroy();
                $manager
                    ->make($_FILES['image']['tmp_name'])
                    ->resize(300, null, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->resize(null, 300, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->save($directory . DIRECTORY_SEPARATOR . 'medium_' . $filename . '.' . $extension)
                    ->destroy();
                $manager
                    ->make($_FILES['image']['tmp_name'])
                    ->resize(1024, null, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->resize(null, 1024, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->save($directory . DIRECTORY_SEPARATOR . 'large_' . $filename . '.' . $extension)
                    ->destroy();
                $manager
                    ->make($_FILES['image']['tmp_name'])
                    ->resize(1920, null, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->resize(null, 1920, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->save($directory . DIRECTORY_SEPARATOR . 'xl_' . $filename . '.' . $extension)
                    ->destroy();
            }else{
                copy ($_FILES['image']['tmp_name'], $directory . DIRECTORY_SEPARATOR . 'small_' . $filename . '.' . $extension);
                copy ($_FILES['image']['tmp_name'], $directory . DIRECTORY_SEPARATOR . 'medium_' . $filename . '.' . $extension);
                copy ($_FILES['image']['tmp_name'], $directory . DIRECTORY_SEPARATOR . 'large_' . $filename . '.' . $extension);
                copy ($_FILES['image']['tmp_name'], $directory . DIRECTORY_SEPARATOR . 'xl_' . $filename . '.' . $extension);
            }
            // $post->setImageExtension($extension);
            $post->setImage($filename . '.' . $extension);
        }
        
        if (!empty($_FILES['thumbnail']['tmp_name'])){
            echo '<div class="alert alert-success" role="alert">Miniature téléversée</div>';
            if(!file_exists($directory)){
                mkdir($directory, 0777, true);
            }

            $previousThumbnail = $post->getThumbnail();
            if($previousThumbnail){
                $oldThumbnail = $directory . DIRECTORY_SEPARATOR . 'thumbnail_' . $previousThumbnail;
                if(file_exists($oldThumbnail)){
                    unlink($oldThumbnail);
                }
            }

            $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
            $fileinfoMIME = finfo_file($fileinfo, $_FILES['thumbnail']['tmp_name']);
            $extension = 'jpg';
            switch ($fileinfoMIME) {
                case 'image/jpeg':
                    $extension = 'jpg';
                    break;
                case 'image/png':
                    $extension = 'png';
                    break;
                case 'image/gif':
                    $extension = 'gif';
                    break;
            }
            $filename = uniqid("", true);
            if($fileinfoMIME !=  'image/gif'){
                $manager = new ImageManager(['driver' => 'gd']);
                
                $manager
                    ->make($_FILES['thumbnail']['tmp_name'])
                    ->fit(250, 250, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->save($directory . DIRECTORY_SEPARATOR . 'thumbnail_' . $filename . '.' . $extension)
                    ->destroy();
            }else{
                copy ($_FILES['thumbnail']['tmp_name'], $directory . DIRECTORY_SEPARATOR . 'thumbnail_' . $filename . '.' . $extension);
            }
            // $post->setImageExtension($extension);
            $post->setThumbnailStr($filename . '.' . $extension);
        }
    }

    public static function detach(Post $post)
    {
        if(!empty($post->getImage())){
            $formats = ['small', 'medium', 'large', 'xl'];
            foreach( $formats as $format ){
                $file = self::DIRECTORY . DIRECTORY_SEPARATOR . $post->getImage() . '_' . $format . '.' . $post->getImageExtension();
                if(file_exists($file)){
                    unlink($file);
                }
            }
        }
    }

}