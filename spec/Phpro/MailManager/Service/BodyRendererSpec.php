<?php

namespace spec\Phpro\MailManager\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stub\Phpro\MailManager\Mail\ProvidesRenderableMailStubSpec;

class BodyRendererSpec extends ObjectBehavior
{

    use ProvidesRenderableMailStubSpec;

    /**
     * @param \Zend\View\Renderer\RendererInterface $viewRenderer
     */
    public function let($viewRenderer)
    {
        $this->beConstructedWith($viewRenderer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Service\BodyRenderer');
    }

    /**
     * @param \Zend\View\Renderer\RendererInterface $viewRenderer
     */
    public function it_should_render_a_html_body($viewRenderer)
    {
        $mail = $this->getMailStub();
        $parsedTemplate = '<html><body></body></html>';
        $parsedBody = '<body></body>';

        // Lay-out rendering
        $viewRenderer->render(Argument::type('Zend\View\Model\ViewModel'))
            ->will(function ($arguments) use ($mail, $parsedBody, $parsedTemplate) {
                $viewModel = $arguments[0];
                if ($mail->getLayoutFile() == $viewModel->getTemplate()) {
                    return sprintf('<html>%s</html>', $viewModel->getVariables()['mailBody']);
                } else {
                    return $parsedBody;
                }
            });

        // Run method:
        $html = $this->render($mail);
        $html->shouldBe($parsedTemplate);
    }
}
