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

/** Ensures that a UID-enabled object is always stored with a UID.
 *
 * @author Phoenix Zerin <phoenix@todofixthis.com>
 *
 * @package phxDoctrineAutoUidPlugin
 * @subpackage lib.doctrine
 */
class AutoUidListener extends Doctrine_Record_Listener
{
  const
    REQUIRED_INTERFACE = 'UidGenerator';

  /** Init the class instance.
   *
   * @param array $options
   *
   * @return void
   * @throws InvalidArgumentException if the UID generator is invalid.
   */
  public function __construct( array $options )
  {
    if( empty($options['generator']) )
    {
      throw new InvalidArgumentException(
        'Missing value for "generator" option.'
      );
    }

    if( ! class_exists($options['generator']) )
    {
      throw new InvalidArgumentException(sprintf(
        'UID generator class %s does not exist.',
          $options['generator']
      ));
    }

    $ref = new ReflectionClass($options['generator']);
    if( ! $ref->implementsInterface(self::REQUIRED_INTERFACE) )
    {
      throw new InvalidArgumentException(sprintf(
        'UID generator class %s does not implement required interface %s.',
          $options['generator'],
          self::REQUIRED_INTERFACE
      ));
    }

    $this->setOption('generator', $ref->newInstance());
  }

  public function preSave( Doctrine_Event $event )
  {
    $record = $event->getInvoker();
    if( $record->getUid() == '' )
    {
      $record->setUid($this->getOption('generator')->generateUid($record));
    }
  }
}
