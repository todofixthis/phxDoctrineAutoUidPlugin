<?php
/**
 * This file is part of phxDoctrineAutoUidPlugin.
 *
 * phxDoctrineAutoUidPlugin is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the License,
 * or (at your option) any later version.
 *
 * phxDoctrineAutoUidPlugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser
 * General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with phxDoctrineAutoUidPlugin.  If not, see
 * <http://www.gnu.org/licenses/>.
 */

/** Configures a model for use with the UID behavior.
 *
 * @package phxDoctrineAutoUidPlugin
 * @subpackage lib.doctrine
 */
class AutoUid extends Doctrine_Template
{
  public function setTableDefinition()
  {
    $column = $this->getOption('column', 'uid');

    $this->hasColumn($column, 'string', 40);
    $this->index($column, array('fields' => array($column)));

    $this->addListener(new AutoUidListener());
  }
}