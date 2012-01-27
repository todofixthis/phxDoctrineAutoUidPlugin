<?php
/** This file is part of phxDoctrineAutoUidPlugin.
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

/** Generates a random SHA1-style UID for a Doctrine object.
 *
 * @author Phoenix Zerin <phoenix@todofixthis.com>
 *
 * @package phxDoctrineAutoUidPlugin
 * @subpackage lib
 */
class UidGenerator_RandomSha1
  implements UidGenerator
{
  /** Generates the UID for a Doctrine_Record.
   *
   * @param Doctrine_Record $record
   *
   * @return string
   */
  public function generateUid( Doctrine_Record $record )
  {
    return sha1(uniqid(print_r($record->toArray(), true), true));
  }
}