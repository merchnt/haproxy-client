<?php
namespace HAProxyApiClient;

use HAProxyApiClient\TransportProtocol\HttpTransportProtocol;

class TransportProtocolFactory
{
    /**
     * @param string $protocol
     * @param array $options
     * @return HttpTransportProtocol
     */
    public static function makeTransportProtocol($protocol, array $options)
    {
        switch ($protocol) {
            case 'http':
                return new HttpTransportProtocol($options);
                break;
            default:
                break;
        }
    }
}