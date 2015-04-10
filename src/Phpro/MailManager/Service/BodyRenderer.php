<?php

namespace Phpro\MailManager\Service;

use Phpro\MailManager\Mail\RenderableMailInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface;

/**
 * Class SendMail
 *
 * @package Phpro\MailManager\Service
 */
class BodyRenderer
{

    /**
     * @var RendererInterface
     */
    protected $viewRenderer;

    /**
     * @param $viewRenderer
     */
    public function __construct($viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    /**
     * @param RenderableMailInterface $mail
     *
     * @return string
     */
    public function render(RenderableMailInterface $mail)
    {
        $content = $this->renderContent($mail);
        $body = $this->renderLayout($mail, $content);
        return $body;
    }

    /**
     * @param RenderableMailInterface $mail
     * @param null          $content
     *
     * @return string
     */
    protected function renderLayout(RenderableMailInterface $mail, $content = null)
    {
        if (!$content) {
            $content = $this->renderContent($content);
        }

        $layout = new ViewModel();
        $layout->setTemplate($mail->getLayoutFile());
        $layout->setTerminal(true);
        $layout->setVariable('mailBody', $content);
        return $this->viewRenderer->render($layout);
    }

    /**
     * @param RenderableMailInterface $mail
     *
     * @return string
     */
    protected function renderContent(RenderableMailInterface $mail)
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate($mail->getViewFile());
        $viewModel->setTerminal(true);
        $viewModel->setVariables($mail->getParams());

        return $this->viewRenderer->render($viewModel);
    }
}
