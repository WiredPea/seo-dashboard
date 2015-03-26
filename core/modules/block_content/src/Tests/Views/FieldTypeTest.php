<?php

/**
 * @file
 * Contains \Drupal\block_content\Tests\Views\FieldTypeTest.
 */

namespace Drupal\block_content\Tests\Views;

use Drupal\views\Views;

/**
 * Tests the Drupal\block_content\Plugin\views\field\Type handler.
 *
 * @group block_content
 */
class FieldTypeTest extends BlockContentTestBase {

  /**
   * Views used by this test.
   *
   * @var array
   */
  public static $testViews = array('test_field_type');

  public function testFieldType() {
    $block_content = $this->createBlockContent();
    $expected_result[] = array(
      'id' => $block_content->id(),
      'block_content_field_data_type' => $block_content->bundle(),
    );
    $column_map = array(
      'id' => 'id',
      'block_content_field_data_type' => 'block_content_field_data_type',
    );

    $view = Views::getView('test_field_type');
    $this->executeView($view);
    $this->assertIdenticalResultset($view, $expected_result, $column_map, 'The correct block_content type was displayed.');
  }

}
