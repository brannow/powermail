<?php

declare(strict_types=1);
namespace In2code\Powermail\Fluid;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextFactory;
use TYPO3Fluid\Fluid\View\TemplateView;

/**
 * Stand-in for TYPO3\CMS\Fluid\View\StandaloneView, which TYPO3 v14 removed (Breaking-105377).
 * Offers exactly the part of its API powermail uses, so call sites only change their import.
 * ViewFactoryInterface is no replacement here: it cannot render a template source string
 * (VariablesViewHelper does).
 */
class StandaloneView extends TemplateView
{
    public function __construct()
    {
        parent::__construct(GeneralUtility::makeInstance(RenderingContextFactory::class)->create());
    }

    public function setRequest(?ServerRequestInterface $request): void
    {
        if ($request !== null) {
            $this->getRenderingContext()->setAttribute(ServerRequestInterface::class, $request);
        }
    }

    public function setFormat(string $format): void
    {
        $this->getRenderingContext()->getTemplatePaths()->setFormat($format);
    }

    public function setTemplatePathAndFilename(string $templatePathAndFilename): void
    {
        $this->getRenderingContext()->getTemplatePaths()->setTemplatePathAndFilename($templatePathAndFilename);
    }

    public function setTemplateSource(string $templateSource): void
    {
        $this->getRenderingContext()->getTemplatePaths()->setTemplateSource($templateSource);
    }

    public function setLayoutRootPaths(array $layoutRootPaths): void
    {
        $this->getRenderingContext()->getTemplatePaths()->setLayoutRootPaths($layoutRootPaths);
    }

    public function setPartialRootPaths(array $partialRootPaths): void
    {
        $this->getRenderingContext()->getTemplatePaths()->setPartialRootPaths($partialRootPaths);
    }
}
