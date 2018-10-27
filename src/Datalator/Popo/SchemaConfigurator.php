<?php

declare(strict_types = 1);

namespace Datalator\Popo;

/**
 * Code generated by POPO generator, do not edit.
 */
class SchemaConfigurator
{
    /**
     * @var array
     */
    protected $data =  [
    'databaseConfigurator' => null,
    'schemaName' => null,
    'sqlCreate' => null,
    'sqlDrop' => null,
    'loadedModules' =>
     [
     ],
    ];

    /**
     * @var array
     */
    protected $default =  [
    'databaseConfigurator' => null,
    'schemaName' => null,
    'sqlCreate' => null,
    'sqlDrop' => null,
    'loadedModules' =>
     [
     ],
    ];

    /**
     * @var array
     */
    protected $propertyMapping =  [
    'databaseConfigurator' => '\\Datalator\\Popo\\DatabaseConfigurator',
    'schemaName' => 'string',
    'sqlCreate' => 'string',
    'sqlDrop' => 'string',
    'loadedModules' => 'array',
    ];

    /**
     * @var array
     */
    protected $collectionItems =  [
    'databaseConfigurator' => '',
    'schemaName' => '',
    'sqlCreate' => '',
    'sqlDrop' => '',
    'loadedModules' => 'string',
    ];

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
            $data[$key] = $this->default[$key] ?? null;

            if (!isset($this->data[$key])) {
                continue;
            }

            $value = $this->data[$key];

            if ($this->collectionItems[$key] !== '') {
                if (\is_array($value) && \class_exists($this->collectionItems[$key])) {
                    foreach ($value as $popo) {
                        if (!\method_exists($popo, 'toArray')) {
                            continue;
                        }

                        $data[$key][] = $popo->toArray();
                    }
                }
            } else {
                $data[$key] = $value;
            }

            if (!\is_object($value) || !\method_exists($value, 'toArray')) {
                continue;
            }

            $data[$key] = $value->toArray();
        }

        return $data;
    }

    public function fromArray(array $data): \Datalator\Popo\SchemaConfigurator
    {
        $result = [];
        foreach ($this->propertyMapping as $key => $type) {
            $result[$key] = null;
            if (\array_key_exists($key, $this->default)) {
                $result[$key] = $this->default[$key];
            }
            if (\array_key_exists($key, $data)) {
                if ($this->isCollectionItem($key, $data)) {
                    foreach ($data[$key] as $popoData) {
                        $popo = new $this->collectionItems[$key]();
                        if (\method_exists($popo, 'fromArray')) {
                            $popo->fromArray($popoData);
                        }
                        $result[$key][] = $popo;
                    }
                } else {
                    $result[$key] = $data[$key];
                }
            }

            if (!\is_array($result[$key]) || !\class_exists($type)) {
                continue;
            }

            $popo = new $type();
            if (\method_exists($popo, 'fromArray')) {
                $popo->fromArray($result[$key]);
            }
            $result[$key] = $popo;
        }

        $this->data = $result;

        return $this;
    }

    protected function isCollectionItem(string $key, array $data): bool
    {
        return $this->collectionItems[$key] !== '' &&
            \is_array($data[$key]) &&
            \class_exists($this->collectionItems[$key]);
    }

    /**
     * @param string $property
     *
     * @throws \UnexpectedValueException
     *
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
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    protected function addCollectionItem(string $propertyName, $value): void
    {
        $type = \trim(\strtolower($this->propertyMapping[$propertyName]));
        $collection = $this->popoGetValue($propertyName) ?? [];

        if (!\is_array($collection) || $type !== 'array') {
            throw new \InvalidArgumentException('Cannot add item to non array type: ' . $propertyName);
        }

        $collection[] = $value;

        $this->popoSetValue($propertyName, $collection);
    }

    
    public function getDatabaseConfigurator(): ?\Datalator\Popo\DatabaseConfigurator
    {
        return $this->popoGetValue('databaseConfigurator');
    }

    /**
     * @param \Datalator\Popo\DatabaseConfigurator|null $databaseConfigurator
     *
     * @return self
     */
    public function setDatabaseConfigurator(?\Datalator\Popo\DatabaseConfigurator $databaseConfigurator): \Datalator\Popo\SchemaConfigurator
    {
        $this->popoSetValue('databaseConfigurator', $databaseConfigurator);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return \Datalator\Popo\DatabaseConfigurator
     */
    public function requireDatabaseConfigurator(): \Datalator\Popo\DatabaseConfigurator
    {
        $this->assertPropertyValue('databaseConfigurator');

        return $this->popoGetValue('databaseConfigurator');
    }

    public function getSchemaName(): ?string
    {
        return $this->popoGetValue('schemaName');
    }

    /**
     * @param string|null $schemaName
     *
     * @return self
     */
    public function setSchemaName(?string $schemaName): \Datalator\Popo\SchemaConfigurator
    {
        $this->popoSetValue('schemaName', $schemaName);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireSchemaName(): string
    {
        $this->assertPropertyValue('schemaName');

        return (string)$this->popoGetValue('schemaName');
    }

    public function getSqlCreate(): ?string
    {
        return $this->popoGetValue('sqlCreate');
    }

    /**
     * @param string|null $sqlCreate
     *
     * @return self
     */
    public function setSqlCreate(?string $sqlCreate): \Datalator\Popo\SchemaConfigurator
    {
        $this->popoSetValue('sqlCreate', $sqlCreate);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireSqlCreate(): string
    {
        $this->assertPropertyValue('sqlCreate');

        return (string)$this->popoGetValue('sqlCreate');
    }

    public function getSqlDrop(): ?string
    {
        return $this->popoGetValue('sqlDrop');
    }

    /**
     * @param string|null $sqlDrop
     *
     * @return self
     */
    public function setSqlDrop(?string $sqlDrop): \Datalator\Popo\SchemaConfigurator
    {
        $this->popoSetValue('sqlDrop', $sqlDrop);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireSqlDrop(): string
    {
        $this->assertPropertyValue('sqlDrop');

        return (string)$this->popoGetValue('sqlDrop');
    }

    /**
     * @return array|null
     */
    public function getLoadedModules(): ?array
    {
        return $this->popoGetValue('loadedModules');
    }

    /**
     * @param array|null $loadedModules
     *
     * @return self
     */
    public function setLoadedModules(?array $loadedModules): \Datalator\Popo\SchemaConfigurator
    {
        $this->popoSetValue('loadedModules', $loadedModules);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return array
     */
    public function requireLoadedModules(): array
    {
        $this->assertPropertyValue('loadedModules');

        return (array)$this->popoGetValue('loadedModules');
    }


    
    /**
     * @param string $loadedModulesItem
     *
     * @return self
     */
    public function addLoadedModule(string $item): \Datalator\Popo\SchemaConfigurator
    {
        $this->addCollectionItem('loadedModules', $item);

        return $this;
    }
}
