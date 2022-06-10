# Minimal Reproducible example

This php env attempt to reproduce a [Pest](https://pestphp.com/) bug with the `--coverage` option in a Docker environment.

## Init

*Build the Docker environment*

`docker-compose build`

*Launch the Docker containers in background*

`docker-compose up -d elasticsearch kibana minimal-reproducible-example`

*Connect to the php container*

`docker exec -it -e SHELL=bash minimal-reproducible-example-cli bash`

*Launch the tests with the `--coverage` option*

`./vendor/bin/pest --coverage`

## Error output

```
bash-5.1# ./vendor/bin/pest --coverage

   PASS  Tests\Feature\Commands\TestCommandTest
  ✓ Test command is successful
  ✓ Test command correctly output `test`

  Tests:  2 passed
  Time:   0.08s


                                           
  The "--coverage" option does not exist.  
                                           

list [--raw] [--format FORMAT] [--short] [--] [<namespace>]
```

## Fix

Fixed by removing `<directory suffix=".php">./app</directory>` in **phpunit.xml**.
