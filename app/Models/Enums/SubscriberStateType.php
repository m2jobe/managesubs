<?php

namespace App\Models\Enums;

/**
 * @method static SubscriberStateType ACTIVE()
 * @method static SubscriberStateType UNSUBSCRIBED()
 * @method static SubscriberStateType JUNK()
 * @method static SubscriberStateType BOUNCED()
 * @method static SubscriberStateType UNCONFIRMED()
 */
class SubscriberStateType extends Enum
{
    private const ACTIVE = 'active';
    private const UNSUBSCRIBED = 'unsubscribed';
    private const JUNK = 'junk';
    private const BOUNCED = 'bounced';
    private const UNCONFIRMED = 'unconfirmed';
}
