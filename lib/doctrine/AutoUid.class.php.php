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
  protected $_options = array(
    'column'      => 'uid',
    'index'       => array(
      'enabled'     => true,
      'name'        => null,
      'unique'      => true
    )
  );

  public function setTableDefinition()
  {
    /* Add UID column. */
    $column = $this->getOption('column', 'uid');
    $this->hasColumn($column, 'string', 40);

    /* Add index if directed to do so. */
    if( $this->_options['index']['enabled'] )
    {
      /* Pick a name for this index. */
      $index = $this->_options['index']['name'];
      if( $index == '' )
      {
        $index = $this->getTable()->getTableName() . '_autouid';
      }

      /* Add field and set uniqueness. */
      $opts = array('fields' => array($column));
      if( $this->_options['index']['unique'] )
      {
        /** @kludge Doctrine won't allow a unique key if its name matches its
         *    column.
         *
         * Doctrine will still create the table; it will just make the index
         *  non-unique
         */
        if( $index == $column )
        {
          throw new Doctrine_Exception(sprintf(
            'Cannot name AutoUid unique key "%s" for table %s; Doctrine does not allow unique key names to match their field names.',
              $index,
              $this->getTable()->getTableName()
          ));
        }

        $opts['type'] = 'unique';
      }

      $this->index($index, $opts);
    }

    /* Install the magic maker. */
    $this->addListener(new AutoUidListener());
  }
}