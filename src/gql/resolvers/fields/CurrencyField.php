<?php

namespace pohnean\currencyfield\gql\resolvers\fields;

use \craft\gql\base\Resolver;
use GraphQL\Type\Definition\ResolveInfo;

class CurrencyField extends Resolver
{
    public static function resolve($source, array $arguments, $context, ResolveInfo $resolveInfo)
    {
        $fieldName = $resolveInfo->fieldName;
        $optionFieldData = $source->{$fieldName};

        return [
            'name' => $optionFieldData->getName(),
            'currencyCode' => $optionFieldData->getCurrencyCode(),
            'symbol' => $optionFieldData->getSymbol(),
            'numericCode' => $optionFieldData->getNumericCode(),
            'locale' => $optionFieldData->getLocale(),
            'fractionDigits' => $optionFieldData->getFractionDigits()
        ];
    }
}
