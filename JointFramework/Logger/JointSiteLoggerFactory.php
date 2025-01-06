<?php

namespace JointFramework\Logger;

class JointSiteLoggerFactory
{
    public static function getLoggerContext(array $context):JointSiteLogger
    {
        return (new JointSiteLogger())
            ->withContext($context);
    }
}