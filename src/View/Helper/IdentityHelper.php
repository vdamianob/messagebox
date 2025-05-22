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
}

