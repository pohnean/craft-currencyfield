<img src="src/icon.svg" alt="icon" width="100" height="100">

# Currency field plugin for Craft CMS 3.x

A multi-language Currency dropdown field type.

## Usage in twig templates
```
# Printing the currency code
{{ item.currency }} // Outputs EUR

# Printing the currency symbol
{{ item.currency.symbol }} // Outputs €

# Printing the local currency name (site language is zh-Hans)
{{ item.currency.name }} // Outputs 欧元 
```

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require pohnean/craft-currencyfield

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Currency Field.

Brought to you by [Tai Poh Nean](https://github.com/pohnean)

"Icon made by Dimitry Miroliubov from www.flaticon.com"
