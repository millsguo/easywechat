<?php

declare(strict_types=1);

namespace EasyWeChat\OpenPlatform\Server\Handlers;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class UpdateAuthorized implements EventHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle($payload = null)
    {
        // Do nothing for the time being.
    }
}
