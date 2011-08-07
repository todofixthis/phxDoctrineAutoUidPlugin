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