/** Node.java
  * @author S Jamshidi
  * @description Node objects for linked lists
  * @version 1.0, 2023-03-20
*/

public class Node<T>{
  // attributes
  private T value;
  private Node<T> nextNode;

  //methods
  /** Constructor */
  public Node(T entry){
    value = entry;
    nextNode = null;
  }

  /** set the next node */
  public void setNextNode(Node<T> nextNode){
    this.nextNode = nextNode;
  }

  /** get the next node */
  public Node<T> getNextNode(){
    return nextNode;
  }

  /** set the entry */
  public void setEntry(T newEntry){
    value = newEntry;
  }

  /** get the entry */
  public T getEntry(){
    return value;
  }

  /** for testing purposes */
  public static void main(String[] args) {
    Node<Integer> test = new Node<Integer>(5);
    // I cannot pass a primitive type
    System.out.println(test.getEntry()); //5
    System.out.println(test.getNextNode()); //null
    // test.setEntry(7);
    // // ^ How do I pass this as an Integer and not an int
    // System.out.println(test.getEntry()); //7

    Node<Integer> test2 = new Node<Integer>(8);
    test.setNextNode(test2);
    System.out.println(test.getNextNode().getEntry());
    // System.out.println(test);
    // System.out.println(test2);

  }

}
