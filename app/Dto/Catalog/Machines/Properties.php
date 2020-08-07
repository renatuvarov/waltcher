<?php

namespace App\Dto\Catalog\Machines;

class Properties
{
    /**
     * @var array
     */
    private $propertiesArray;

    public function __construct(?array $propertiesArray)
    {
        $this->propertiesArray = empty($propertiesArray) ? [] : $this->prepare($propertiesArray);
    }

    private function prepare(array $propertiesArray): array
    {
        $propsArray = [];

        foreach ($propertiesArray as $property) {
            $propsArray[$property['name']] = [
                'value' => $property['value'],
            ];
        }

        return $propsArray;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->propertiesArray;
    }
}
