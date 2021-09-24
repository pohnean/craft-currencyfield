<?php

namespace pohnean\currencyfield\gql\arguments\fields;

use GraphQL\Type\Definition\Type;

class CurrencyField extends \craft\gql\base\Arguments
{
    public static function getArguments(): array
    {
        // append our argument to common element arguments and any from custom fields
        return array_merge(
            parent::getArguments(), [
            'locale' => [
            'name' => 'locale',
            'type' => Type::string(),
            'description' => 'Format the currency in a different locale.'
            ]]
        );
    }
}
