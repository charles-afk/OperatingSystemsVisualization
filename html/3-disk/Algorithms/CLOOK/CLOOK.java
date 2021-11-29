/**
 * CLOOK Algorithm / File io
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
class CLOOK
{
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
        
        int[] queue = new int[arrlist.size()];
        for(int i = 0; i < arrlist.size(); i++)
        {
            queue[i] = arrlist.get(i);
            //System.out.println(arr2[i]); 
        }
        int head = arr[2];
        //System.out.println(head); 
        
        //processing the input.txt data through algorithm
        
        int[] newQueue = CSCAN(queue,head);
        
        //Now we need to wrtie data to file output.txt
        writeToFile(newQueue, head);
   }
   public static int[] CSCAN(int[] queue, int head)
    {
        int distance;
        int temp;
 
        ArrayList<Integer> arr1 = new ArrayList<Integer>();
        ArrayList<Integer> arr2 = new ArrayList<Integer>();
        ArrayList<Integer> seek = new ArrayList<Integer>();
 
        //Spliting arrays between starting head
        for (int i = 0; i < queue.length; i++) 
        {
            if (queue[i] < head)
            {
                arr1.add(queue[i]);
            }
            if (queue[i] > head)
            {
                arr2.add(queue[i]);
            }
        }
 
        Collections.sort(arr1);
        Collections.sort(arr2);
 
        //moving from head to higest value in arr2
        for (int i = 0; i < arr2.size(); i++) 
        {
            temp = arr2.get(i);
            seek.add(temp);
            head = temp;
        }
        
        //moving from lowest value in arr1 to head
        head = arr1.get(0);
        for (int i = 0; i < arr1.size(); i++)
        {
            temp = arr1.get(i);
            seek.add(temp);
            head = temp;
        }
        
        //Set new queue to seek, which is now sorted
        int[] nq = new int[seek.size()];
        for (int i = 0; i < seek.size(); i++) 
        {
            //System.out.println(seek.get(i));
            nq[i] = seek.get(i);
        }
        return nq;
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
        System.out.println("Success!");
        myWriter.close();
        //System.out.println("Successfully wrote to the file.");
     } catch (IOException e) {
        System.out.println("An error occurred.");
        e.printStackTrace();
     }
   }
}
