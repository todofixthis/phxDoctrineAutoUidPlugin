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

- `column`: Specify the name of the column that will contain the UID (default: `uid`).
- `generator`: Specify the name of the class that will be used to generate UIDs (default: `UidGenerator_RandomSha1`).
- `length`: Specify the size of the column that will contain the UID (default: `40`).
- `index`: (array)
  - `enabled`: Specify whether to index the UID column (default: `true`),
  - `name`: Specify the name of the index (default: `(table name)_autouid`).
  - `unique`: Specify whether the index is unique (default: `true`)

Example:

    # sf_config_dir/doctrine/schema.yml

    MyModel:
      actAs:
        AutoUid:
          column:     hash
          length:     32
          generator:  MD5ChecksumGenerator
          index:
            unique: false
      ...

The classname specified for the `generator` option must implement the
  `UidGenerator` interface (included as part of this plugin).

# Known Issues

- It is possible to set a record's UID to an invalid value using a DQL update
    query.  Try not to do that.
- [#2] Relations based off of a record's UID field are not updated if the record's UID is changed.  As a workaround, make sure you `save()` new records before adding related records, and try really hard not to change an existing record's UID.
  - An additional consequence of this issue is that you cannot set up relations in data fixture files except by explicitly specifying the UID value for each record.

# Changelog

## 1.1.0

- Resolved [#1]:  Specify UID generator in schema.yml.

## 1.0.2

- Allow specifying a unique index that has the same name as the UID column.
  - Sorry Doctrine; that one was my fault, not yours.

## 1.0.1

- `preInsert()` no longer overrides custom-set UIDs.

## 1.0.0

- Initial release.
