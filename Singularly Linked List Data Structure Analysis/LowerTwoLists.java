/** LowerTwoLists.java
  * @author J Koruna
  * @description Finds lower number of two lists and appends it
  * @version 1.0, 2023-05-03
*/

public class LowerTwoLists{

  //attributes
  private int lowerNumber;
  private Integer lowerNumberL;

  //methods
  /**Constructor*/
  public LowerTwoLists(){}

  /** Takes the lowest int from both arrays and adds it to the second array*/
  public boolean LowerTwoArray(int[] array1, int[] array2){
    lowerNumber = array1[0];
    //Finds the lowest number in first array
    for(int i = 1; i < array1.length; i++){
      if(lowerNumber > array1[i]){
        lowerNumber = array1[i];
      }
    }
    System.out.println(lowerNumber);
    //Compares lowest number to second array
    for(int j = 0; j < array2.length; j++){
      //If not lowest in second array, return false
      if(lowerNumber >= array2[j]) {
        return false;
      }
    }
    //Shift array
    for(int k = array2.length-1; k > 0; k--){
      array2[k] = array2[k-1];
    }
    //Sets first value of second array
    array2[0] = lowerNumber;
    for(int y = 0; y < array2.length; y++){
      System.out.println(array2[y]);
    }
    return true;
  }

  /**Takes the lowest Integer from both lists and adds it to the second list*/
  public boolean LowerTwoLinked(SingularlyLinkedList<Integer> linked1, SingularlyLinkedList<Integer> linked2) {
    //Checks size of both lists, returns false if 0
    if(linked1.getSize() == 0 || linked2.getSize() == 0) {
      return false;
    }
    lowerNumberL = linked1.first();
    Node<Integer> currentNode = linked1.returnStart();
    //Finds lowest number in first list
    for(int i = 0; i < linked1.getSize(); i++){
      if(lowerNumberL > currentNode.getEntry()){
        lowerNumberL = currentNode.getEntry();
      }
      currentNode = currentNode.getNextNode();
    }
    System.out.println(lowerNumberL);
    currentNode = linked2.returnStart();
    //Compares lowest number to second list
    for(int j = 0; j < linked2.getSize(); j++){
      //IF higher than second list, return false
      if(lowerNumberL >= currentNode.getEntry()) {
        return false;
      }
      currentNode = currentNode.getNextNode();
    }
    //Appends lowest value to beginning of second list
    linked2.addFirst(lowerNumberL);
    currentNode = linked2.returnStart();
    for(int y = 0; y < linked2.getSize(); y++){
      System.out.println(currentNode.getEntry());
      currentNode = currentNode.getNextNode();
    }
    return true;
  }

  public static void main(String[] args) {
    //Array tests
    LowerTwoLists test = new LowerTwoLists();
    System.out.println("Array Tests");
    int[] testArr1 = new int[]{6, 7, 8, 9, 10};
    int[] testArr2 = new int[]{1, 2, 3, 4, 5};
    System.out.println(test.LowerTwoArray(testArr1, testArr2));
    System.out.println(test.LowerTwoArray(testArr2, testArr1));
    System.out.println("--");
    int[] testArr3 = new int[]{3, 6, 10, 88, 77, 2};
    int[] testArr4 = new int[]{96, 780, 1};
    System.out.println(test.LowerTwoArray(testArr3, testArr4));
    System.out.println(test.LowerTwoArray(testArr4, testArr3));
    System.out.println("--");
    int[] testArr5 = new int[5];
    int[] testArr6 = new int[8];
    System.out.println(test.LowerTwoArray(testArr5, testArr6));
    System.out.println(test.LowerTwoArray(testArr6, testArr5));
    System.out.println("--");
    int[] testArr7 = new int[]{3, 6, -10, -88, 77, 2};
    int[] testArr8 = new int[]{-96, 780, 1};
    System.out.println(test.LowerTwoArray(testArr7, testArr8));
    System.out.println(test.LowerTwoArray(testArr8, testArr7));
    System.out.println("--");
    //Linked List Tests
    System.out.println("Linked List Tests");
    SingularlyLinkedList<Integer> testList1 = new SingularlyLinkedList<Integer>();
    testList1.addFirst(10);
    testList1.addFirst(9);
    testList1.addFirst(8);
    testList1.addFirst(7);
    testList1.addFirst(6);
    SingularlyLinkedList<Integer> testList2 = new SingularlyLinkedList<Integer>();
    testList2.addFirst(5);
    testList2.addFirst(4);
    testList2.addFirst(3);
    testList2.addFirst(2);
    testList2.addFirst(1);
    System.out.println(test.LowerTwoLinked(testList1, testList2));
    System.out.println(test.LowerTwoLinked(testList2, testList1));
    System.out.println("--");
    SingularlyLinkedList<Integer> testList3 = new SingularlyLinkedList<Integer>();
    testList3.addFirst(2);
    testList3.addFirst(77);
    testList3.addFirst(88);
    testList3.addFirst(10);
    testList3.addFirst(6);
    testList3.addFirst(3);
    SingularlyLinkedList<Integer> testList4 = new SingularlyLinkedList<Integer>();
    testList4.addFirst(1);
    testList4.addFirst(780);
    testList4.addFirst(96);
    System.out.println(test.LowerTwoLinked(testList3, testList4));
    System.out.println(test.LowerTwoLinked(testList4, testList3));
    System.out.println("--");
    SingularlyLinkedList<Integer> testList5 = new SingularlyLinkedList<Integer>();
    SingularlyLinkedList<Integer> testList6 = new SingularlyLinkedList<Integer>();
    System.out.println(test.LowerTwoLinked(testList5, testList6));
    System.out.println(test.LowerTwoLinked(testList6, testList5));
    System.out.println("--");
    SingularlyLinkedList<Integer> testList7 = new SingularlyLinkedList<Integer>();
    testList7.addFirst(2);
    testList7.addFirst(77);
    testList7.addFirst(-88);
    testList7.addFirst(-10);
    testList7.addFirst(6);
    testList7.addFirst(3);
    SingularlyLinkedList<Integer> testList8 = new SingularlyLinkedList<Integer>();
    testList8.addFirst(1);
    testList8.addFirst(780);
    testList8.addFirst(-96);
    System.out.println(test.LowerTwoLinked(testList7, testList8));
    System.out.println(test.LowerTwoLinked(testList8, testList7));
    System.out.println("--");
  }

}
