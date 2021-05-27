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
namespace WilburYu\HyperfOptions;

use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Hyperf\Cache\Annotation\CachePut;
use WilburYu\HyperfOptions\Exception\OptionsException;
use WilburYu\HyperfOptions\Model\Option;

class OptionService
{
    public function exists(string $key): bool
    {
        return (bool) $this->get($key);
    }

    /**
     * @Cacheable(prefix="option", value="#{key}")
     */
    public function get(string $key, ?string $default = null): ?string
    {
        /** @var Option $option */
        $option = Option::query()->where('key', $key)->first(['value']);

        if ($option === null && $default === null) {
            new OptionsException('options key not found');
        }

        return $option->value ?? $default;
    }

    public function set(string $key, ?string $value = null, ?string $description = null): ?string
    {
        $result = Option::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'description' => $description]
        );

        return $result ? $value : null;
    }

    /**
     * @param string $key
     *
     * @throws \Exception
     * @return bool
     */
    public function remove(string $key): bool
    {
        $option = Option::query()->where('key', $key)->first();
        if (! $option) {
            return false;
        }

        return (bool) $option->delete();
    }

    /**
     * @CacheEvict(prefix="option", value="#{key}")
     */
    public function flushCache(string $key): void
    {
    }

    /**
     * @CachePut(prefix="option", value="#{key}")
     */
    public function putCache(string $key, ?string $value = null): ?string
    {
        return $value;
    }
}
