<?php
namespace Mediumart\MobileMoney\Tests;

class ExampleTest 
{
    public function RequestToPay():void
    {
        $headers = [
            'Authorization',
            'X-Callback-Url',
            'X-Reference-Id',
            'X-Target-Environment' => 'https://ericssondeveloperapi.portal.azure-api.net/',
            'Content-Type',
            'Ocp-Apim-Subscription-Key'
        ];

        $body = [
            "amount"=> "string",
            "currency"=> "string",
            "externalId"=> "string",
            "payer"=> [
                "partyIdType"=> "MSISDN",
                "partyId"=> "string"
            ],
            "payerMessage"=> "string",
            "payeeNote"=> "string"
        ];

        // Expected a 202 Accepted response

        // $collection = new Collection();
        // $this->assertTrue(True);
    } 
}