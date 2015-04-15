<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

class UserRepository extends EntityRepository
{
    public function getLogin($em, $fields)
    {
        $user = $em->getRepository('AppBundle:User')->findOneBy(array('email' => $fields['email']));

        if( is_null($user) === true ) {
            $response['error'] = 'All\'s good, let\'s proceed';
        }else{
            $response['error'] = 'This email already exists';
        }
        foreach ($fields as $key => $value) {
            if($value === '') {
                $response['error'] = 'Please fill in all values';
            }
        }

        return $response;
    }
}