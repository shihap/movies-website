<!DOCTYPE HTML>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title> <?php echo $title;  ?> </title>
            
            
            <link rel ="stylesheet" type="text/css" href="styles.css" >

        </head>
        
        
        <body>
            <div id ="wrapper" >
                
                    
                <nav id ="navigation">
                    
                    <ul id= "nav" >
                        
                        <li><a href= "main.php" > Home </a> </li>
                        <li><a href= "" > Contact </a></li>
                        <li><a href= "" > Board </a></li>
                        <li><a href= "managment.php" >  Management </a></li>
                        
                    </ul>
                </nav>
                <div id ="content"> <?php echo $content;  ?> </div>
                <footer>
                    <p>All rights reserved to : Team Members</p>
                </footer>
            
            </div>

            
        </body>
        
        
    </html>