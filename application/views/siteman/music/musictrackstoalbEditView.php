<?php
class musicTracksToAlbEditView extends sitemanEditView
{
    public function __construct()
    {
        parent::__construct();
        $this->scripts[] = "/js/siteman/musicTrackToAlbEditView.js";
    }
}