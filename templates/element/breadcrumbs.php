<?php
/**
 * Breadcrumbs element for the application
 * 
 * @var \Cake\View\View $this
 */
use Cake\Routing\Router;
use Cake\Utility\Inflector;

$this->Breadcrumbs->setTemplates([
    'wrapper' => '<nav aria-label="breadcrumb"><ol class="breadcrumb">{{content}}</ol></nav>',
    'item' => '<li class="breadcrumb-item"><a href="{{url}}">{{title}}</a></li>',
    'itemWithoutLink' => '<li class="breadcrumb-item active" aria-current="page">{{title}}</li>',
]);

// Aggiungiamo il link Home all'inizio delle breadcrumbs
$this->Breadcrumbs->add('Home', '/');

$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

// Gestione dinamica Users e Messages
if ($controller === 'Users') {
    $this->Breadcrumbs->add('Users', ['controller' => 'Users', 'action' => 'index']);

    if (!empty($user)) {
        $this->Breadcrumbs->add(
            h($user->username),
            ['controller' => 'Users', 'action' => 'view', $user->id]
        );
    }
} elseif ($controller === 'Messages') {
    $this->Breadcrumbs->add('Messages', ['controller' => 'Messages', 'action' => 'index']);

    if (!empty($message)) {
        $this->Breadcrumbs->add(
            '<em>"' . h($message->title) . '"</em>',
            ['controller' => 'Messages', 'action' => 'view', $message->id],
            ['escape' => false]
        );
    }
}

// Renderizza le breadcrumbs
echo $this->Breadcrumbs->render();