<?php
   ////////////////////////////////////////////////////////////////////////////////////////////////
   // Author : Tracy Ta - Email : tracy.ta@gmail.com
   // Class definitions:
   //--------------------
   //     class pairClass will return False or True, when a given integer is the sum of 2 elements in a given array
   //                     if it is the sum , return True, if not return False.
   //     class pairClass has :
   //            contructor function  : it takes in 2 parameters : an integer $n for the sum number that we want to check
   //                                                               an array $innarr with integer values
   //            checkPairSum function: it takes in 3 parameters: (1) firstnum  - the first operand
   //                                                             (2) secondnum - the second operand
   //                                                             (3) sumcheck  - value to check if ( first + second) is equal to
   //            checkAll function    : it takes in no parameter.
   //                                   it will call checkPairSum() in (2) loops, to verify if the given integer $n , is equal
   //                                   to the sum of any 2 values in the given $innarr  array
   //    
   //            checkNumeric function: it takes in no parameter.
   //                                   it checks each value in $innarr Array for a numeric
   //                                   if also checks the given $n value to be numeric.  
   //                                                                  
   //            getErrCode  function:  it takes in no parameter.
   //                                   it returns the errCode of the class pairClass.     
   //
   // Documentation
   //---------------
   //       The class pairClass can be tested using the command "php PairAddClass.php"
   //       The result(TRUE or FALSE) will be returned when you called checkAll() function of this class.
   //       This class checks to see whether the given $n integer, is a sum of any 2 values in the given array.
   //       We save some computation time, by increasing the index once it has gone thru one loop/round.
   //       Because the checking of the sum of $innarr[1] + $innarr[3], is the same as checking of $innarr[3] + $innarr[1]
   //       So if we had gone thru checking $innarr[1] + $innarr[3], we don't need to check the [3]+[1] 
   //
   //       Details:
   //       -------
   //       constructor function: take in $n integer and an array as parameters.
   //                                 assign $n to $mynumcheck  
   //                                 assign the input array to $innarr
   //                                 get the count of array $innarr , store it in $mycount
   //                                 Initialize the errCode to be "No Error" ;
   //
   //       function checkPairSum(): Takes in 3 parameters: firstnum, secondnum, and sumcheck
   //                                  Check 
   //                                      if (firstnum + secondnum ) is equal to sumcheck, then return TRUE
   //                                      otherwise return FALSE
   //       function checkAll()   : Take in no parameter
   //                                  go thru 2 for-loops :
   //                                     First Loop going from 0 to mycount
   //                                     Second Loop going from myindex to mycount ( where myindex is increase by one each round)
   //                                          Call checkPairSum and give it , firstnum, secondnum, and mynumcheck 
   //                                               if anytime checkPairSum returns TRUE - we return TRUE 
   //                                               Meaning we had found the Pair with the sum equals to the given $n
   //                                     After 2 Loops, returns FALSE
   //                                     Meaning we had gone thru all pair combinations and we had found no pair with the sum
   //                                     equals to the given $n value
   //
   //       function checkNumeric(): Take in no parameter
   //                                Check for numeric value for all values in $innarr Array and the $mynumcheck ($n) .
   //                                   if one of the value in the given $innarr Array is not numeric 
   //                                      set errCode to be $ErrDataNotValid , return FALSE
   //                                   if the value of the given input $mynumcheck ($n) is not numeric 
   //                                      set errCode to be $ErrDataOneNotValid , return FALSE
   //                                   otherwise , return TRUE
   //       function getErrCode():   Take in no parameter.
   //                                It returns the errCode of the class.
   //                                   
   // Tests:
   //----------
   //      Test case 1 : (1.1) create a test array , and give each item an integer value.
   //                    (1.2) create an object by new up the pairClass .
   //                          pass in integer n=8 value and the test inArray [1,2,3,4] as input parameters 
   //                    (1.3) call checkAll(), the return value should be False . Because no pair sum in [1,2,3,4] is equal to 8 
   //                    (1.4) check the returned result.
   //
   //      Test case 2:  (2.1) create a test array , and give each item an integer value.
   //                    (2.2) create an object by new up the pairClass .
   //                          pass in integer n=7 value and the test inArray [1,2,3,4] as input parameters 
   //                    (2.3) call checkAll(), the return value should be True . Because pair of 3+4 is equal to 7 . 
   //                    (2.4) check the returned result.
   //                    (2.5) Now repeat this test with n=4 , should be True . Because pair of 1+3 is equal to 4.
   //
   //      Test case 3:  (3.1) create a test array , and give each item an integer value.
   //                    (3.2) create an object by new up the pairClass .
   //                          pass in  n='a' value and the test inArray [1,2,3,4] as input parameters 
   //                    (3.3) call checkAll(), the return value should be False . Because no pair sum in [1,2,3,4] is equal to 'a'. 
   //                    (3.4) check the returned result.
   //
   //      Test case 4:  (3.1) create a test array , and give one item a letter 'a' value.
   //                    (3.2) create an object by new up the pairClass .
   //                          pass in  n=7 value and the test inArray ['a',2,3,4] as input parameters 
   //                    (3.3) call checkAll(), the return value should be False . 
   //                                           Because the checkNumeric() fail : 'a' is not a Numeric. 
   //                    (3.4) check the returned result.
   // Time complexity:
   //------------------
   //           O(n)    - because I use array , therefore this algorithm will take O(n).
   //                    
   ////////////////////////////////////////////////////////////////////////////////////////////////
	
   class pairClass {
     
     public $innarr = array();
     public $mynumcheck = 0;     
     public $mycount = 0;
     
     // Error Codes
     public $errCode = "" ;
     public $ErrDataNotValid =     "100 : Data in Array is not a Numeric value";
     public $ErrDataOneNotValid =  "200 : Input data is not a Numeric value";
     public $ErrNoPairValid     =  "300 : No Pair sum in Array found to be equal to given Value ";

     /////////////////////////////////////////////////////////////////////////////////////          
     function __construct( $n ,&$itarr) {
        $this->mynumcheck = $n; 
        $this->innarr = $itarr;
        $this->mycount = count($this->innarr); 
        $this->errCode = "No Error" ;
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
        
        if (!is_numeric($this->mynumcheck))
        {
         	$this->errCode = $this->ErrDataOneNotValid; 
         	return FALSE;     	
        }
        
        return TRUE;
     	
     }
     
     /////////////////////////////////////////////////////////////////////////////////////     
     function checkPairSum($firstnum, $secondnum, $sumcheck)
     {
         
         if (($firstnum + $secondnum) == $sumcheck)
             return TRUE;
         else 
             return FALSE;
                   
     }
 
     /////////////////////////////////////////////////////////////////////////////////////
     function getErrCode()
     {
     	  return $this->errCode;
     }
     
     ////////////////////////////////////////////////////////////////////////////////////	    
     function checkAll()
     {
     	
     	   
     	   if ($this->checkNumeric() == FALSE) 
     	   {

            return FALSE;
                 	   
     	   }

     	   $myindex = 0;
         for ($i= 0 ; $i < $this->mycount ; $i++ )  
         {

         	for ($j=$myindex; $j < $this->mycount ; $j++)
         	{

                if (  $j != $myindex  ) { 

                  	if ($this->checkPairSum( $this->innarr[$myindex] , $this->innarr[$j] , $this->mynumcheck ) == TRUE )
                  	    return TRUE;
                }
                         	
         	}
         	$myindex = $myindex+1;

         } 
         
         $this->errCode =  $this->ErrNoPairValid    ;
         return FALSE;   
     }
   }

   $inArray = array();
   
   $inArray[0] = 1;
   $inArray[1] = 2;
   $inArray[2] = 3;
   $inArray[3] = 4;  
 
    
   echo "Test case 1 ", PHP_EOL;
   $myobject = new pairClass(8, $inArray);
   
   if  ($myobject->checkAll() == TRUE)
   {
       echo "True", PHP_EOL;
   } else { 
       echo "False", PHP_EOL;
       echo $myobject->getErrCode(), PHP_EOL;
   }
 
   echo "Test case 2 ", PHP_EOL;
   $myobject2 = new pairClass(7, $inArray);
   
   if  ($myobject2->checkAll() == TRUE)
   {
       echo "True", PHP_EOL;
   } else { 
       echo "False", PHP_EOL;
       echo $myobject2->getErrCode(), PHP_EOL;
   }

   echo "Test case 3 ", PHP_EOL;

   $myobject3 = new pairClass('a', $inArray);
   
   if  ($myobject3->checkAll() == TRUE)
   {
       echo "True", PHP_EOL;
   } else { 
       echo "False", PHP_EOL;
       echo $myobject3->getErrCode(), PHP_EOL;
   } 
    
   echo "Test case 4 ", PHP_EOL;
   $inArray[0] = 'a';
   $myobject4 = new pairClass(7, $inArray);
   
   if  ($myobject4->checkAll() == TRUE)
   {
       echo "True", PHP_EOL;
   } else { 
       echo "False", PHP_EOL;
       echo $myobject4->getErrCode(), PHP_EOL;
   }          
?>
