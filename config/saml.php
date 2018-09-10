<?php

/**
 * This file is part of laravel-saml,
 * a SAML IDP integration for laravel. 
 *
 * @license MIT
 * @package kingstarter/laravel-saml
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Base settings
    |--------------------------------------------------------------------------
    |
    | General package settings
    |
    */

    // Include the pre-defined routes from package or not.
    'use_package_routes' => true,
    
    // Forward user roles
    // This option requires entrust to be installed and
    // the user model to support the roles() method. Otherwise an empty
    // array of user roles will be forwarded.
    'forward_roles' => false,
    
    // Allow debugging within SamlAuth trait to get SP data during SAML auth
    // request. The debug output is written to storage/logs/laravel.log.
    'debug_saml_request' => true,

    /*
    |--------------------------------------------------------------------------
    | IDP (identification provider) settings
    |--------------------------------------------------------------------------
    |
    | Set overall configuration for laravel as idp server.
    |
    | All files are in storage/saml and referenced via Storage::disk('saml') 
    | as root directory. To have a valid storage configuration, add the root  
    | path to the config/filesystem.php file.
    |
    */
    
    'idp' => [
        'metadata'  => 'idp/metadata.xml',
        'cert'      => 'idp/cert.pem',
        'key'       => 'idp/key.pem',
    ],

    /*
    |--------------------------------------------------------------------------
    | SP (service provider) settings
    |--------------------------------------------------------------------------
    |
    | Array of service provider data. Add your list of SPs here.
    |
    | An SP is defined by its consumer service URL which is base64 encoded. 
    | It contains the destination, issuer, cert and cert-key. 
    |
    */

    'sp' => [        
        
        /**
         * Sample SP entry
         * The entry is identified by the base64 encoded URL. This example shows a possible entry for
         * a SimpleSamlPhp service provider running on localhost:
         * 
         * Sample URL:         https://localhost/samlsp/module.php/saml/sp/saml2-acs.php/default-sp
         * Base64 encoded URL: aHR0cHM6Ly9sb2NhbGhvc3Qvc2FtbHNwL21vZHVsZS5waHAvc2FtbC9zcC9zYW1sMi1hY3MucGhwL2RlZmF1bHQtc3A=
         *
         * Note: To create a new entry, use laravel-saml:encodeurl artisan command to encode your ServiceProvider URL.
         *
         * php artisan laravel-saml:encodeurl https://localhost/samlsp/module.php/saml/sp/saml2-acs.php/default-sp
         * --
         * URL Given: https://sp.webapp.com/saml/login
         * Encoded AssertionURL:aHR0cHM6Ly9sb2NhbGhvc3Qvc2FtbHNwL21vZHVsZS5waHAvc2FtbC9zcC9zYW1sMi1hY3MucGhwL2RlZmF1bHQtc3A=
         *
         * In case of doubt enable debug_saml_request and check the logfile while performing
         * a SAML login request from your SP.
         */
        // Accounts
        'aHR0cHM6Ly9hY2NvdW50cy56b2hvLmNvbS9zYW1scmVzcG9uc2UvNDQ5NTQzNDg=' => [
            // https://mail.zoho.com/portal/webriq
            // The destination is the consuming SAML URL. This might be a SamlAuthController receiving the SAML response.  
            'destination' => 'https://accounts.zoho.com/samlresponse/44954348',
            // Issuer could be anything, mostly it makes sense to pass the metadata URL
            'issuer' => 'https://zoho.com',
            
            // OPTIONAL: Use a specific audience restriction value when creating the SAMLRequest object.
            //           Default value is the assertion consumer service URL (the base64 encoded SP url). 
            //           This is a bugfix for Nextcloud as SP and can be removed for normal SPs.
            'audience_restriction' => 'http://localhost/saml/idp/metadata',
        ],

        // Desk
        'aHR0cHM6Ly9hY2NvdW50cy56b2hvcG9ydGFsLmNvbS9hY2NvdW50cy9jc2FtbHJlc3BvbnNlLzEwMDA5OTcwNTA3' => [
            'destination' => 'https://accounts.zohoportal.com/accounts/csamlresponse/10009970507',
            'issuer' => 'https://zoho.com',
            'audience_restriction' => 'http://4aacb411.ngrok.io/saml/idp/metadata',
        ],

        // Mail
        'aHR0cHM6Ly9hY2NvdW50cy56b2hvLmNvbS9zYW1scmVzcG9uc2Uvd2VicmlxLmJ1c2luZXNzLnpvaG8uY29t' => [
            'destination' => 'https://accounts.zoho.com/samlresponse/webriq.business.zoho.com',
            'issuer' => 'https://zoho.com'
        ]
        
    ],
    
];
