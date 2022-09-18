# Sonata symfony test
## Migration
    bin/console doctrine:migrations:migrate
### Create user
    bin/console fos:user:create $USERNAME $EMAIL $PASSWORD --super-admin
    bin/console fos:user:create admin admin@mydomain.com password123

