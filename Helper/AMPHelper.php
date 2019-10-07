<?php

/*
 * @copyright   2016 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticAMPSupportBundle\Helper;

use Joomla\Http\Http;
use Mautic\LeadBundle\Entity\Lead;

/**
 * Class AMPHelper.
 */
class AMPHelper
{
    /**
     * @var Http $connector ;
     */
    protected $connector;

    /**
     * EmailSubscriber constructor.
     *
     * @param Http $connector
     */
    public function __construct(Http $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @param string $content
     * @param mixed $lead
     * @return string
     */
    public function processEmail($content, $lead)
    {
        // convert Lead entity to array
        if($lead instanceof Lead){
            $lead = $lead->getProfileFields();
        }

        return $content;
    }
}
