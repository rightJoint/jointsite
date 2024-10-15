<?php

namespace JointSite\Core\Logger;

trait JointSiteLoggerTrait
{
    public $logger;
    public $logger_context = array();
    public $logger_lang = array();

    public function setLogger(string $component_name)
    {
        $this->logger = new JointSiteLogger();
        $this->logger_context["component_name"] = $component_name;
    }
}