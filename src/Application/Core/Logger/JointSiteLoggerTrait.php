<?php

namespace JointSite\Core\Logger;

trait JointSiteLoggerTrait
{
    public $logger;

    public function setLogger(string $component_name)
    {
        $this->logger = new JointSiteLogger();
        $this->logger->logger_context["component_name"] = $component_name;
    }
}