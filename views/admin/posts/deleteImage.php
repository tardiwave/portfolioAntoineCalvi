<h1>delete image</h1>
<?php
use App\Connection;
use App\Table\PostTable;
use App\Auth;
use App\Attachment\PostAttachment;

Auth::checkAuthorization($router);

$pdo = Connection::getPDO();

$table = new PostTable($pdo);

$post = $table->find($params['id']);
$image = $params['image1'] . '.' . $params['image2'] . '.' . $params['ext'];
$post->removeImage($image);
$table->updatePost([
    'name' => $post->getName(),
    'slug' => $post->getSlug(),
    'content' => $post->getContent(),
    'createdAt' => $post->getDate()->format('Y-m-d H:i:s'),
    'image' => $post->getImageStr(),
    'imageExtension' => $post->getImageExtension()
], $post->getId());
$directory = UPLOAD_PATH . DIRECTORY_SEPARATOR . 'posts';
$formats = ['small', 'medium', 'large', 'xl'];
foreach( $formats as $format ){
    $oldFile = $directory . DIRECTORY_SEPARATOR . $format . '_' . $image;
    echo($oldFile);
    if(file_exists($oldFile)){
        unlink($oldFile);
    }
}
http_response_code(301);
header('Location: ' . $router->url('adminEditPost', ['id' => e($post->getId())]) . '?deleteimage=success');