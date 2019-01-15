<?php
/**
 * User: boshurik
 * Date: 2019-01-15
 * Time: 15:06
 */

namespace App\Order\Model;

use App\Entity\Currency;
use App\Entity\User;

class FilterModel
{
    /**
     * @var User|null
     */
    public $user;

    /**
     * @var Currency|null
     */
    public $currency;

    /**
     * @var int|null
     */
    public $amountFrom;

    /**
     * @var int|null
     */
    public $amountTo;

    /**
     * @var string
     */
    public $message;

    /**
     * @var \DateTimeInterface|null
     */
    public $createdAtFrom;

    /**
     * @var \DateTimeInterface|null
     */
    public $createdAtTo;
}