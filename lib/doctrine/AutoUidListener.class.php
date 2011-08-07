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

/** Ensures that a UID-enabled object is always stored with a UID.
 *
 * @package phxDoctrineAutoUidPlugin
 * @subpackage lib.doctrine
 */
class AutoUidListener extends Doctrine_Record_Listener
{
  public function preInsert( Doctrine_Event $event )
  {
    $record = $event->getInvoker();
    $record->setUid(UidGenerator::generateFromRecord($record));
  }

  public function preUpdate( Doctrine_Event $event )
  {
    $record = $event->getInvoker();
    if( $record->getUid() == '' )
    {
      $record->setUid(UidGenerator::generateFromRecord($record));
    }
  }
}