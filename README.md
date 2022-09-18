# Sonata symfony test
## Migration
    bin/console doctrine:migrations:migrate

### Create a new root user
    bin/console sonata:user:create --super-admin
    bin/console fos:user:create $USERNAME $EMAIL $PASSWORD --super-admin
