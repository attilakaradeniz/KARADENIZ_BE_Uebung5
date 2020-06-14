<?php
class DBGatewayModel extends DatabaseService
{
    public function dbGatewayModel()
    {
        parent::__construct(DBHost,DBName, DBUserName, DBPassword);
    }
}
