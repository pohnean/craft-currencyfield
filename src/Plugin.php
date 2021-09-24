<?php

namespace pohnean\currencyfield;

use craft\events\RegisterGqlTypesEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Gql;
use craft\services\Fields;
use yii\base\Event;

use pohnean\currencyfield\fields\CurrencyField;
use pohnean\currencyfield\gql\types\fields\CurrencyField as CurrencyFieldType;

/**
 * Class Currencyselect
 *
 * @author    Tai Poh Nean
 * @package   Currencyselect
 * @since     1.0.0
 *
 */
class Plugin extends \craft\base\Plugin
{
	// Static Properties
	// =========================================================================

	/**
	 * @var Plugin
	 */
	public static $plugin;

	// Public Properties
	// =========================================================================

	/**
	 * @var string
	 */
	public $schemaVersion = '1.0.0';

	// Public Methods
	// =========================================================================

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		self::$plugin = $this;

		Event::on(
			Fields::class,
			Fields::EVENT_REGISTER_FIELD_TYPES,
			function (RegisterComponentTypesEvent $event) {
				$event->types[] = CurrencyField::class;
			}
		);

		Event::on(
            Gql::class,
            Gql::EVENT_REGISTER_GQL_TYPES,
            function (RegisterGqlTypesEvent $event) {
                $event->types[] = CurrencyFieldType::class;
            }
        );
	}
}
