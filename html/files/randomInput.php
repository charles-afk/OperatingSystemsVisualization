<?php

    if($_POST['AlgoID'] == 1) {
        // CPU Schedule Input
        $processLength = rand(2,7);
        $procID = 1;
        $myfile = fopen("../1-cpu/input.txt", "w") or die("Unable to open file!");
    
        for($i = 0; $i < $processLength; $i++){
            $arriv = rand(0, 5);
            $burst = rand(1,10);
            $prio = rand(1, $processLength);
    
            fwrite($myfile, $procID);
            fwrite($myfile, ",");
            fwrite($myfile, $arriv);
            fwrite($myfile, ",");
            fwrite($myfile, $burst);
            fwrite($myfile, ",");
            fwrite($myfile, $prio);
            if($procID != $processLength)
                fwrite($myfile, "\n");
    
            $procID++;
        }

        fclose($myfile);

        $processLength = rand(2,7);
        $procID = 1;
        $myfile2 = fopen("../1-cpu/FCFS/output.txt", "w") or die("Unable to open file!");

        for($i = 0; $i < $processLength; $i++){
            fwrite($myfile2, $procID);
            $procID++;
            if($i == 0) {
                $burst = rand(3,11);
                fwrite($myfile2, ",");
                fwrite($myfile2, 0);
                fwrite($myfile2, ",");
                fwrite($myfile2, $burst);
                fwrite($myfile2, "\n");
            } else {
                fwrite($myfile2, ",");
                fwrite($myfile2, $burst);
                fwrite($myfile2, ",");
                $burst = $burst + rand(3,11);
                fwrite($myfile2, $burst);
                if($i != $processLength - 1)
                    fwrite($myfile2, "\n");
            }
        }


        fclose($myfile2);

        header("Location: ../1-cpu/index.html");

    } else if($_POST['AlgoID'] == 3) {
        // Disk Schedule Input
        $diskStops = rand(5,10);
        $head = rand(0,699);
        $myfile = fopen("../3-disk/Algorithms/FCFS/input.txt", "w") or die("Unable to open file!");
        fwrite($myfile, "0 699");
        fwrite($myfile, "\n");
        fwrite($myfile, $head);
        fwrite($myfile, "\n");
        $stopHere = 1;
        for($i = 0; $i < $diskStops; $i++){
            $stop = rand(0,699);
            fwrite($myfile, $stop);
            if($stopHere != $diskStops)
                fwrite($myfile, " ");
            $stopHere++;
        }

        fclose($myfile);

        $diskStops = rand(5,10);
        $head = rand(0,699);
        $myfile2 = fopen("../3-disk/Algorithms/FCFS/output.txt", "w") or die("Unable to open file!");
        fwrite($myfile2, "0 699");
        fwrite($myfile2, "\n");
        fwrite($myfile2, $head);
        fwrite($myfile2, "\n");
        $stopHere = 1;
        for($i = 0; $i < $diskStops; $i++){
            $stop = rand(0,699);
            fwrite($myfile2, $stop);
            if($stopHere != $diskStops)
                fwrite($myfile2, " ");
            $stopHere++;
        }

        fclose($myfile2);

        header("Location: ../3-disk/index.html");

    } else if($_POST['AlgoID'] == 2) {
        // Page Replacement Input
        $frames = rand(3,6);
        $pageAmount = rand(16, 25);
        $myfile = fopen("../2-replace/input.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $frames);
        fwrite($myfile, ":");
        $stopHere = 1;
        for($i = 0; $i < $pageAmount; $i++){
            $pageNumber = rand(1,7);
            fwrite($myfile, $pageNumber);
            if($stopHere == $pageAmount)
                break;
            else
                fwrite($myfile, ",");
            $stopHere++;
        }
        fclose($myfile);

        $frames = rand(3,6);
        $pageAmount = rand(16, 25);
        $pageNumber = [];

        for($i = 0; $i < $pageAmount; $i++){
            //$pageNumber = rand(1,7);
            array_push($pageNumber, rand(1,7));
        }


        $myfile2 = fopen("../2-replace/FIFO/output.txt", "w") or die("Unable to open file!");

        if($frames == 3) {
            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 1);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 2);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ":");
            fwrite($myfile2, 3);
            fwrite($myfile2, "\n");

            $pageArray = [];
            array_push($pageArray, $pageNumber[0]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[1]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[2]);
            array_push($pageArray, ":");
            array_push($pageArray, 3);
        }


        if($frames == 4) {
            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 1);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 2);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 3);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[3]);
            fwrite($myfile2, ":");
            fwrite($myfile2, 4);
            fwrite($myfile2, "\n");

            $pageArray = [];
            array_push($pageArray, $pageNumber[0]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[1]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[2]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[3]);
            array_push($pageArray, ":");
            array_push($pageArray, 4);
        }

        if($frames == 5) {
            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 1);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 2);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 3);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[3]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 4);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[3]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[4]);
            fwrite($myfile2, ":");
            fwrite($myfile2, 5);
            fwrite($myfile2, "\n");

            $pageArray = [];
            array_push($pageArray, $pageNumber[0]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[1]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[2]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[3]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[4]);
            array_push($pageArray, ":");
            array_push($pageArray, 5);
        }

        if($frames == 6) {
            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 1);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 2);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 3);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[3]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 4);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[3]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[4]);
            fwrite($myfile2, ",");
            fwrite($myfile2, "-");
            fwrite($myfile2, ":");
            fwrite($myfile2, 5);
            fwrite($myfile2, "\n");

            fwrite($myfile2, $pageNumber[0]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[1]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[2]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[3]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[4]);
            fwrite($myfile2, ",");
            fwrite($myfile2, $pageNumber[5]);
            fwrite($myfile2, ":");
            fwrite($myfile2, 6);
            fwrite($myfile2, "\n");

            $pageArray = [];
            array_push($pageArray, $pageNumber[0]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[1]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[2]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[3]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[4]);
            array_push($pageArray, ",");
            array_push($pageArray, $pageNumber[5]);
            array_push($pageArray, ":");
            array_push($pageArray, 6);
        }





        for($i = 6; $i < $pageAmount; $i++){
            $changeFrame = rand(1,$frames);
            
            $max = $frames;
            $evenRandomNb = rand(0, round(($max / 2), 0, PHP_ROUND_HALF_DOWN)) * 2;

            $pageArray[$evenRandomNb] = rand(1,7);
            
            $fault = count($pageArray) - 1;
            $faultNum = $pageArray[$fault] + 1;
            $pageArray[count($pageArray) - 1] =  $faultNum;

            for($j = 0; $j < count($pageArray); $j++) {
                
                fwrite($myfile2, $pageArray[$j]);
                

            }
            if($i != $pageAmount - 1)
                fwrite($myfile2, "\n");
        }

        fclose($myfile2);

        
        header("Location: ../2-replace/index.html");

    } else if($_POST['AlgoID'] == 4) {
        // Memory/File Allocation Input
        $slots = rand(3,6);
        $myfile = fopen("../4-memory/input.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $slots);
        fwrite($myfile, "\n");

        $slot1start = rand(80, 110);
        $slot1end = rand(380, 420);

        $slot2start = rand(580, 620);
        $slot2end = rand(780, 820);

        $slot3start = rand(1450, 1550);
        $slot3end = rand(1880, 1920);

        $slot4start = rand(2100, 2120);
        $slot4end = rand(2580, 2620);

        $slot5start = rand(3050, 3150);
        $slot5end = rand(3480, 3620);

        $slot6start = rand(3850, 3900);
        $slot6end = rand(4080, 4120);

        fwrite($myfile, $slot1start);
        fwrite($myfile, " ");
        fwrite($myfile, $slot1end);
        fwrite($myfile, "\n");
        
        fwrite($myfile, $slot2start);
        fwrite($myfile, " ");
        fwrite($myfile, $slot2end);
        fwrite($myfile, "\n");

        fwrite($myfile, $slot3start);
        fwrite($myfile, " ");
        fwrite($myfile, $slot3end);
        fwrite($myfile, "\n");

        $slotID = $slots - 3;
        for($i = 0; $i < $slotID; $i++){
            if($slotID != 0) {
                if ($i == 0){
                    fwrite($myfile, $slot4start);
                    fwrite($myfile, " ");
                    fwrite($myfile, $slot4end);
                    fwrite($myfile, "\n");
                }
                if ($i == 1){
                    fwrite($myfile, $slot5start);
                    fwrite($myfile, " ");
                    fwrite($myfile, $slot5end);
                    fwrite($myfile, "\n");
                }
                if ($i == 2){
                    fwrite($myfile, $slot6start);
                    fwrite($myfile, " ");
                    fwrite($myfile, $slot6end);
                    fwrite($myfile, "\n");
                }
            }
        }

        $proc = rand(3, $slots);
        fwrite($myfile, $proc);
        fwrite($myfile, "\n");

        $proc1 = rand(180,200);
        $proc2 = rand(210,220);
        $proc3 = rand(300,400);
        $proc4 = rand(50,100);
        $proc5 = rand(300,350);
        $proc6 = rand(230,270);
        $pid = 1;
        
        fwrite($myfile, $pid);
        fwrite($myfile, " ");
        fwrite($myfile, $proc1);
        fwrite($myfile, "\n");
        $pid++;

        fwrite($myfile, $pid);
        fwrite($myfile, " ");
        fwrite($myfile, $proc2);
        fwrite($myfile, "\n");
        $pid++;

        fwrite($myfile, $pid);
        fwrite($myfile, " ");
        fwrite($myfile, $proc3);
        $pid++;

        $procI = $proc - 3;
        for($i = 0; $i < $procI; $i++){
            if($procI != 0) {
                if ($i == 0){
                    fwrite($myfile, "\n");
                    fwrite($myfile, $pid);
                    fwrite($myfile, " ");
                    fwrite($myfile, $proc4);
                    $pid++;
                }
                if ($i == 1){
                    fwrite($myfile, "\n");
                    fwrite($myfile, $pid);
                    fwrite($myfile, " ");
                    fwrite($myfile, $proc5);
                    $pid++;
                }
                if ($i == 2){
                    fwrite($myfile, "\n");
                    fwrite($myfile, $pid);
                    fwrite($myfile, " ");
                    fwrite($myfile, $proc6);
                    $pid++;
                }
            }
        }

        fclose($myfile);



        $processes = rand(3,6);


        $pArr = [];
        array_push($pArr,1);
        array_push($pArr,2);
        array_push($pArr,3);
        $id = 4;
        $moreProc = $processes - 3;
        for($i = 0; $i < $moreProc; $i++){
            array_push($pArr,$id);
            $id++;
        }

        $myfile2 = fopen("../4-memory/output.txt", "w") or die("Unable to open file!");

        fwrite($myfile2, rand(80,110));
        fwrite($myfile2, " ");
        fwrite($myfile2, rand(180,210));
        fwrite($myfile2, " ");
        $idChoice = rand(0, count($pArr) - 1);
        fwrite($myfile2, $pArr[$idChoice]);
        unset($pArr[$idChoice]);
        fwrite($myfile2, "\n");

        fwrite($myfile2, rand(590,610));
        fwrite($myfile2, " ");
        fwrite($myfile2, rand(780,810));
        fwrite($myfile2, " ");
        $idChoice = rand(0, count($pArr) - 1);
        fwrite($myfile2, $pArr[$idChoice]);
        unset($pArr[$idChoice]);
        fwrite($myfile2, "\n");

        fwrite($myfile2, rand(1490,1510));
        fwrite($myfile2, " ");
        fwrite($myfile2, rand(1780,1810));
        fwrite($myfile2, " ");
        $idChoice = rand(0, count($pArr) - 1);
        fwrite($myfile2, $pArr[$idChoice]);
        unset($pArr[$idChoice]);

        fclose($myfile2);









        $fileSlots = rand(25, 35);
        $newfile = fopen("finput.txt", "w") or die("Unable to open file!");
        fwrite($newfile, $fileSlots);
        fwrite($newfile, "\n");

        $fileNum = rand(2,7);
        
        $fileID = [];
        $id = 1;
        for ($i = 0; $i < $fileNum; $i++){
            array_push($fileID, $id);
            $id++;
        }

        for($i = 0; $i < $fileSlots; $i++) {

            fwrite($newfile, "0");
            if($i < $fileSlots - 1) {
                fwrite($newfile, ",");
            }

        }

        $fileNames = ["grades","class","proj", "tr", "lp", "os", "el"];

        fwrite($newfile, "\n");
        fwrite($newfile, $fileNum);
        
        $id = 1;
        for($i = 0; $i < $fileNum; $i++){
            fwrite($newfile, "\n");
            fwrite($newfile, $id);
            fwrite($newfile, ",");
            fwrite($newfile, $fileNames[$i]);
            fwrite($newfile, ",");
            $size = rand(3,6);
            fwrite($newfile, $size);
            $id++;
        }

        fclose($newfile);


        $newfile2 = fopen("foutput.txt", "w") or die("Unable to open file!");
        $fileSlots = rand(25, 35);
        fwrite($newfile2, $fileSlots);
        fwrite($newfile2, "\n");

        $fileNum = rand(2,7);
        
        $fileID = [];
        $id = 1;
        for ($i = 0; $i < $fileNum; $i++){
            array_push($fileID, $id);
            $id++;
        }

        /*for($i = 0; $i < $fileSlots; $i++) {
            
            if($i < $fileSlots - 5 && $i > 5){
                $filledBool = rand(0,1);
                if ($filledBool == false) {
                    $j = rand(0, count($fileID) - 1);
                    fwrite($newfile2, $fileID[$j]);
                    fwrite($newfile2, ",");
                    unset($fileID[$j]);
                }
                else {
                    fwrite($newfile2, "0");
                }
            }

            fwrite($newfile2, "0");
            if($i < $fileSlots - 1) {
                fwrite($newfile2, ",");
            }

        }*/

        


        $fileNames = ["grades","class","proj", "tr", "lp", "os", "el"];

        fwrite($newfile2, "\n");
        fwrite($newfile2, $fileNum);
        
        $id = 1;
        for($i = 0; $i < $fileNum; $i++){
            fwrite($newfile2, "\n");
            fwrite($newfile2, $id);
            fwrite($newfile2, ",");
            fwrite($newfile2, $fileNames[$i]);
            fwrite($newfile2, ",");
            $size = rand(3,6);
            fwrite($newfile2, $size);
            $id++;
        }

        fclose($newfile2);
        
        header("Location: ../4-memory/index.html");
    }

?>