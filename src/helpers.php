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
use Hyperf\Utils\ApplicationContext;
use WilburYu\HyperfOptions\OptionService;

if (! function_exists('options')) {
    function options(): OptionService
    {
        return ApplicationContext::getContainer()->get(OptionService::class);
    }
}
