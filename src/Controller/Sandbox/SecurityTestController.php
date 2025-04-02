<?php

namespace App\Controller\Sandbox;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/sandbox/securitytest', name: 'sandbox_securitytest')]
class SecurityTestController extends AbstractController
{
    #[Route('/addusers', name: '_addusers')]
    public function addUsersAction(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user   
            ->setLogin('sadmin')
            ->setName('super')
            ->setForename('admin')
            ->setBirthday(new \DateTimeImmutable('1937-09-22'))
            ->setAdmin(true)
            ->setRoles(['ROLE_SUPERADMIN']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'nimdas');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user   
            ->setLogin('gilles')
            ->setName('Subrenat')
            ->setForename('Gilles')
            ->setBirthday(new \DateTimeImmutable('1970-01-01'))
            ->setAdmin(true)
            ->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'sellig');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user   
            ->setLogin('rita')
            ->setName('Zrour')
            ->setForename('Rita')
            ->setBirthday(new \DateTimeImmutable('1970-01-01'))
            ->setAdmin(true)
            ->setRoles(['ROLE_CUSTOMER']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'atir');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user   
            ->setLogin('boumediene')
            ->setName('Saidi')
            ->setForename('Boumediene')
            ->setBirthday(new \DateTimeImmutable('1970-01-01'))
            ->setAdmin(true)
            ->setRoles(['ROLE_CUSTOMER']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'eneidemuob');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $em->flush();

        return new Response('<body>AddUsers</body>');
    }

    #[Route('/accessuser', name: '_accessuser')]
    public function accessUserAction(Security $security): Response
    {
        dump($security->getUser());
        dump($security->getUser()->getRoles());
        return $this->render('Sandbox/SecurityTest/access_user.html.twig');
    }

    #[Route('/role1', name: '_role1')]
    #[IsGranted('ROLE_ADMIN')]
    public function Role1Action(): Response
    {
        return new Response('<body>IsGranted(\'ROLE_ADMIN\')</body>');
    }

}
