<?php
namespace HAProxyApiClient\TransportProtocol;

use HAProxyApiClient\Model\ModelInterface;

interface TransportProtocolInterface
{
    /**
     * @param string $command
     * @param string $action
     * @param array $options
     * @return object
     */
    public function execute($command, $action, $options);
}