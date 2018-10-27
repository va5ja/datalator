<?php

declare(strict_types = 1);

namespace Datalator\Popo;

/**
 * Code generated by POPO generator, do not edit.
 */
class ReaderValue
{
    /**
     * @var array
     */
    protected $data =  [
    'databaseValue' => null,
    'dataValue' => null,
    ];

    /**
     * @var array
     */
    protected $default =  [
    'databaseValue' => null,
    'dataValue' => null,
    ];

    /**
     * @var array
     */
    protected $propertyMapping =  [
    'databaseValue' => 'mixed',
    'dataValue' => 'mixed',
    ];

    /**
     * @var array
     */
    protected $collectionItems =  [
    'databaseValue' => '',
    'dataValue' => '',
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

    public function fromArray(array $data): \Datalator\Popo\ReaderValue
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

    
    /**
     * @return mixed|null
     */
    public function getDatabaseValue()
    {
        return $this->popoGetValue('databaseValue');
    }

    /**
     * @param mixed|null $databaseValue
     *
     * @return self
     */
    public function setDatabaseValue($databaseValue): \Datalator\Popo\ReaderValue
    {
        $this->popoSetValue('databaseValue', $databaseValue);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return mixed
     */
    public function requireDatabaseValue()
    {
        $this->assertPropertyValue('databaseValue');

        return $this->popoGetValue('databaseValue');
    }

    /**
     * @return mixed|null
     */
    public function getDataValue()
    {
        return $this->popoGetValue('dataValue');
    }

    /**
     * @param mixed|null $dataValue
     *
     * @return self
     */
    public function setDataValue($dataValue): \Datalator\Popo\ReaderValue
    {
        $this->popoSetValue('dataValue', $dataValue);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return mixed
     */
    public function requireDataValue()
    {
        $this->assertPropertyValue('dataValue');

        return $this->popoGetValue('dataValue');
    }
}
