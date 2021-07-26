<?php

namespace pohnean\currencyfield\gql\resolvers\fields;

use \craft\gql\base\Resolver;
use GraphQL\Type\Definition\ResolveInfo;
use CommerceGuys\Intl\Currency\CurrencyRepository;

class CurrencyField extends Resolver
{
    public static function resolve($source, array $arguments, $context, ResolveInfo $resolveInfo)
    {
        $fieldName = $resolveInfo->fieldName;
        $currency = $source->{$fieldName};

        if (!empty($arguments['locale'])) {
            $currencyRepository = new CurrencyRepository;
            $currency = $currencyRepository->get($currency->getCurrencyCode(), $arguments['locale']);
        }

        return [
            'name' => $currency->getName(),
            'currencyCode' => $currency->getCurrencyCode(),
            'symbol' => $currency->getSymbol(),
            'numericCode' => $currency->getNumericCode(),
            'locale' => $currency->getLocale(),
            'fractionDigits' => $currency->getFractionDigits()
        ];
    }
}
