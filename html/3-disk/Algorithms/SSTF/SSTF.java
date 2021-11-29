/**
 * SSTF Algorithm / File io
 *
 * @author (Matthew Morfea)
 * @version (3/31/21)
 */
import java.io.*;
import java.lang.*;
import java.util.*;
import java.io.File; 
import java.io.FileNotFoundException;  
import java.util.Scanner; 
class SSTF
{
    static int[] queue;
    static int head; 
    int index = 0;
    static int SSTFindex = Integer.MAX_VALUE;
    static int[] valuesCopy;
   public static void main(String[] args) 
   {
        //Reading the intput.txt file data
        int[] arr = new int[100];
        ArrayList <Integer> arrlist= new ArrayList<Integer>();
        int x = 0; 
         try {
          File myObj = new File("input.txt");
          Scanner Scan = new Scanner(myObj);
          
          while (Scan.hasNext()) 
          {
              //arr[i] = Scan.nextInt();
              arr[x] = Scan.nextInt();
              if(x >= 3)
              {
                  //System.out.println("Latest Number: " + arr[x]);
                  arrlist.add(arr[x]);
              }
              x++;
          }
          
          Scan.close();
         }catch(FileNotFoundException e){
          System.out.println("An error occurred.");
          e.printStackTrace();
        }
        
        queue = new int[arrlist.size()];
        for(int i = 0; i < arrlist.size(); i++)
        {
            queue[i] = arrlist.get(i);
            //System.out.println(arr2[i]); 
        }
        valuesCopy = queue;
        head = arr[2];
        //System.out.println(head); 
        
        //processing the input.txt data through algorithm
        
        int[] newQueue = SSTF(queue,head);
        /*System.out.println("------------------------");
        for(int i = 0; i < newQueue.length;i++)
        {
            System.out.println(newQueue[i]); 
        }*/
        //Now we need to wrtie data to file output.txt
        writeToFile(newQueue, head);
   }
   public static int[] SSTF(int[] queue, int head)
   {
        int[] newVals = new int[queue.length];
        int currentVal = head;
        int[] varDiff = new int[queue.length];
        int[] valuesCopy = queue;
        int minIndex;
        for(int i = 0; i < queue.length; i++)
        {
            varDiff = SSTFdiff(currentVal);
            //console.log("varDiff: " + varDiff);
            minIndex = findMin(varDiff);
            //System.out.println(minIndex); 
                newVals[i] = queue[minIndex];
            //console.log(valuesCopy);
            currentVal = valuesCopy[minIndex];
            valuesCopy[minIndex] = Integer.MAX_VALUE;
            //console.log("CurrentVal: " +currentVal);
        }
        queue = newVals;
        return queue; 
   }
    public static int[] SSTFdiff(int currentVal){
        int[] varDiff = new int[valuesCopy.length];
        for(int i = 0; i < valuesCopy.length; i++){
            varDiff[i] = Math.abs(valuesCopy[i] - currentVal);
        }
        return varDiff;
   }
   public static int findMin(int[] varDiff){
        int min = Integer.MAX_VALUE;
        int minIndex = Integer.MAX_VALUE;
        for(int i = 0; i < varDiff.length; i++)
        {
            if(varDiff[i] < min)
            {
                min = varDiff[i];
                minIndex = i;
            }
        }
        return minIndex;
   }
   public static void writeToFile(int[] q, int h)
   {
     try {
        FileWriter myWriter = new FileWriter("output.txt");
        myWriter.write("0 699" + "\n");
        myWriter.write(h + "\n");
        for(int i = 0; i < q.length;i++)
        {
            myWriter.write(q[i] + " ");
        }
        myWriter.close();
        //System.out.println("Successfully wrote to the file.");
     } catch (IOException e) {
        System.out.println("An error occurred.");
        e.printStackTrace();
     }
   }
}