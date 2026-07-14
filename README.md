# Form Dynamic Recipient for EXT:form / TYPO3 14.3

This extension adds simple database records, that can be used to generate a select field in the frontend.
The selected option can be accessed with an assigned alias and thus be used as a dynamic recipient, e.g. in the _Recipient address_ field.

Use the old release from `extrameile/form-dynamic-recipient` if you need support for TYPO3 <= 12.4. Further development and support will happen in this repository.

## Installation via composer
```
composer require andreaskiessling/form-dynamic-recipient
```

## Setup

The form framework configuration is auto-discovered by TYPO3 from
`EXT:form_dynamic_recipient/Configuration/Form/FormDynamicRecipient/config.yaml`.

The site using the form framework must include the core form Site Set:
```
dependencies:
  - typo3/form
```

### Upgrade to TYPO3 14

The extension's former Site Set is no longer required because TYPO3 14.2 and
later auto-discover the form framework configuration. Remove the following
dependency from your site's `config.yaml`:

```yaml
dependencies:
  - andreaskiessling/formdynamicrecipient
```

Keep the `typo3/form` dependency in the site configuration.

## Usage
* Create database records with a label and target email address
* add a select field of type _Selectable recipient_ to the form, configure the page to load the values from and the variable to fill with the selected value: `dynamicRecipient` is preset when adding the field and is not configurable in the form manager, only directly in the YAML file
* New with version 3.x: leave the page field empty in the form yaml to load the recipients from the page with the form plugin
* Configure the _Email to receiver_ finisher with `{dynamicRecipient.email}` and `{dynamicRecipient.label}` - set the form field to required, if you use {dynamicRecipient.email} as the target email address.

# Running phpstan

```
.Build/bin/phpstan analyse --memory-limit=1G -l6 .
```

# Resources
* https://daniel-siepmann.de/Posts/2017/2017-09-07-typo3-form-select-with-db-values.html
* https://github.com/tritum/form_element_linked_checkbox

# Contributors
Thanks to Thomas Löffler (spoonerWeb) and Hawkeye1909 for your contributions!
