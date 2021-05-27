<?php

declare(strict_types=1);
/**
 * This file is part of project wilbur-yu/hyperf-options.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @author  wenber.yu@creative-life.club
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace WilburYu\HyperfOptions;

use WilburYu\HyperfOptions\Listener\CacheManagerListener;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'listeners'   => [
                CacheManagerListener::class
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
        ];
    }
}
