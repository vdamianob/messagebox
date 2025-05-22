<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Authorization\AuthorizationServiceInterface;

class IdentityHelper extends Helper
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->authorization = $this->_View->getRequest()->getAttribute('authorization');
    }
    
    public function can(string $action, $resource): bool
    {
        if (!$this->authorization) {
            return false;
        }
    
        $identity = $this->_View->getRequest()->getAttribute('identity');
    
        if (!$identity) {
            return false;
        }
    
        return $this->authorization->can($identity, $action, $resource);
    }

    public function isAdmin(): bool
    {
        $identity = $this->_View->getRequest()->getAttribute('identity');

        if (!$identity) {
            return false;
        }

        return in_array($identity->get('role'), ['admin', 'superadmin']);
    }

    public function isMe($resource): bool
    {
        $identity = $this->_View->getRequest()->getAttribute('identity');

        if (!$identity || !$resource) {
            return false;
        }

        // Funziona sia se il resource è un'entità con ->id, sia un array con ['id']
        $resourceId = is_array($resource) ? ($resource['id'] ?? null) : ($resource->id ?? null);

        return (int)$identity->get('id') === (int)$resourceId;
    }

}

