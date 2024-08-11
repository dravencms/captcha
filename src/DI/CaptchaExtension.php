<?php declare(strict_types = 1);

namespace Dravencms\Captcha\DI;

use Dravencms\Captcha\Forms\CaptchaBinding;
use Dravencms\Captcha\CaptchaManager;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class CaptchaExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'provider' => Expect::string()->required()->dynamic(),
		]);
	}

	/**
	 * Register services
	 */
	public function loadConfiguration(): void
	{
		$config = (array) $this->getConfig();
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('manager'))
			->setFactory(CaptchaManager::class, [$config['provider']]);
	}

	/**
	 * Decorate initialize method
	 */
	public function afterCompile(ClassType $class): void
	{
		$method = $class->getMethod('initialize');
		$method->addBody(sprintf('%s::bind($this->getService(?));', CaptchaBinding::class), [$this->prefix('manager')]);
	}

}
