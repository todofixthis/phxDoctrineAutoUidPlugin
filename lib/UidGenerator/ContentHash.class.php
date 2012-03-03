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

/** Generates a hash from the content of a record.
 *
 * This class expects the record to implement the UidHashable interface.
 *
 * @author Phoenix Zerin <phoenix@todofixthis.com>
 *
 * @package phxDoctrineAutoUidPlugin
 * @subpackage lib
 */
class UidGenerator_ContentHash
  implements UidGenerator
{
  /** Generates the UID for a Doctrine_Record.
   *
   * @param UidHashable|Doctrine_Record $record
   *
   * @return string
   */
  public function generateUid( Doctrine_Record $record )
  {
    if( ! ($record instanceof UidHashable) )
    {
      throw new LogicException(sprintf(
        '%s is not compatible with %s; UidHashable expected.'
          , get_class($record)
          , get_class($this)
      ));
    }

    return sha1(serialize((array) $record->getHashData()));
  }
}