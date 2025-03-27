<?php

namespace App\Controller\Sandbox;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/sandbox/securitytest', name: 'sandbox_securitytest')]
class SecurityTestController extends AbstractController
{
    #[Route('/addusers', name: '_addusers')]
    public function addUsersAction(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user   
            ->setLogin('Riri2')
            ->setName('Duck')
            ->setForename('Riri')
            ->setBirthday(new \DateTimeImmutable('1937-09-22'))
            ->setAdmin(false)
            ->setRoles(['ROLE_CUSTOMER']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'mdpTest');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user   
            ->setLogin('Fifi2')
            ->setName('Duck')
            ->setForename('Fifi')
            ->setBirthday(new \DateTimeImmutable('1937-09-22'))
            ->setAdmin(true)
            ->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'mdpTest');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user   
            ->setLogin('Loulou2')
            ->setName('Duck')
            ->setForename('Loulou')
            ->setBirthday(new \DateTimeImmutable('1937-09-22'))
            ->setAdmin(true)
            ->setRoles(['ROLE_SUPERADMIN']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'mdpTest');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $em->flush();

        return new Response('<body>AddUsers</body>');
    }
}
