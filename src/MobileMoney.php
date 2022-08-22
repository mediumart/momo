<?php
namespace Mediumart\MobileMoney;

/** 
* @method static Env\Factory sandbox()
* @method static Env\Factory live()
* @method static Collection\Client collection()
* @method static Disbursement\Client disbursement()
* @method static Remittance\Client remittance()
* @method static Widget\Client widget()
*/
class MobileMoney
{   
    use Facade;
}
