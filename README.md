# About

phxDoctrineAutoUidPlugin adds an AutoUid behavior to Doctrine which ensures that
  every record has a UID when it is inserted/updated.

# Usage

After installing the plugin, you can add the behavior to any of your models in
  your `schema.yml` file:

    # sf_config_dir/doctrine/schema.yml

    MyModel:
      actAs:
        AutoUid:  ~
      ...

## Options

The AutoUid behavior accepts the following options:

- `column`: Specify the name of the column that will contain the UID (default: `"uid"`).
- `index`: (array)
  - `enabled`: Specify whether to index the UID column (default: `true`),
  - `name`: Specify the name of the index (default: `(table name)_autouid`).
  - `unique`: Specify whether the index is unique (default: `true`)

Example:

    # sf_config_dir/doctrine/schema.yml

    MyModel:
      actAs:
        AutoUid:
          column: hash
          index:
            unique: false
      ...

# Known Issues

- It is possible to set a record's UID to an invalid value using a DQL update
    query.  Try not to do that.
- Relations based off of a record's UID field are not updated if the record's UID is changed.  As a workaround, make sure you `save()` new records before adding related records, and try really hard not to change an existing record's UID.

# Changelog

## 1.0.1

- `preInsert()` no longer overrides custom-set UIDs.

## 1.0.0

- Initial release.
