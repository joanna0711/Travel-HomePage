<?php
    $db = '
    (DESCRIPTION = 
        (ADDRESS_LIST=
            (ADDRESS = (PROTOCOL = TCP)(HOST = 203.249.87.57)(PORT = 1521))
        )
        (CONNECT_DATA = 
        (SID = orcl)
        )
    )';
    $username="DBA2022G5";
    $pw="test1234";
    
    $connect = oci_connect($username, $pw, $db);

?>