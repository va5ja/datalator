<?php

declare(strict_types = 1);

namespace Datalator\Popo;

/**
 * Code generated by POPO generator, do not edit.
 */
class LoaderConfigurator 
{
    /**
     * @var array
     */
    protected $data = array (
  'schema' => 'default',
  'data' => 'default',
  'dataLoaderType' => 'csv',
  'schemaPath' => 'schema/',
  'dataPath' => 'data/',
  'modules' => 
  array (
  ),
);

    /**
     * @var array
     */
    protected $default = array (
  'schema' => 'default',
  'data' => 'default',
  'dataLoaderType' => 'csv',
  'schemaPath' => 'schema/',
  'dataPath' => 'data/',
  'modules' => 
  array (
  ),
);

    /**
    * @var array
    */
    protected $propertyMapping = array (
  'schema' => 'string',
  'data' => 'string',
  'dataLoaderType' => 'string',
  'schemaPath' => 'string',
  'dataPath' => 'string',
  'modules' => 'array',
);

    /**
    * @var array
    */
    protected $collectionItems = array (
  'schema' => '',
  'data' => '',
  'dataLoaderType' => '',
  'schemaPath' => '',
  'dataPath' => '',
  'modules' => '',
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
     * @return \Datalator\Popo\LoaderConfigurator
     */
    public function fromArray(array $data): \Datalator\Popo\LoaderConfigurator
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
    public function getSchema(): ?string
    {
        return $this->popoGetValue('schema');
    }

    /**
     * @param string|null $schema
     *
     * @return self
     */
    public function setSchema(?string $schema): \Datalator\Popo\LoaderConfigurator
    {
        $this->popoSetValue('schema', $schema);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireSchema(): string
    {
        $this->assertPropertyValue('schema');

        return (string)$this->popoGetValue('schema');
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->popoGetValue('data');
    }

    /**
     * @param string|null $data
     *
     * @return self
     */
    public function setData(?string $data): \Datalator\Popo\LoaderConfigurator
    {
        $this->popoSetValue('data', $data);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireData(): string
    {
        $this->assertPropertyValue('data');

        return (string)$this->popoGetValue('data');
    }

    /**
     * @return string|null
     */
    public function getDataLoaderType(): ?string
    {
        return $this->popoGetValue('dataLoaderType');
    }

    /**
     * @param string|null $dataLoaderType
     *
     * @return self
     */
    public function setDataLoaderType(?string $dataLoaderType): \Datalator\Popo\LoaderConfigurator
    {
        $this->popoSetValue('dataLoaderType', $dataLoaderType);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireDataLoaderType(): string
    {
        $this->assertPropertyValue('dataLoaderType');

        return (string)$this->popoGetValue('dataLoaderType');
    }

    /**
     * @return string|null
     */
    public function getSchemaPath(): ?string
    {
        return $this->popoGetValue('schemaPath');
    }

    /**
     * @param string|null $schemaPath
     *
     * @return self
     */
    public function setSchemaPath(?string $schemaPath): \Datalator\Popo\LoaderConfigurator
    {
        $this->popoSetValue('schemaPath', $schemaPath);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireSchemaPath(): string
    {
        $this->assertPropertyValue('schemaPath');

        return (string)$this->popoGetValue('schemaPath');
    }

    /**
     * @return string|null
     */
    public function getDataPath(): ?string
    {
        return $this->popoGetValue('dataPath');
    }

    /**
     * @param string|null $dataPath
     *
     * @return self
     */
    public function setDataPath(?string $dataPath): \Datalator\Popo\LoaderConfigurator
    {
        $this->popoSetValue('dataPath', $dataPath);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return string
     */
    public function requireDataPath(): string
    {
        $this->assertPropertyValue('dataPath');

        return (string)$this->popoGetValue('dataPath');
    }

    /**
     * @return array|null
     */
    public function getModules(): ?array
    {
        return $this->popoGetValue('modules');
    }

    /**
     * @param array|null $modules
     *
     * @return self
     */
    public function setModules(?array $modules): \Datalator\Popo\LoaderConfigurator
    {
        $this->popoSetValue('modules', $modules);

        return $this;
    }

    /**
     * @throws \UnexpectedValueException
     *
     * @return array
     */
    public function requireModules(): array
    {
        $this->assertPropertyValue('modules');

        return (array)$this->popoGetValue('modules');
    }


    
    /**
     * @param  $modulesItem
     *
     * @return self
     */
    public function addModulesItem(? $modulesItem): \Datalator\Popo\LoaderConfigurator
    {
        $this->addCollectionItem('modules', $modulesItem);

        return $this;
    }

}