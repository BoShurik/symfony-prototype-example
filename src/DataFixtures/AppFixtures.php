<?php

namespace App\DataFixtures;

use App\Entity\Currency;
use App\Entity\Order;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $eur = new Currency();
        $eur->setName('EUR');
        $manager->persist($eur);

        $usd = new Currency();
        $usd->setName('USD');
        $manager->persist($usd);

        $user1 = new User();
        $user1->setName('User 1');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setName('User 2');
        $manager->persist($user2);

        $currencies = [
            $eur,
            $usd,
        ];

        $users = [
            $user1,
            $user2,
        ];

        for ($i = 0; $i < 500; $i++) {
            $order = new Order();
            $order->setUser($users[mt_rand(0, 1)]);
            $order->setCurrency($currencies[mt_rand(0, 1)]);
            $order->setAmount(mt_rand(0, 10) + 1);
            $order->setMessage(sprintf('Order #%d', $i));

            $dateTime = new \DateTime();
            $dateTime->sub(new \DateInterval(sprintf('P%dD', $i)));

            $order->setCreatedAt($dateTime);

            $manager->persist($order);
        }

        $manager->flush();
    }
}
