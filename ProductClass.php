<?php
   ////////////////////////////////////////////////////////////////////////////////////////////////
   // Author : Tracy Ta - Email : tracy.ta@gmail.com
   // Class definitions:
   //--------------------
   //     class itemClass takes in an array and calculate the product of all items in the array , except the item itself.
   //                     If all goes well , it will return an array with these products as elements in the returned array. 
   //     class itemClass has :
   //           class itemClass has 2 arrays , innarr( for input ) and outarr (for output). 
   //           It also has : $errCode - specified the error code when there is an error.
   //              constructor function, which takes in an array as a parameter
   //              getResult   function, which takes in an index and return the product of all items in array,
   //                                 except itself
   //              getArray    function, take in no parameter, it uses getResult function, and it returns an array($outarr)
   //                                 with all expected results in the array.
   //              checkNumeric function, take in no parameter.
   //                                  it checks all items in array $innarr to be a numeric or not
   //                                    if one is not a numeric it returns FALSE , and set the correspond $errCode
   //
   //              getErrCode  function, take in no parameter. It returns the $errCode of this class.
   //     
   // Documentation
   //---------------
   //           The class itemClass can be tested using the command "php ProductClass.php"
   //           The result will be returned when you called getArray() function of this class.
   //           If you want to get the nth item of the products array (outarr), you can call getResult(n) 
   //           The returned result is an array with all products of each item in array without the item itself.
   //           Details:
   //           -------
   //           constructor function: take in an array as a parameter.
   //                                 assign the input array to $innarr
   //                                 get the count of array $innarr , store it in $mycount
   //                                 Initialize $errCode to be "No Error"
   //           function getResult(): take in an index $n.
   //                                 Run a for loop with $i until $mycount .
   //                                     Calculate the products and store into $prod
   //                                     if $i index is not equal to the given index $n. Do multiplication
   //                                 After for loop, return the value in $prod

   //           function getArray() : take in no parameter.
   //                                 Run a for loop until $mycount.
   //                                     Call getResult($i) with each index in the array
   //                                     Store the returned value into array $outarr of the itemClass
   //                                 After for loop  , return the $outarr as the output
   //
   //           function checkNumeric():  take in no parameter.
   //                                     for each item in the $innarr 
   //                                        Check to see if it is a numeric return TRUE if they all numeric
   //                                        return FALSE and set $errCode if one of them is not a numeric  
   //   
   //           function getErrCode(): take in no parameter.
   //                                  return the $errCode of the Class
   //
   //                                  
   // Tests:
   //----------
   //      Test case 1 : (1.1) create a test array , and gives each item an integer value.
   //                    (1.2) get a new object for itemClass store it in $myobject. 
   //                    (1.3) call getResult(n), and give it an index n , such that n is a number between [0-(count of test array-1)]
   //                    (1.4) check the returned result.
   //      Test case 2 : 
   //                    (2.1) repeat (1.1) and (1.2)
   //                    (2.2) call getResult(n), and give it an index n ,such that n is a negative number.
   //                    (2.3) call getResult(n), and give it an index n ,such that n is greater than the count of the test array
   //                    (2.4) check the returned result.
   //      Test case 3 : 
   //                    (3.1) repeat (1.1) and (1.2)
   //                    (3.2) call getArray().
   //                    (3.3) check the returned result.
   //                    (3.4) you can do var_dump of the returned result.
   //      Test case 4 : 
   //                    (4.1) create a test array , and give a value 'a' to an item in array.
   //                    (4.2) get a new object for itemClass store it in $myobject. 
   //                    (4.3) call getArray().
   //                    (4.4) return value should be FALSE, because there is 'a' in the array.
   //                    (4.5) if the return value is FALSE - call getErrCode() - and print out the Errcode
   //                    (4.6) check the returned result.
   //                    (4.7) you can do var_dump of the returned result.
   //    
   // Time complexity:
   //------------------
   //           O(n)    - because I use array , therefore this algorithm will take O(n).
   //
   ////////////////////////////////////////////////////////////////////////////////////////////////
	
   class itemClass {
     
     public $innarr = array();
     public $outarr = array();
          
     public $mycount = 0;

     // Error Codes
     public $errCode = "" ;
     public $ErrDataNotValid =     "100 : Data in Array is not a Numeric value";

     /////////////////////////////////////////////////////////////////////////////////////           
     function __construct(&$itarr) {
        $this->innarr = $itarr;
        $this->mycount = count($this->innarr); 
        $this->errCode = "No Error" ;
     }

     /////////////////////////////////////////////////////////////////////////////////////      
     function getResult($n)
     {
     	   $prod = 1;
     	   
         for ($i= 0 ; $i < $this->mycount ; $i++ )
         {
               if ($i != $n)
                  $prod = $prod * $this->innarr[$i];
                   
         }       
         return $prod;
     }
     
     /////////////////////////////////////////////////////////////////////////////////////      
     function getArray()
     {
     	
     	   if ($this->checkNumeric() == FALSE) 
     	   {

            return FALSE;
                 	   
     	   }
     	   
         for ($i= 0 ; $i < $this->mycount ; $i++ )  
         {
         	 $this->outarr[$i] = $this->getResult($i);
         } 
         
         return $this->outarr;   
     }
     
     /////////////////////////////////////////////////////////////////////////////////////     
     function checkNumeric()
     {
     	
        foreach ($this->innarr as $elem) {
            if (is_numeric($elem)) {
              continue;
            } else {
               $this->errCode = $this->ErrDataNotValid;
               return FALSE;
            }
        }
        
        return TRUE;
     	
     }
     
     /////////////////////////////////////////////////////////////////////////////////////
     function getErrCode()
     {
     	  return $this->errCode;
     }
     
   }

   $inArray = array();
   
   $inArray[0] = 1;
   $inArray[1] = 2;
   $inArray[2] = 3;
   $inArray[3] = 4;  
   $inArray[4] = 1;  
    
   echo "Test case 1 ", PHP_EOL;
   $myobject = new itemClass($inArray);
   $retvalue = $myobject->getResult(2);
   var_dump ($retvalue);
   if ($retvalue == FALSE) 
   {
   	echo $myobject->getErrCode(), PHP_EOL;
   }
   
   echo "Test case 2.1 ", PHP_EOL;
   $myobject2 = new itemClass($inArray);
   $retvalue = $myobject2->getResult(-1);
   var_dump ($retvalue);
   if ($retvalue == FALSE) 
   {
   	echo $myobject2->getErrCode(), PHP_EOL;
   }
   
   echo "Test case 2.2 ", PHP_EOL;
   $myobject22 = new itemClass($inArray);
   $retvalue = $myobject22->getResult(10);
   var_dump ($retvalue);
   if ($retvalue == FALSE) 
   {
   	echo $myobject22->getErrCode(), PHP_EOL;
   }
   
   echo "Test case 3 ", PHP_EOL;
   $myobject3 = new itemClass($inArray);
   $retvalue = $myobject3->getArray();
   var_dump ($retvalue);
   if ($retvalue == FALSE) 
   {
   	echo $myobject3->getErrCode(), PHP_EOL;
   }
   
   echo "Test case 4 ", PHP_EOL;
   $inArray[0] = 'a';
   $myobject3 = new itemClass($inArray);
   $retvalue = $myobject3->getArray();
   var_dump ($retvalue);
   if ($retvalue == FALSE) 
   {
   	echo $myobject3->getErrCode(), PHP_EOL;
   }
?>
