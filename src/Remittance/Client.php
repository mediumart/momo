<?php
namespace Mediumart\MobileMoney\Remittance;

use Mediumart\MobileMoney\BaseClient;
use Mediumart\MobileMoney\TransferApi;

/**
 * @method \Psr\Http\Message\ResponseInterface transfer()
 * @method \Psr\Http\Message\ResponseInterface getTransferStatus()
 */
class Client extends BaseClient
{
    use TransferApi;
}
