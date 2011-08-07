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

/** Generates a UID for a Doctrine object.
 *
 * @package phxDoctrineAutoUidPlugin
 * @subpackage lib
 */
class UidGenerator
{
  /** Generates a new random UID for an object.
   *
   * @param Doctrine_Record $record
   *
   * @return string(sha1)
   */
  static public function generateFromRecord( Doctrine_Record $record )
  {
    return sha1(uniqid(print_r($record->toArray(), true), true));
  }
}