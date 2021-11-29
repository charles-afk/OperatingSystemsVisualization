
/**
 * FCFS Algorithm / File io
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
class FCFS
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
        
        //FCFS is exactly what is read as an input.
        
        //Now we need to wrtie data to file output.txt
        writeToFile(queue, head);
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
