<?php

namespace Phpro\MailManager\Mail\Base;

use Phpro\MailManager\Mail\MandrillMailInterface;
use Zend\Mime\Part;

/**
 * Class MandrillMail
 *
 * @package Phpro\MailManager\Mail\Base
 */
class MandrillMail extends Mail
    implements MandrillMailInterface
{

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var array
     */
    protected $tags = array();

    /**
     * @var string
     */
    protected $template;

    /**
     * @var array
     */
    protected $templateContent = array();

    /**
     * @var array
     */
    protected $globalVariables = array();

    /**
     * @var array
     */
    protected $variables = array();

    /**
     * @var array
     */
    protected $globalMetadata = array();

    /**
     * @var array
     */
    protected $metadata = array();

    /**
     * @var Part[]|array
     */
    protected $images = array();

    /**
     * Add options to the message
     *
     * @param  array $options
     * @return self
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Set an option to the message
     *
     * @param  string $key
     * @param  string $value
     * @return self
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
        return $this;
    }

    /**
     * Get all the options of the message
     *
     * @return string[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get all tags for this message
     *
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set all tags for this message
     *
     * @param  array $tags
     * @return self
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Add a tag to this message
     *
     * @param string $tag
     * @return self
     */
    public function addTag($tag)
    {
        $this->tags[] = (string) $tag;
        return $this;
    }

    /**
     * Set self template name to use
     *
     * @param  string $template
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = (string) $template;
        return $this;
    }

    /**
     * Get self template name to use
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set template content to inject
     *
     * @param  array $templateContent
     * @return self
     */
    public function setTemplateContent(array $templateContent)
    {
        $this->templateContent = $templateContent;
        return $this;
    }

    /**
     * Get template content to inject
     *
     * @return array
     */
    public function getTemplateContent()
    {
        return $this->templateContent;
    }

    /**
     * Set the global parameters to use with the template
     *
     * @param  array $globalVariables
     * @return self
     */
    public function setGlobalVariables(array $globalVariables)
    {
        $this->globalVariables = $globalVariables;
        return $this;
    }

    /**
     * Get the global parameters to use with the template
     *
     * @return array
     */
    public function getGlobalVariables()
    {
        return $this->globalVariables;
    }

    /**
     * Set the template parameters for a given recipient address
     *
     * @param  string $recipient
     * @param  array  $variables
     * @return self
     */
    public function setVariables($recipient, array $variables)
    {
        $this->variables[$recipient] = $variables;
        return $this;
    }

    /**
     * Get the template parameters for all recipients
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Set the global metadata to send with with message
     *
     * @param  array $globalVariables
     * @return self
     */
    public function setGlobalMetadata(array $globalMetadata)
    {
        $this->globalMetadata = $globalMetadata;
        return $this;
    }

    /**
     * Get the global metadata to send with with message
     *
     * @return array
     */
    public function getGlobalMetadata()
    {
        return $this->globalMetadata;
    }

    /**
     * Set the metadata for a given recipient address
     *
     * @param  string $recipient
     * @param  array  $variables
     * @return self
     */
    public function setMetadata($recipient, array $metadata)
    {
        $this->metadata[$recipient] = $metadata;
        return $this;
    }

    /**
     * Get the metadata for all recipients
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Set attachments to the message
     *
     * @param  Part[]|array $images
     * @return self
     */
    public function setImages(array $images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * Add image to the message
     *
     * @param  Part $image
     * @return self
     */
    public function addImage(Part $image)
    {
        $this->images[] = $image;
        return $this;
    }

    /**
     * Get images of the message
     *
     * @return array|Part[]
     */
    public function getImages()
    {
        return $this->images;
    }

}
