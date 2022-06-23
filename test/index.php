<?php
function sortedSquares($nums) {
        $positivePoint = 0;
        $squears = array();
        $result = array();
        $n = count($nums);
		$flag=0;
        for($i=0;$i<$n;$i++)
        {
            if($nums[$i]>=0 && !$flag)
			{
				 $positivePoint = $i;
				 $flag=1;
			}
               
            
            $squears[$i] = ($nums[$i]*$nums[$i]);
        }
         print_r($squears);
	     echo $positivePoint;
        $resultIndex = 0;
        
        $i = $positivePoint-1;
        $j = $positivePoint;
        while($resultIndex<$n)
        {
			echo '<br>';
			echo $squears[$i].':'.$squears[$j];
            if($i<0)
            {
                $result[$resultIndex] = $squears[$j];
                $j++;
            }
            elseif($j>=$n-1)
            {
                $result[$resultIndex] = $squears[$i];
                $i--;
            }
            else
            {
                if($squears[$j]<=$squears[$i])
                {
                    $result[$resultIndex] = $squears[$j];
                    $j++;
                }
                else
                {
                    $result[$resultIndex] = $squears[$i];
                    $i--;
                }
            }
            $resultIndex++;
        }
        
        return $result;
        
    }

$arr = [-4,-1,0,3,10];
 print_r(sortedSquares($arr));
?>