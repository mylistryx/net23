<?php
/** Site */

use yii\web\GroupUrlRule;

const URL_HOME = '/site/index';
const URL_CONTACT = '/site/contact';
const URL_ABOUT = '/site/about';

/** Auth */
const URL_AUTH_LOGIN = '/auth/login';
const URL_AUTH_LOGOUT = '/auth/logout';

/** Signup */
const URL_SIGNUP_REQUEST = '/signup/request';
const URL_SIGNUP_RESEND = '/signup/resend';
const URL_SIGNUP_COMPLETE = '/signup/complete';

/** Password reset */
const URL_PR_REQUEST = '/password-reset/request';
const URL_PR_COMPLETE = '/password-reset/complete';

/** Definitions */
return [
    ''        => URL_HOME,
    'about'   => URL_ABOUT,
    'contact' => URL_CONTACT,

    new GroupUrlRule([
        'routePrefix' => 'auth',
        'rules'  => [
            'login'  => URL_AUTH_LOGIN,
            'logout' => URL_AUTH_LOGOUT,
        ],
    ]),

    new GroupUrlRule([
        'routePrefix' => 'signup',
        'rules'  => [
            ''         => URL_SIGNUP_REQUEST,
            'resend'   => URL_SIGNUP_RESEND,
            'complete' => URL_SIGNUP_COMPLETE,
        ],
    ]),

    new GroupUrlRule([
        'routePrefix' => 'password-reset',
        'rules'  => [
            ''         => URL_PR_REQUEST,
            'complete' => URL_PR_COMPLETE,
        ],
    ]),
];