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
     * @param mixed $event
     * @return string
     */
    public function processEmail($content, $event)
    {
        // convert Lead entity to array
	$lead = $event->getLead();
        if($lead instanceof Lead){
            $lead = $lead->getProfileFields();
        }

	$amlsource="";
	$pattern = "/<!--amlpart=(.*?)-->/sm";
	preg_match_all($pattern, $content, $matches);
	if (count($matches[0])) {
		$amlsource = $matches[1][0];
		$content = preg_replace($pattern,"",$content);
	}

        return $content;
    }
}
