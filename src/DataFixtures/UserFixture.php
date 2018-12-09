<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$nom, $pnom, $username, $password, $email, $roles]) {
            $user = new User();
            $user->setNom($nom);
            $user->setPnom($pnom);
            $user->setUsername($username);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);

            $manager->persist($user);
            $this->addReference($username, $user);
        }

        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            // $userData = [$fullname, $username, $password, $email, $roles];
            ['TRAORE', 'Youssouf', 'youstra', 'kitten', 'contact.youstra@gmail.com', ['ROLE_ADMIN', 'ROLE_EDITEUR']],
            ['OUATTARA', 'Ismaël Barafila', 'barafila', 'kitten', 'ouattaraismael33@gmail.com', ['ROLE_EDITEUR']],
            ['USER', 'User', 'test', 'kitten', 'test@gmail.com', ['ROLE_USER']],
        ];
    }


}

?>
