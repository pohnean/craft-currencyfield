<?php

namespace pohnean\currencyfield;

use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use pohnean\currencyfield\fields\CurrencyField;
use yii\base\Event;

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
	}
}
