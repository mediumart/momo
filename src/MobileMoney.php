<?php
namespace Mediumart\MobileMoney;

/**
 * @method static void setCurrentEnvironment(string $value)
 * @method static string getCurrentEnvironment()
 * @method static Collection\Client collection()
 * @method static Disbursement\Client disbursement()
 * @method static Remittance\Client remittance()
 */
class MobileMoney
{
    use Factory;
}
