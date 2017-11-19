<?php
namespace AppBundle\DataFixtures\Faker\Provider;
use Symfony\Component\Validator\Constraints\DateTime;

class MyProvider
{


    public static function dateRandom()
    {
        $one = strtotime("2010-12-31 23:59:59");
        $two = strtotime("2020-01-01 00:00:00");

        $random_date = rand($one, $two);
        $date = new DateTime();
        $date ->format('Y-m-d H:i:s', $random_date);

        return $date;
    }


}