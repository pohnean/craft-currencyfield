<?php

namespace pohnean\currencyfield\fields;

use CommerceGuys\Intl\Currency\Currency;
use CommerceGuys\Intl\Currency\CurrencyRepository;
use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\base\PreviewableFieldInterface;
use craft\base\SortableFieldInterface;
use yii\db\Schema;

class CurrencyField extends Field implements PreviewableFieldInterface, SortableFieldInterface
{
	public static function displayName(): string
	{
		return \Craft::t('currency-field', 'Currency');
	}

	/**
	 * @inheritdoc
	 */
	public function getContentColumnType(): string
	{
		return Schema::TYPE_STRING . '(3)';
	}

	/**
	 * @inheritdoc
	 */
	public function getInputHtml($value, ElementInterface $element = null): string
	{
		// Get our id and namespace
		$id = Craft::$app->getView()->formatInputId($this->handle);
		$namespacedId = Craft::$app->getView()->namespaceInputId($id);

		$language = 'en-US';
		if ($element != null) {
			$language = $element->getSite()->language;
		}

		// Render the input template
		return Craft::$app->getView()->renderTemplate(
			'currency-field/_select',
			[
				'name'         => $this->handle,
				'value'        => $value,
				'field'        => $this,
				'id'           => $id,
				'namespacedId' => $namespacedId,
				'options'      => $this->getOptions($language),
			]
		);
	}

	/**
	 * @return array
	 */
	protected function getOptions(string $language): array
	{
		$repository = new CurrencyRepository();
		$currencies = $repository->getAll($language);

		$options = [];

		if (!$this->required) {
			$options[] = ['value' => null, 'label' => ''];
		}

		$options = array_merge($options, array_map(function (Currency $currency) {
			$currencyCode = $currency->getCurrencyCode();
			return [
				'value' => $currencyCode,
				'label' => $currencyCode . ' - ' . $currency->getName(),
			];
		}, $currencies));

		usort($options, function ($a, $b) {
			return strcasecmp($a['value'], $b['label']);
		});

		return $options;
	}
}
