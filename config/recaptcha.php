<?php

/**
 * Copyright (c) 2017 - present
 * LaravelGoogleRecaptcha - recaptcha.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 12/9/2018
 * MIT license: https://github.com/biscolab/laravel-recaptcha/blob/master/LICENSE
 */

/**
 * To configure correctly please visit https://developers.google.com/recaptcha/docs/start
 */
return [
    'api_site_key'                 => env('RECAPTCHA_SITE_KEY', ''),
    'api_secret_key'               => env('RECAPTCHA_SECRET_KEY', ''),
    'version'                      => 'v2',
    'curl_timeout'                 => 10,
    'skip_ip'                      => env('RECAPTCHA_SKIP_IP', []),
    'default_validation_route'     => 'biscolab-recaptcha/validate',
    'default_token_parameter_name' => 'token',
    'default_language'             => null,
    'default_form_id'              => 'biscolab-recaptcha-invisible-form',

    /**
     *
     * Deferring the render can be achieved by specifying your onload callback function and adding parameters to the JavaScript resource.
     * It has no effect with v3 and invisible
     * @see   https://developers.google.com/recaptcha/docs/display#explicit_render
     * @since v4.0.0
     * Supported true, false
     *
     */
    'explicit'                     => false,

    /**
     *
     * Set API domain. You can use "www.recaptcha.net" in case "www.google.com" is not accessible.
     * (no check will be made on the entered value)
     * @see   https://developers.google.com/recaptcha/docs/faq#can-i-use-recaptcha-globally
     * @since v4.3.0
     * Default 'www.google.com' (ReCaptchaBuilder::DEFAULT_RECAPTCHA_API_DOMAIN)
     *
     */
    'api_domain'                   => 'www.recaptcha.net',

    /**
     *
     * Set `true` when the error message must be null
     * @since v5.1.0
     * Default false
     *
     */
    'empty_message' => false,

    /**
     *
     * Set either the error message or the errom message translation key
     * @since v5.1.0
     * Default 'validation.recaptcha'
     *
     */
    'error_message_key' => 'validation.recaptcha',

    /**
     *
     * g-recaptcha tag attributes and grecaptcha.render parameters (v2 only)
     * @see   https://developers.google.com/recaptcha/docs/display#render_param
     * @since v4.0.0
     */
    'tag_attributes'               => [

        /**
         * The color theme of the widget.
         * Supported "light", "dark"
         */
        'theme'            => 'light',

        /**
         * The size of the widget.
         * Supported "normal", "compact"
         */
        'size'             => 'normal',

        /**
         * The tabindex of the widget and challenge.
         * If other elements in your page use tabindex, it should be set to make user navigation easier.
         */
        'tabindex'         => 3,

        /**
         * The name of your callback function, executed when the user submits a successful response.
         * The g-recaptcha-response token is passed to your callback.
         * DO NOT SET "biscolabOnloadCallback"
         */
        'callback'         => "callbackFunction",

        /**
         * The name of your callback function, executed when the reCAPTCHA response expires and the user needs to re-verify.
         * DO NOT SET "biscolabOnloadCallback"
         */
        'expired-callback' => "expiredCallbackFunction",

        /**
         * The name of your callback function, executed when reCAPTCHA encounters an error (usually network connectivity) and cannot continue until connectivity is restored.
         * If you specify a function here, you are responsible for informing the user that they should retry.
         * DO NOT SET "biscolabOnloadCallback"
         */
        'error-callback'   => "errorCallbackFunction",
    ]
];
