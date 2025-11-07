<?php

function msisdn(
    string $msisdn,
    string $countryCode = 'za'
): \Nonsapiens\MsisdnToolkit\Msisdn
{
    return \Nonsapiens\MsisdnToolkit\Msisdn::getInstance($msisdn, $countryCode);
}