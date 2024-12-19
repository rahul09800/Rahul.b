import java.swing.*;
public class buttonex{
    public static void main(String args[]){
        JFrame f= new JFrame("Button example");
        JButton b =new JButton("click here");
        b.SetBounds(50,100,95,30);
        f.add(b);
        f.Set Size(100,300);
        f.Set Layout(null);
        f.Set Visible(true);
    }
}