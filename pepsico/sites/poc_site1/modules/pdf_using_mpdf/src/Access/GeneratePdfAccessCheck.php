<?php

namespace Drupal\pdf_using_mpdf\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\Access\AccessResultAllowed;
use Drupal\Core\Access\AccessResultForbidden;

/**
 * Class GeneratePdfAccessCheck
 * @package Drupal\pdf_using_mpdf\Access
 */
class GeneratePdfAccessCheck implements AccessInterface {

  /**
   * @param AccountInterface $account
   * @param Node|NULL $node
   *
   * @return AccessResultAllowed|AccessResultForbidden
   */
  public function access(AccountInterface $account, Node $node = NULL) {
    $permission = 'generate ' . $node->getType() . ' pdf';

    return ($account->hasPermission($permission)) ? AccessResult::allowed() : AccessResult::forbidden();
  }

}
