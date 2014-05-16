<?php

namespace Fieldsets;

use Fieldsets\Entity\BlogPost;
use Fieldsets\Form\CreateUserForm;
use Zend\Mvc\Controller\AbstractActionController;

class FieldsetExampleController extends AbstractActionController
{
    public function indexAction()
    {
        $user       = new BlogPost();
        $createUser = new CreateUserForm();

        $createUser->bind($user);

        if ($post = $this->params()->fromPost()) {
            $createUser->setData($post);

            if ($createUser->isValid()) {
                //var_dump($createUser->getInputFilter()->getRawValues());
                var_dump($user);

                die();
            }
        }

        return ['createUser' => $createUser];
    }
}
