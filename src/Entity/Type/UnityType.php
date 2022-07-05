<?php

declare(strict_types=1);

/**
 *  This file is part of MyCook Application.
 *  (c) Sabinus52 <sabinus52@gmail.com>
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace App\Entity\Type;

use App\Constant\Unity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Type personnalisé de mapping pour des unités dea quantités des ingrédients.
 *
 * @author Olivier <sabinus52@gmail.com>
 */
class UnityType extends Type
{
    public const UNITY = 'unity';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(2)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Unity($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }

    public function getName()
    {
        return self::UNITY;
    }
}
