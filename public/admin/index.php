<?php

require_once '../../vendor/autoload.php';
require_once '../../lib/Session.php';

function createUrl($url) {
    $out = (strpos(shell_exec('/usr/local/apache/bin/apachectl -l'), 'mod_rewrite') === false) ? 'index.php' . $url : $url;
    return '/admin/' . $out;
}

function auth(Slim\Slim $app) {
    if (!Session::isAuthenticated()) {
        $app->redirect(createUrl('/login/'));
    }
}

function json(Slim\Http\Response $res, $json = array(), $status = null) {
    $res->headers->set('Content-Type', 'application/json');
    $res->write(json_encode($json));
    if ($status) {
        $res->setStatus($status);
    }

    return;
}

$app = new Slim\Slim(array(
    'debug' => false,
    'templates.path' => '../../lib/view/'
));

$app->get('/', function () use ($app) {
    auth($app);

    $app->render('index.phtml', array('settings' => json_decode(file_get_contents('../bloglist.json'))));
});

$app->get('/login/', function () use ($app) {
    if (Session::isAuthenticated()) {
        $app->redirect(createUrl('/'));
    }

    $app->render('login.phtml');
});

$app->post('/authenticate/', function () use ($app) {
    if (!Session::isAuthenticated() || !$app->request->isAjax()) {
        die;
    }

    $req = $app->request;
    $res = $app->response;

    if (!$req->post('user') || !$req->post('pass')) {
        return json($res, array('error' => true, 'message' => 'You must supply a username and password.'), 403);
    }

    $credentials = json_decode(file_get_contents('../../credentials.json'), true);
    if (!array_key_exists('user', $credentials) || !array_key_exists('pass', $credentials)) {
        return json($res, array('error' => true, 'message' => 'Credentials file incorrectly formatted.'), 403);
    }

    if ($req->post('user') !== $credentials['user'] || $req->post('pass') !== $credentials['pass']) {
        return json($res, array('error' => true, 'message' => 'Username or password incorrect.'), 401);
    }

    Session::authenticate();
    return json($res, array('success' => true));
});

$app->get('/logout/', function () use ($app) {
    auth($app);

    Session::clear();
    $app->redirect(createUrl('/'));
});

$app->get('/save/', function () {
    if (!Session::isAuthenticated() || !$app->request->isAjax()) {
        die;
    }

    $req = $app->request();

    $currentList = json_decode(file_get_contents('../bloglist.json'), true);

    if (array_key_exists('title', $req->post())) {
        $currentList['title'] = $req->post('title');
    }

    if (array_key_exists('description', $req->post())) {
        $currentList['description'] = $req->post('description');
    }

    if (array_key_exists('blogs', $req->post())) {
        $currentList['blogs'] = $req->post('blogs');
    }

    file_put_contents('../bloglist.json', json_encode($currentList));

    return json($app->response, array('success' => true));
});
