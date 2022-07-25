# ROVER

## Install

Composer is required to install.

```bash
composer install
```

## Execute Tasks

To execute the tasks from a file, the following command must be executed indicating the path to the file

```bash
bin/console robot:process:tasks --filePath=resources/example.txt
```

## Example file

```
5 5
1 2 N
LMLMLMLMM
3 3 E
MMRMMRMRRM
```

## Example output

```
1 3 N
5 1 E
```
