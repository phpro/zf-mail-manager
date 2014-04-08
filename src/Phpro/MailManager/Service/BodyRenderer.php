<?php

namespace Phpro\MailManager\Service;

use Phpro\MailManager\Mail\MailInterface;
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
     * @param MailInterface $mail
     *
     * @return string
     */
    public function render(MailInterface $mail)
    {
        $content = $this->renderContent($mail);
        $body = $this->renderLayout($mail, $content);
        return $body;
    }

    /**
     * @param MailInterface $mail
     * @param null          $content
     *
     * @return string
     */
    protected function renderLayout(MailInterface $mail, $content = null)
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
     * @param MailInterface $mail
     *
     * @return string
     */
    protected function renderContent(MailInterface $mail)
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate($mail->getViewFile());
        $viewModel->setTerminal(true);
        $viewModel->setVariables($mail->getParams());

        return $this->viewRenderer->render($viewModel);
    }

}
