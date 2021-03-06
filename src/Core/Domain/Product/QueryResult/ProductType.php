<?php
/**
 * 2007-2020 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Domain\Product\QueryResult;

use PrestaShop\PrestaShop\Core\Domain\Product\Exception\ProductConstraintException;

/**
 * Holds product type value
 */
class ProductType
{
    /**
     * Standard product
     */
    const TYPE_STANDARD = 'standard';

    /**
     * A pack consists multiple units of product.
     */
    const TYPE_PACK = 'pack';

    /**
     * Items that are not in physical form and can be sold without requiring any shipping
     * E.g. downloadable photos, videos, software, services etc.
     */
    const TYPE_VIRTUAL = 'virtual';

    /**
     * Product containing combinations of different attributes
     */
    const TYPE_COMBINATION = 'combination';

    /**
     * A list of available types
     */
    const AVAILABLE_TYPES = [
        self::TYPE_STANDARD,
        self::TYPE_PACK,
        self::TYPE_VIRTUAL,
        self::TYPE_COMBINATION,
    ];

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     *
     * @throws ProductConstraintException
     */
    public function __construct(string $value)
    {
        $this->assertProductType($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @throws ProductConstraintException
     */
    private function assertProductType(string $value): void
    {
        if (!in_array($value, self::AVAILABLE_TYPES, true)) {
            throw new ProductConstraintException(
                sprintf(
                    'Invalid product type %s. Valid types are: [%s]',
                    $value,
                    implode(',', self::AVAILABLE_TYPES)
                ),
                ProductConstraintException::INVALID_PRODUCT_TYPE
            );
        }
    }
}
