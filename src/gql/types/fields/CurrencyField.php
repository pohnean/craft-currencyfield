<?php

namespace pohnean\currencyfield\gql\types\fields;

use craft\gql\TypeManager;
use craft\gql\GqlEntityRegistry;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use \craft\gql\base\ObjectType as CraftObjectType;

class CurrencyField extends CraftObjectType
{
    public static function getName(): string
    {
        return 'CurrencyField';
    }

    public static function getType(): Type
    {
        // Return the type if it’s already been created
        if ($type = GqlEntityRegistry::getEntity(self::getName())) {
            return $type;
        }

        // Otherwise create the type via the entity registry, which handles prefixing
        return GqlEntityRegistry::createEntity(
            self::getName(), new ObjectType(
                [
                'name' => static::getName(),
                'fields' => self::class . '::getFieldDefinitions',
                'description' => 'This is the interface implemented by all currency fields.',
                'resolveType' => self::class . '::resolveElementTypeName',
                ]
            )
        );
    }

    public static function resolveElementTypeName()
    {
        return GqlEntityRegistry::prefixTypeName(self::getName());
    }

    public static function getFieldDefinitions(): array
    {
        // Add our custom widget’s field to common ones for all elements
        return TypeManager::prepareFieldDefinitions(
            [
                'name' => [
                    'name' => 'name',
                    'type' => Type::string(),
                    'description' => 'Gets the currency name.'
                ],
                'currencyCode' => [
                    'name' => 'currencyCode',
                    'type' => Type::string(),
                    'description' => 'Gets the alphabetic currency code.'
                ],
                'symbol' => [
                    'name' => 'symbol',
                    'type' => Type::string(),
                    'description' => 'Gets the currency symbol.'
                ],
                'numericCode' => [
                    'name' => 'numericCode',
                    'type' => Type::string(),
                    'description' => 'The numeric currency code.'
                ],
                'locale' => [
                    'name' => 'locale',
                    'type' => Type::string(),
                    'description' => 'The locale (i.e. "en_US").'
                ],
                'fractionDigits' => [
                    'name' => 'fractionDigits',
                    'type' => Type::int(),
                    'description' => 'The number of fraction digits.'
                ],
            ], self::getName()
        );
    }
}
