<?php


namespace Phpro\MailManager\Mail;

interface RenderableMailInterface extends MailInterface
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
