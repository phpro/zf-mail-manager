<?php

namespace Phpro\MailManager\Mail;

use Zend\Mime\Part;

/**
 * Interface MandrillInterface
 *
 * @package Phpro\MailManager\Mail
 */
interface MandrillInterface extends MailInterface, RenderableMailInterface
{

    /**
     * Get all the options of the message
     *
     * @return string[]
     */
    public function getOptions();

    /**
     * Get all tags for this message
     *
     * @return array
     */
    public function getTags();

    /**
     * Get Mandrill template name to use
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Get template content to inject
     *
     * @return array
     */
    public function getTemplateContent();

    /**
     * Get the global parameters to use with the template
     *
     * @return array
     */
    public function getGlobalVariables();

    /**
     * Get the template parameters for all recipients
     *
     * @return array
     */
    public function getVariables();

    /**
     * Get the global metadata to send with with message
     *
     * @return array
     */
    public function getGlobalMetadata();

    /**
     * Get the metadata for all recipients
     *
     * @return array
     */
    public function getMetadata();

    /**
     * Get images of the message
     *
     * @return array|Part[]
     */
    public function getImages();

    /**
     * @return bool
     */
    public function useMandrillTemplate();
}
