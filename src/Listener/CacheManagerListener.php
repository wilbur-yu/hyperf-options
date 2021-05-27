<?php

declare(strict_types = 1);
/**
 * This file is part of project wilbur-yu/hyperf-options.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @author  wenber.yu@creative-life.club
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace WilburYu\HyperfOptions\Listener;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Database\Model\Events\Deleted;
use Hyperf\Database\Model\Events\Event;
use Hyperf\Database\Model\Events\Saved;
use Hyperf\Event\Contract\ListenerInterface;
use Psr\Container\ContainerInterface;
use WilburYu\HyperfOptions\Model\Option;
use WilburYu\HyperfOptions\OptionService;

class CacheManagerListener implements ListenerInterface
{
    protected OptionService $option;

    protected StdoutLoggerInterface $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->option = $container->get(OptionService::class);
        $this->logger = $container->get(StdoutLoggerInterface::class);
    }

    public function listen(): array
    {
        return [
            Deleted::class,
            Saved::class,
        ];
    }

    public function process(object $event): void
    {
        $this->logger->info('进入option cache 监听');
        if (! $event instanceof Event) {
            $this->logger->info('不是事件');

            return;
        }

        $model = $event->getModel();
        if (! $model instanceof Option) {
            $this->logger->info('不是 option 模型');

            return;
        }

        $this->logger->info('匹配模型事件');
        if ($event instanceof Saved) {
            $this->option->putCache($model->key, $model->value);
            $this->logger->info('Event ' . Saved::class . ' by ' . __CLASS__ . ' listener.');

        } else {
            $this->option->flushCache($model->key);
            $this->logger->info('Event ' . Deleted::class . ' by ' . __CLASS__ . ' listener.');
        }
    }
}
