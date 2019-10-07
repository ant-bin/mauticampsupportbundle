<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticAMPSupportBundle\EventListener;


use Mautic\CampaignBundle\Entity\Lead;
use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\EmailBundle\EmailEvents;
use Mautic\EmailBundle\Event as Events;
use Mautic\CoreBundle\Exception as MauticException;
use MauticPlugin\MauticAMPSupportBundle\Helper\AMPHelper;

/**
 * Class EmailSubscriber.
 */
class EmailSubscriber extends CommonSubscriber
{
    /**
     * @var AMPHelper $AMPHelper ;
     */
    protected $AMPHelper;


    /**
     * EmailSubscriber constructor.
     *
     * @param AMPHelper $AMPHelper
     */
    public function __construct(AMPHelper $AMPHelper)
    {
        $this->AMPHelper = $AMPHelper;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            EmailEvents::EMAIL_ON_SEND => ['onEmailGenerate', 0],
            EmailEvents::EMAIL_ON_DISPLAY => ['onEmailGenerate', 0],
        ];
    }

    /**
     * Add AMP part
     *
     * @param EmailSendEvent $event
     */
    public function onEmailGenerate(Events\EmailSendEvent $event)
    {
        $content = $event->getContent();
        $content = $this->AMPHelper->processEmail($content,  $event->getLead());
        $event->setContent($content);
    }



}