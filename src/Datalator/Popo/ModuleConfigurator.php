<?php

declare(strict_types = 1);

namespace Datalator\Popo;

/**
 * Code generated by POPO generator, do not edit.
 */
class ModuleConfigurator
{
    /**
     * @var array
     */
    protected $data =  [
    'name' => null,
    'tables' =>
     [
     ],
    ];

    /**
     * @var array
     */
    protected $default =  [
    'name' => null,
    'tables' =>
     [
     ],
    ];

    /**
     * @var array
     */
    protected $propertyMapping =  [
    'name' => 'string',
    'tables' => 'array',
    ];

    /**
     * @var array
     */
    protected $collectionItems =  [
    'name' => '',
    'tables' => 'string',
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

    public function fromArray(array $data): \Datalator\Popo\ModuleConfigurator
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

    
    public function getName(): ?string
    {
        return $this->popoGetValue('name');
    }

    /**
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name): \Datalator\Popo\ModuleConfigurator
    {
        $this->popoSetValue('name', $name);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireName(): string
    {
        $this->assertPropertyValue('name');

        return (string)$this->popoGetValue('name');
    }

    /**
     * @return array|null
     */
    public function getTables(): ?array
    {
        return $this->popoGetValue('tables');
    }

    /**
     * @param array|null $tables
     *
     * @return self
     */
    public function setTables(?array $tables): \Datalator\Popo\ModuleConfigurator
    {
        $this->popoSetValue('tables', $tables);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return array
     */
    public function requireTables(): array
    {
        $this->assertPropertyValue('tables');

        return (array)$this->popoGetValue('tables');
    }


    
    /**
     * @param string $tablesItem
     *
     * @return self
     */
    public function addTable(string $item): \Datalator\Popo\ModuleConfigurator
    {
        $this->addCollectionItem('tables', $item);

        return $this;
    }
}
