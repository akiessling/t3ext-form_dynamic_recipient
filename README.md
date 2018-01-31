# Dynamic Form Receiver for EXT:form / TYPO3 8.7

This extension adds simple database records, that can be used to generate a select field in the frontend.
The selected option can be accessed with an assigned alias and thus be used as a dynamic recipient, e.g. in the _Recipient address_ field.

## Configuration

* Create database records with a label and target email address
* add a select field of type _Selectable receiver_ to the form, configure the page to load the values from and the variable to fill with the selected value, e.g. `dynamicReceiver`
* Configure the _Email to receiver_ finisher with `{dynamicReceiver.email}` and `{dynamicReceiver.name}` - set the form field to required, if you use {dynamicReceiver.email} as the target email address.


## ToDos

* validate submitted option to contain a uid from the records of the configured storage page


## Resources
* https://daniel-siepmann.de/Posts/2017/2017-09-07-typo3-form-select-with-db-values.html
* https://github.com/tritum/form_element_linked_checkbox


