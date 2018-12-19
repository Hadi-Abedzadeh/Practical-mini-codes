```csharp

using System;
using System.Drawing;
using System.Windows.Forms;

namespace WindowsFormsApplication9 {
    public partial class Form1 : Form {
        public Form1(){
            this.TransparencyKey = Color.Turquoise;
            this.BackColor = Color.Turquoise;
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e){
           foreach (var screen in System.Windows.Forms.Screen.AllScreens){
                if (screen.WorkingArea.ToString() == "{X=0,Y=0,Width=1536,Height=824}" 
                    && screen.BitsPerPixel.ToString() == "32"
                    )
                    MessageBox.Show("Monitor has been trust");
                else
                    MessageBox.Show("Monitor can't detect");

                //listBox1.Items.Add("Device Name: " + screen.DeviceName);
                //listBox1.Items.Add("Bounds: " + screen.Bounds.ToString());
                //listBox1.Items.Add("Type: " + screen.GetType().ToString());
                //listBox1.Items.Add("Working Area: " + screen.WorkingArea.ToString());
                //listBox1.Items.Add("Primary Screen: " + screen.Primary.ToString());
            }
            Application.Exit();
        }
    }
}
