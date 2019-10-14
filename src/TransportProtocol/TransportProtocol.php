<?php
namespace HAProxyApiClient\TransportProtocol;

use LogicException;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;

class TransportProtocol implements TransportProtocolInterface
{
    /**
     * @var array
     */
    private $options;

    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

    /**
     * @param string $manager
     * @param string $action
     * @param array $options
     * @return object
     */
    public function execute($manager, $action, $options)
    {
        try {
            $reflection = (new ReflectionClass($manager));
            $reflectionInstance = $reflection->newInstance(
                array_filter($reflection->getConstructor()->getParameters(), function($parameter) use ($options) {
                    /* @var ReflectionParameter $parameter */
                    return key_exists($parameter->getName(), $options);
                })
            );

            return $reflectionInstance;
        } catch (ReflectionException $exception) {
            throw new LogicException('Manager class ' . $manager . ' could not be found', 0, $exception);
        }
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return TransportProtocolInterface
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }
}