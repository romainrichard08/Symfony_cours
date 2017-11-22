<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture 
{
    /**
     * @var ContainerInterface
     */
     private $container;

     /**
      * {@inheritDoc}
      */
      public function setContainer(ContainerInterface $container = null)
      {
          $this->container = $container;
      }

      public function load(ObjectManager $manager)
      {
           $userManager = $this->container->get('fos_user_manager');

           $userAdmin = $userManager->createUser();
           $userAdmin->setPlainPassword('mypass')
               ->setEnabled(true)
               ->setRoles('ROLE_ADMIN')
               ->setEmail('elyes.elbahri77@gmail.com')
               ->setUsername('eelbahri');

          $userManager->updateUser($userAdmin, true);
      }
}
