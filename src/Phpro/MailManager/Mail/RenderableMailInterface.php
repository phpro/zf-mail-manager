<?php


namespace Phpro\MailManager\Mail;


interface RenderableMailInterface
{

    /**
     * @return array
     */
    public function getParams();

    /**
     * @return string
     */
    public function getViewFile();

    /**
     * @return string
     */
    public function getLayoutFile();
}
