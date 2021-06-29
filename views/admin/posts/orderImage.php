<h1>order image</h1>
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
$action = $params['action'];
echo('<br/>');
var_dump($action);
echo('<br/>');
var_dump($image);
$array = $post->getImageArr();
echo('<br/>');
var_dump($array);
$index = array_search($image, $array);
echo('<br/>');
// var_dump($index);
if($action === 'up' && $index > 0){
    $previous = $array[$index - 1];
    $array[$index - 1] = $image;
    $array[$index] = $previous;
}
if($action === 'down' && $index < (count($array)-1)){
    $next = $array[$index + 1];
    $array[$index + 1] = $image;
    $array[$index] = $next;
}
var_dump($array);
echo('<br/>');
$newImage = implode(',', $array);
var_dump($newImage);
echo('<br/>');
var_dump($post->getImageStr());
echo('<br/>');
$post->setAllImages($newImage);
var_dump($post->getImageStr());
$table->updatePost([
    'name' => $post->getName(),
    'slug' => $post->getSlug(),
    'content' => $post->getContent(),
    'createdAt' => $post->getDate()->format('Y-m-d H:i:s'),
    'image' => $post->getImageStr(),
    'imageExtension' => $post->getImageExtension()
], $post->getId());

http_response_code(301);
header('Location: ' . $router->url('adminEditPost', ['id' => e($post->getId())]) . '?orderimage=success');