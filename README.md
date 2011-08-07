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
- `index`:  Specify whether the UID column should be indexed (default: `true`).
- `unique`: Specify whether the UID column should have a unique index (default: `true`, ignored if `index` is `false`).

Example:

    # sf_config_dir/doctrine/schema.yml

    MyModel:
      actAs:
        AutoUid:
          column: hash
          unique: false
      ...