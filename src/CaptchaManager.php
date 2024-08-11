<?php declare(strict_types = 1);

namespace Dravencms\Captcha;

use Dravencms\Captcha\Forms\ICaptchaField;

class CaptchaManager
{
    private ICaptchaProvider $provider;

    public function __construct(ICaptchaProvider $provider)
    {
        $this->provider = $provider;
    }


    public function prepareField(string $label, ?string $message = null): ICaptchaField {
        //@TODO is this neeeded?
        return $this->provider->prepareField($label, $message);
    }
}
