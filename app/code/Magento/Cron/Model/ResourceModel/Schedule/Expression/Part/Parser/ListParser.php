<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Cron\Model\ResourceModel\Schedule\Expression\Part\Parser;

/**
 * Cron expression part parser class
 *
 * @api
 */
class ListParser extends AbstractParser
{
    const EXPLODE_CHAR = ',';

    /**
     * ListParser constructor.
     */
    public function __construct()
    {
        parent::__construct(self::EXPLODE_CHAR);
    }
}
