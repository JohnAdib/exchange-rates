<?php

namespace library;

use Phalcon\Cache;
use Phalcon\Cache\AdapterFactory;
use Phalcon\Storage\SerializerFactory;

class CacheHelper
{
    private string $name;
    private Cache $cacheObj;


    function __construct(string $name, int $ttl = 5)
    {
        $this->setName($name);
        $ttlMin = $ttl * 60;
        $serializerFactory = new SerializerFactory();
        $adapterFactory = new AdapterFactory($serializerFactory);
        $options = [
            'defaultSerializer' => 'Php',
            'lifetime'          => $ttlMin
        ];
        $adapter = $adapterFactory->newInstance('apcu', $options);
        $this->setCacheObj(new Cache($adapter));
    }

    private function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    private function getCacheObj(): Cache
    {
        return $this->cacheObj;
    }

    private function setCacheObj(Cache $cacheObj): void
    {
        $this->cacheObj = $cacheObj;
    }

    public function set(object $value): void
    {
        try {
            $this->getCacheObj()->set($this->getName(), $value);
        } catch (Cache\Exception\InvalidArgumentException $e) {
        }
    }

    public function get(): object
    {
        try {
            return $this->getCacheObj()->get($this->getName());
        } catch (Cache\Exception\InvalidArgumentException $e) {
        }
    }

    public function has(): bool
    {
        try {
            return $this->getCacheObj()->has($this->getName());
        } catch (Cache\Exception\InvalidArgumentException $e) {
        }
    }

    public function delete(): void
    {
        try {
            $this->getCacheObj()->delete($this->getName());
        } catch (Cache\Exception\InvalidArgumentException $e) {
        }
    }
}