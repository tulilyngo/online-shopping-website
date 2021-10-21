<?php

//Function header for getDBInfo - no input parameters
function  getDBInfo()
{
    $array[0] = 0;
    $count = 0;

    //Open file cf file
    $cfg = fopen("cf.txt","r");

    //Test for opening
    if (!$cfg)
    {
        exit("Cannot open cf.txt");
    }

    //Read the data
    while(true)
    {
        $line = fgets($cfg);

        //Check for eof
        if (!$line)
        {
            break;
        }

        //Otherwise store the results
        $array[$count] = rtrim($line);
        $count++;
    }

    //Return the array
    return($array);

}

//Function header for opening the database
function openDB()
{
    //Get the db info
    $array = getDBInfo();

    //Open database
    $database = mysqli_connect( $array[0], $array[1], $array[2] , $array[3]);

    //Test the database
    if (!$database)
    {
        exit('Cannot open database');
    }

    return($database);
}

// Retrieve item_name from product with given id
function getItemName($item_no){
    //Open the database
    $data = openDB();

    //Implement the query
    $query = "select item_name from product where item_no = '" .$item_no."'";

    //Invoke the query
    $res = mysqli_query($data, $query );

    //Check the result
    if ($res == false)
    {
        //print("No data found<BR/>");
        return(0);
    }

    //Invoke the row
    $item_name = mysqli_fetch_row($res);

    //Close
    mysqli_close($data);


    //Return the result
    return($item_name[0]);
}

// Retrieve price from product with given id
function getPrice($item_no) {
    //Open the database
    $data = openDB();

    //Implement the query
    $query = "select price from product where item_no = '" .$item_no."'";

    //Invoke the query
    $res = mysqli_query($data, $query );

    //Check the result
    if ($res == false)
    {
        //print("No data found<BR/>");
        return(0);
    }

    //Invoke the row
    $price = mysqli_fetch_row($res);

    //Close
    mysqli_close($data);


    //Return the result
    return($price[0]);
}

// Retrieve inventory from product with given id
function getInventory($item_no) {
    //Open the database
    $data = openDB();

    //Implement the query
    $query = "select inventory from product where item_no = '" .$item_no."'";

    //Invoke the query
    $res = mysqli_query($data, $query);

    //Check the result
    if ($res == false)
    {
        //print("No data found<BR/>");
        return(0);
    }

    //Invoke the row
    $inventory = mysqli_fetch_row($res);

    //Close
    mysqli_close($data);


    //Return the result
    return($inventory[0]);
}

function getCustomer($cc_no) {
    //Open the database
    $data = openDB();

    //Implement the query
    $query = "select cc_no from customer where cc_no = '" .$cc_no."'";

    //Invoke the query
    $res = mysqli_query($data, $query);;

    //Close
    mysqli_close($data);


    //Return the result
    return($res);
}

?>