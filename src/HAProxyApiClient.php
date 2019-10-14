<?php
namespace HAProxyApiClient;

use LogicException;

class HAProxyApiClient
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @param array $options
     */
    public function __construct($options)
    {
        $this->setOptions($options);
    }

    /**
     * @param string $manager
     * @param string $action
     * @param array $options
     * @return object
     */
    public function run($manager, $action, $options)
    {
        $transportProtocol = TransportProtocolFactory::makeTransportProtocol(
            $this->getOption('protocol'), $this->getOptions());

        return $transportProtocol->execute($manager, $action, $options);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getOption($key)
    {
        if (key_exists($key, $this->getOptions())) {
            return $this->options[$key];
        }

        throw new LogicException('Option key ' . $key . ' does not exist.');
    }

    /**
     * @param $key
     * @param $value
     * @return HAProxyApiClient
     */
    public function setOption($key, $value)
    {
        if (!key_exists($key, $this->getOptions())) {
            $this->options[$key] = $value;

            return $this;
        }

        throw new LogicException('Option key ' . $key . ' already exists.');
    }

    /**
     * @return array
     */
    private function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return HAProxyApiClient
     */
    private function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }
}