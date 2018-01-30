/**
 * Module: TYPO3/CMS/FormElementDynamicFormReceiver/Backend/FormEditor/ViewModel
 */

define(['jquery',
        'TYPO3/CMS/Form/Backend/FormEditor/StageComponent'
        ], function ($, StageComponent) {
        'use strict';

    return (function ($, StageComponent) {

        /**
         * @private
         *
         * @var object
         */
        var _formEditorApp = null;

        /**
         * @private
         *
         * @return object
         */
        function getFormEditorApp() {
            return _formEditorApp;
        }

        /**
         * @private
         *
         * @return object
         */
        function getPublisherSubscriber() {
            return getFormEditorApp().getPublisherSubscriber();
        }

        /**
         * @private
         *
         * @return void
         */
        function _subscribeEvents() {

            /**
             * @private
             *
             * @param string
             * @param array
             *              args[0] = formElement
             *              args[1] = template
             * @return void
             * @subscribe view/stage/abstract/render/template/perform
             */
            getPublisherSubscriber().subscribe('view/stage/abstract/render/template/perform', function (topic, args) {
                if (args[0].get('type') === 'DynamicFormReceiver') {
                    StageComponent.renderSelectTemplates(args[0], args[1]);
                }
            });
        }

        function getDynamicRecipientAliasValues() {
            var nonCompositeNonToplevelFormElements = getFormEditorApp().getNonCompositeNonToplevelFormElements();

            var allowedDynamicProperties = [];

            for (var i = 0, len = nonCompositeNonToplevelFormElements.length; i < len; ++i) {
                var nonCompositeNonToplevelFormElement;

                nonCompositeNonToplevelFormElement = nonCompositeNonToplevelFormElements[i];

                if (nonCompositeNonToplevelFormElement.get('type') === 'DynamicFormReceiver') {
                    var asValue = nonCompositeNonToplevelFormElement.get('properties.assignedVariable');
                    allowedDynamicProperties.push(asValue);
                }
            }
            return allowedDynamicProperties;
        }

        /**
         * @private
         *
         * @return void
         */
        function _addPropertyValidators() {


            getFormEditorApp().addPropertyValidationValidator('isDynamicReceiverEmailField', function (formElement, propertyPath) {
                var values = getDynamicRecipientAliasValues();
                var valid = values.some(function (item) {
                    var value = formElement.get(propertyPath);
                    return value === '{' + item + '.email' + '}';
                });

                if (valid === false) {
                    return 'invalid value';
                }
            });
            getFormEditorApp().addPropertyValidationValidator('isDynamicReceiverNameField', function (formElement, propertyPath) {
                var values = getDynamicRecipientAliasValues();
                var valid = values.some(function (item) {
                    var value = formElement.get(propertyPath);
                    return value === '{' + item + '.name' + '}';
                });

                if (valid === false) {
                    return 'invalid value';
                }
            });
        }

        /**
         * @public
         *
         * @param object formEditorApp
         * @return void
         */
        function bootstrap(formEditorApp) {
            _formEditorApp = formEditorApp;
            _subscribeEvents();
            _addPropertyValidators();
        }

        /**
         * Publish the public methods.
         * Implements the "Revealing Module Pattern".
         */
        return {
            bootstrap: bootstrap
        };

    })($, StageComponent);
});
