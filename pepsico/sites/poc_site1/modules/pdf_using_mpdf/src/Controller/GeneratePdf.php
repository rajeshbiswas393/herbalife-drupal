<?php

namespace Drupal\pdf_using_mpdf\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;
use Drupal\pdf_using_mpdf\Conversion\ConvertToPdf;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GeneratePdf extends ControllerBase {

  /**
   * @var EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * @var ConvertToPdf
   */
  protected $convertToPdf;

  /**
   * Inject ConvertToPdf service
   *
   * GeneratePdf constructor.
   * @param ConvertToPdf $convert
   * @param EntityTypeManagerInterface $entityTypeManager
   * @param ModuleHandlerInterface $moduleHandler
   */
  public function __construct(ConvertToPdf $convert, EntityTypeManagerInterface $entityTypeManager, ModuleHandlerInterface $moduleHandler) {
    $this->convertToPdf = $convert;
    $this->entityTypeManager = $entityTypeManager;
    $this->moduleHandler = $moduleHandler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('pdf_using_mpdf.conversion'),
      $container->get('entity_type.manager'),
      $container->get('module_handler')
    );
  }

  /**
   * Generate a PDF for a given node
   *
   * @param NodeInterface|null $node
   * @return RedirectResponse
   */
  public function generate($node = NULL) {
    // Use 'full' view mode, this can be altered via hooks, if needed
    $view = $this->entityTypeManager->getViewBuilder('node')->view($node);
    $renderedNode = render($view)->__toString();

    // Let other modules alter HTML for PDF generation
    $this->moduleHandler->alter('mpdf_html', $renderedNode, $node);

    // Let other modules alter and overwrite mPDF settings
    $settings = $this->convertToPdf->getConfig();
    $this->moduleHandler->alter('mpdf_settings', $settings, $node);

    $this->convertToPdf->convert($renderedNode, $settings, ['node' => $node]);
    $url = Url::fromRoute('entity.node.canonical', ['node' => $node->id()], ['absolute' => TRUE]);

    return new RedirectResponse($url->toString());
  }

}
