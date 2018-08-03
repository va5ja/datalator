<?php

declare(strict_types = 1);

namespace Datalator\Popo;

/**
 * Code generated by POPO generator, do not edit.
 */
class DatabaseConnectionConfigurator 
{
    /**
     * @var array
     */
    protected $data = array (
  'driver' => 'mysql',
  'dbname' => NULL,
  'host' => NULL,
  'user' => NULL,
  'password' => NULL,
  'port' => NULL,
);

    /**
     * @var array
     */
    protected $default = array (
  'driver' => 'mysql',
  'dbname' => NULL,
  'host' => NULL,
  'user' => NULL,
  'password' => NULL,
  'port' => NULL,
);

    /**
    * @var array
    */
    protected $propertyMapping = array (
  'driver' => 'string',
  'dbname' => 'string',
  'host' => 'string',
  'user' => 'string',
  'password' => 'string',
  'port' => 'int',
);

    /**
    * @var array
    */
    protected $collectionItems = array (
  'driver' => '',
  'dbname' => '',
  'host' => '',
  'user' => '',
  'password' => '',
  'port' => '',
);

    /**
     * @param string $property
     *
     * @return mixed|null
     */
    protected function popoGetValue(string $property)
    {
        if (!isset($this->data[$property])) {
            return null;
        }

        return $this->data[$property];
    }

    /**
     * @param string $property
     * @param mixed $value
     *
     * @return void
     */
    protected function popoSetValue(string $property, $value): void
    {
        $this->data[$property] = $value;
    }

    /**
     * @return array
     */
    protected function getPropertyNames(): array
    {
        return \array_keys(
            $this->propertyMapping
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [];
        foreach ($this->propertyMapping as $key => $type) {
            $data[$key] = null;

            if (isset($this->data[$key])) {
                $value = $this->data[$key];

                if ($this->collectionItems[$key] !== '') {
                    if (\is_array($value) && \class_exists($this->collectionItems[$key])) {
                        foreach ($value as $popo) {
                            if (\method_exists($popo, 'toArray')) {
                                $data[$key][] = $popo->toArray();
                            }
                        }
                    }
                } else {
                    $data[$key] = $value;
                }

                if (\is_object($value) && \method_exists($value, 'toArray')) {
                    $data[$key] = $value->toArray();
                }
            }
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return \Datalator\Popo\DatabaseConnectionConfigurator
     */
    public function fromArray(array $data): \Datalator\Popo\DatabaseConnectionConfigurator
    {
        $result = [];
        foreach ($this->propertyMapping as $key => $type) {
            $result[$key] = null;
            if (\array_key_exists($key, $this->default)) {
                $result[$key] = $this->default[$key];
            }
            if (\array_key_exists($key, $data)) {
                if ($this->collectionItems[$key] !== '') {
                    if (\is_array($data[$key]) && \class_exists($this->collectionItems[$key])) {
                        foreach ($data[$key] as $popoData) {
                            $popo = new $this->collectionItems[$key]();
                            if (\method_exists($popo, 'fromArray')) {
                                $popo->fromArray($popoData);
                            }
                            $result[$key][] = $popo;
                        }
                    }
                } else {
                    $result[$key] = $data[$key];
                }
            }

            if (\is_array($result[$key]) && \class_exists($type)) {
                $popo = new $type();
                if (\method_exists($popo, 'fromArray')) {
                    $popo->fromArray($result[$key]);
                }
                $result[$key] = $popo;
            }
        }

        $this->data = $result;

        return $this;
    }

    /**
     * @param string $property
     *
     * @throws \UnexpectedValueException
     * @return void
     */
    protected function assertPropertyValue(string $property): void
    {
        if (!isset($this->data[$property])) {
            throw new \UnexpectedValueException(\sprintf(
                'Required value of "%s" has not been set',
                $property
            ));
        }
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     *
     * @return void
     */
    protected function addCollectionItem(string $propertyName, $value): void
    {
        $type = \trim(\strtolower($this->propertyMapping[$propertyName]->getType()));
        $collection = $this->popoGetValue($propertyName) ?? [];

        if (!\is_array($collection) || $type !== 'array') {
            throw new \InvalidArgumentException('Cannot add item to non array type: ' . $propertyName);
        }

        $collection[] = $value;

        $this->popoSetValue($propertyName, $collection);
    }

    
    /**
     * @return string|null
     */
    public function getDriver(): ?string
    {
        return $this->popoGetValue('driver');
    }

    /**
     * @param string|null $driver
     *
     * @return self
     */
    public function setDriver(?string $driver): \Datalator\Popo\DatabaseConnectionConfigurator
    {
        $this->popoSetValue('driver', $driver);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireDriver(): string
    {
        $this->assertPropertyValue('driver');

        return (string)$this->popoGetValue('driver');
    }

    /**
     * @return string|null
     */
    public function getDbname(): ?string
    {
        return $this->popoGetValue('dbname');
    }

    /**
     * @param string|null $dbname
     *
     * @return self
     */
    public function setDbname(?string $dbname): \Datalator\Popo\DatabaseConnectionConfigurator
    {
        $this->popoSetValue('dbname', $dbname);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireDbname(): string
    {
        $this->assertPropertyValue('dbname');

        return (string)$this->popoGetValue('dbname');
    }

    /**
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->popoGetValue('host');
    }

    /**
     * @param string|null $host
     *
     * @return self
     */
    public function setHost(?string $host): \Datalator\Popo\DatabaseConnectionConfigurator
    {
        $this->popoSetValue('host', $host);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireHost(): string
    {
        $this->assertPropertyValue('host');

        return (string)$this->popoGetValue('host');
    }

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->popoGetValue('user');
    }

    /**
     * @param string|null $user
     *
     * @return self
     */
    public function setUser(?string $user): \Datalator\Popo\DatabaseConnectionConfigurator
    {
        $this->popoSetValue('user', $user);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireUser(): string
    {
        $this->assertPropertyValue('user');

        return (string)$this->popoGetValue('user');
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->popoGetValue('password');
    }

    /**
     * @param string|null $password
     *
     * @return self
     */
    public function setPassword(?string $password): \Datalator\Popo\DatabaseConnectionConfigurator
    {
        $this->popoSetValue('password', $password);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requirePassword(): string
    {
        $this->assertPropertyValue('password');

        return (string)$this->popoGetValue('password');
    }

    /**
     * @return integer|null
     */
    public function getPort(): ?int
    {
        return $this->popoGetValue('port');
    }

    /**
     * @param integer|null $port
     *
     * @return self
     */
    public function setPort(?int $port): \Datalator\Popo\DatabaseConnectionConfigurator
    {
        $this->popoSetValue('port', $port);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return integer
     */
    public function requirePort(): int
    {
        $this->assertPropertyValue('port');

        return (int)$this->popoGetValue('port');
    }


    
}