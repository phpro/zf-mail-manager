<?php

namespace spec\Phpro\MailManager\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Phpro\MailManager\Mail\Stub\ProvidesMailStubSpec;

class BodyRendererSpec extends ObjectBehavior
{

    use ProvidesMailStubSpec;

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

        // Body Rendering
        $viewRenderer->render(Argument::that(function ($viewModel)  use ($mail) {
            return $viewModel->getTemplate() === $mail->getViewFile()
                && $viewModel->terminate() === true
                && $viewModel->getVariables()['param1'] == $mail->getParams()['param1'];
        }))->willReturn($parsedBody);

        // Lay-out rendering
        $viewRenderer->render(Argument::that(function ($viewModel) use ($mail, $parsedBody) {
            return $viewModel->getTemplate() === $mail->getLayoutFile()
                && $viewModel->terminate() === true
                && $viewModel->getVariables()['mailBody'] == $parsedBody;
        }))->willReturn($parsedTemplate);

        // Run method:
        $html = $this->render($mail);
        $html->shouldBe($parsedTemplate);
    }
}
