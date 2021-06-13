<?php
    //$router->get('uri' , 'page to require' , 'name of route');

    $router->get('/', 'home', 'home');

    $router->match('/login', 'Auth/login', 'login');
    $router->post('/logout', 'Auth/logout', 'logout');

    $router->get('/nous-contacter', 'contact', 'contact');
    $router->get('/a-propos', 'aPropos');

    $router->get('/posts', 'posts/index', 'posts');
    $router->get('/categories', 'categories/index', 'categories');

    $router->get('/posts/[*:slug]-[i:id]', 'posts/show', 'post');
    $router->get('/categories/[*:slug]-[i:id]', 'categories/show', 'category');

    $router->get('/admin', 'admin/index', 'admin');

    $router->get('/admin/posts', 'admin/posts/index', 'adminPosts');
    $router->match('/admin/posts/create', 'admin/posts/create', 'adminCreatePost');
    $router->match('/admin/posts/edit/[i:id]', 'admin/posts/edit', 'adminEditPost');
    $router->post('/admin/posts/delete/[i:id]', 'admin/posts/delete', 'adminDeletePost');

    $router->get('/admin/categories', 'admin/categories/index', 'adminCategories');
    $router->match('/admin/categories/create', 'admin/categories/create', 'adminCreateCategory');
    $router->match('/admin/categories/edit/[i:id]', 'admin/categories/edit', 'adminEditCategory');
    $router->post('/admin/categories/delete/[i:id]', 'admin/categories/delete', 'adminDeleteCategory');

    $router->get('/not-found', '404', '404');
    $router->get('/forbiden', '403', '403');
    
    // $router->get('GET', '/adminer', '/admin/adminer', 'adminer');
?>