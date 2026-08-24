# DravenCMS CAPTCHA

Provider-independent CAPTCHA integration for Nette Forms. It selects an installed CAPTCHA provider and adds the `addCaptcha()` extension method to every Nette form container.

## Installation

Install the integration and one implementation:

```bash
composer require dravencms/captcha dravencms/recaptcha
```

Available implementations in this repository set include:

- `dravencms/recaptcha` for Google reCAPTCHA.
- `dravencms/antiq-captcha` for a session-backed image CAPTCHA.

## Configuration

Point the CAPTCHA manager at the selected provider service:

```neon
dravencms.captcha:
    provider: @dravencms.recaptcha.provider
```

The exact service prefix follows the extension name used when registering the provider package.

## Form Usage

After DI initialization, forms and containers expose `addCaptcha()`:

```php
$form->addCaptcha(
    name: 'captcha',
    label: 'Verification',
    required: true,
    message: 'Please complete the verification.',
);
```

The field is validated by the configured provider and omitted from returned form values. Use only one `dravencms/captcha-implementation` provider in an application unless you configure the desired service explicitly.

## License

This package is licensed under the LGPL-3.0 license.
