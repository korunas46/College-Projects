/** SingularlyLinkedList.java
  * @author S Jamshidi, J Koruna
  * @description Singularly linked lists
  * @version 1.1, 2023-05-04
*/


public class SingularlyLinkedList<T>{

  //attributes
  protected Node<T> startNode;
  protected int size = 0;

  //methods
  /** Constructor */
  public SingularlyLinkedList(){
    startNode = null;
  }

  public T first(){
    return startNode.getEntry();
  }

  public int getSize(){
    return size;
  }
  public Node<T> returnStart(){
    return startNode;
  }

  public void addFirst(T entry){
    if (size == 0){
      // create node and add node
      startNode = new Node<T>(entry);
      // increase size
      size++;
    }else{
      // create node
      Node<T> newNode = new Node<T>(entry);
      // connect newNode to startNode
      newNode.setNextNode(startNode);
      // make newNode startNode
      startNode = newNode;
      // increase size
      size++;
    }
  }

  /** Removes first entry */
  public T removeFirst(){
    if (size >= 1){
      // store second Node
      Node<T> secondNode = startNode.getNextNode();
      T deletedEntry = startNode.getEntry();
      // deletes original first node
      startNode = secondNode;
      size--;
      return deletedEntry;
    }
    return null;
  }

  /** prints the singularly linked list */
  public void printSLL(){
    Node<T> nodeAt = startNode;
    System.out.println(nodeAt.getEntry());
    for (int i=1; i<size; i++){
      nodeAt=nodeAt.getNextNode();
      System.out.println(nodeAt.getEntry());
    }
  }

  public static void main(String[] args) {
    SingularlyLinkedList<Integer> test = new SingularlyLinkedList<Integer>();
    test.addFirst(4);
    test.addFirst(3);
    test.addFirst(7);
    test.addFirst(5);
    test.addFirst(4);
    test.removeFirst();
    test.printSLL();
  }

}
