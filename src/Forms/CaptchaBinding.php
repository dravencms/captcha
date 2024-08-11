<?php declare(strict_types = 1);

namespace Dravencms\Captcha\Forms;

use Dravencms\Captcha\CaptchaManager;
use Nette\Forms\Container;

final class CaptchaBinding
{

	public static function bind(CaptchaManager $manager, string $name = 'addCaptcha'): void
	{
		// Bind to form container
		Container::extensionMethod($name, function (Container $container, string $name = 'captcha', string $label = 'Captcha', bool|string $required = true, ?string $message = null) use ($manager): ICaptchaField {
			//$field = new CaptchaField($provider, $label, $message);
			$field = $manager->prepareField($label, $message);
			$field->setRequired($required);
			$container[$name] = $field;

			return $field;
		});
	}

}
