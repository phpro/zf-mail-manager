<?php

namespace spec\Phpro\MailManager\Mail\Base;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MandrillSpec extends MailSpec
{

    public function it_is_a_zend_mail_object()
    {
        $this->shouldImplement('Phpro\MailManager\Mail\MandrillInterface');
    }

    public function it_should_have_options()
    {
        $this->setOptions(['test1' => 'test1']);
        $this->setOption('test2', 'test2');
        $this->getOptions()->shouldReturn(['test1' => 'test1', 'test2' => 'test2']);
    }

    public function it_should_have_tags()
    {
        $this->setTags(['tag1']);
        $this->addTag('tag2');
        $this->getTags()->shouldReturn(['tag1', 'tag2']);
    }

    public function it_should_have_a_template()
    {
        $value = 'template';
        $this->setTemplate($value);
        $this->getTemplate()->shouldReturn($value);
    }

    public function it_should_have_template_content()
    {
        $value = ['content' => 'value'];
        $this->setTemplateContent($value);
        $this->getTemplateContent()->shouldReturn($value);
    }

    public function it_should_have_global_variables()
    {
        $value = ['var1' => 'var1'];
        $this->setGlobalVariables($value);
        $this->addGlobalVariable('var2', 'var2');
        $this->getGlobalVariables()->shouldReturn(['var1' => 'var1', 'var2' => 'var2']);
    }

    public function it_should_have_variables()
    {
        $recipient = 'test@dispostable.com';
        $value = ['var1' => 'var1'];
        $this->setVariables($recipient, $value);
        $this->getVariables()->shouldReturn([$recipient => $value]);
    }

    public function it_should_have_global_metadata()
    {
        $value = ['meta1' => 'meta1'];
        $this->setGlobalMetadata($value);
        $this->addGlobalMetadata('meta2', 'meta2');
        $this->getGlobalMetadata()->shouldReturn(['meta1' => 'meta1', 'meta2' => 'meta2']);
    }

    public function it_should_have_metadata()
    {
        $recipient = 'test@dispostable.com';
        $value = ['meta1' => 'meta1'];
        $this->setMetadata($recipient, $value);
        $this->getMetadata()->shouldReturn([$recipient => $value]);
    }

    /**
     * @param \Zend\Mime\Part $image
     */
    public function it_should_have_images($image)
    {
        $this->setImages([$image]);
        $this->addImage($image);
        $this->getImages()->shouldReturn([$image, $image]);
    }

}
