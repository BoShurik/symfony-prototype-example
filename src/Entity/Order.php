<?php
/**
 * User: boshurik
 * Date: 2019-01-14
 * Time: 18:16
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity()
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @var Currency|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Currency")
     */
    private $currency;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text")
     */
    private $message;
}