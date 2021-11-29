<?php

    if($_POST['AlgoID'] == 1) {
        // CPU Schedule Output
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

        header("Location: ../1-cpu/index.html");

    } else if($_POST['AlgoID'] == 3) {
        // Disk Scheduling Output
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

        header("Location: ../3-disk/index.html");

    } else if($_POST['AlgoID'] == 2) {
        // Page Replacement Output
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



        header("Location: ../2-replace/index.html");

    } else if($_POST['AlgoID'] == 4) {

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


        header("Location: ../4-memory/index.html");
    }

?>