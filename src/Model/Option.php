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
namespace WilburYu\HyperfOptions\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * Class Option.
 *
 * @property string $value
 * @property string $key
 * @property string $description
 */
class Option extends Model
{
    protected ?string $table = 'options';

    protected array $fillable = [
        'key',
        'value',
        'description',
    ];
}
