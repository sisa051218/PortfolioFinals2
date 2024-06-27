<?php
session_start();
include ('connect.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $con->prepare("INSERT INTO contact (user_ID, con_fname, con_email, con_phone, con_sub, con_mess) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $userID = 1; // Assuming user_ID is 1 for now. This should be dynamically set according to the logged-in user.
        $stmt->bind_param("isssss", $userID, $name, $email, $phone, $subject, $message);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Record inserted successfully.";
        } else {
            echo "Error executing query: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portfolio Website</title>

        <!--MAIN CSS-->
        <link rel="stylesheet" href="style.css">

        <!--ICON-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <!--HEADER DESIGN-->
    <header class="header">
        <a href="#home" class="logo">Kyla <span>Jamito</span></a>

        <i class='bx bx-menu' id="menu-icon"></i>

        <nav class="navbar">
            <a href="#home" class="active">Home</a>
            <a href="#education">Education</a>
            <a href="#services">Services</a>
            <a href="#projects">Projects</a>
            <a href="#contact">Contact</a>
            <a href="login.php">Edit</a>
        </nav>

    </header>

    <!--HOME SECTION-->
    <section class="home" id="home">
        
        <div class="home-content">
            
        <?php
          $sql = "SELECT * FROM `home`";
          $result = mysqli_query($con, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $hname = $row['home_name'];
              $hdesc = $row['home_desc'];
              $hpic = $row['home_pic'];
              $hcv = $row['home_cv'];
              echo '
                
                <h1>Hi, Its <span> '.$hname.' </span></h1>
                <h3 class="text-animation">Im a <span></span></h3>
                <p>'.$hdesc.'</p>
                    
                ';
            }
          }

          $sql = "SELECT * FROM `socials`";
          $result = mysqli_query($con, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $fb = $row['soc_fb'];
              $ig = $row['soc_ig'];
              $tiktok = $row['soc_tiktok'];
              $git = $row['soc_git'];
            }
          }
          ?>

            <div class="social-icons">
                <a href="<?php echo $fb?>"><i class='bx bxl-facebook-circle'></i></a>
                <a href="<?php echo $ig?>"><i class='bx bxl-instagram' ></i></a>
                <a href="<?php echo $tiktok?>"><i class='bx bxl-tiktok'></i></a>
                <a href="<?php echo $git?>"><i class='bx bxl-github' ></i></a>
            </div>
            
            <div class="btn-group">
                <a href="upload/<?php echo $hcv?>" class="btn">View CV</a>
            </div>
        </div>

            <div class="home-img">
                <img src="upload/<?php echo $hpic?>" alt="">
            </div>
    </section> 

    <!--EDUCATION SECTION-->
    <section class="education" id="education">
        <h2 class="heading">Education</h2>
        <div class="timeline-items">

        <?php
          $sql = "SELECT * FROM `education`";
          $result = mysqli_query($con, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $year = $row['educ_year'];
              $level = $row['educ_level'];
              $school = $row['educ_school'];
              echo '
                    
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                        <div class="timeline-date">'.$year.'</div>
                        <div class="timeline-content">
                            <h3>'.$level.'</h3>
                            <p>'.$school.'</p>
                        </div>
                </div>
                    ';
            }
          }
          ?>
        </div>
    </section>

    <!--SERVICES SECTION-->
   
    <section class="services" id="services">
        <h2 class="heading">My <span>Services</span></h2>

        <div class="service-container">
        <?php
          $sql = "SELECT * FROM `services`";
          $result = mysqli_query($con, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $icon = $row['serv_icon'];
              $language = $row['serv_language'];
              $desc = $row['serv_desc'];
              echo '
                    <div class="service-box">
                        <i class="'.$icon.'"></i>
                        <h3>'.$language.'</h3>
                        <p>'.$desc.'</p>
                    </div>
                      ';
            }
        }
        ?>
        </div>
    </section>

    <!--PROJECTS SECTION-->

    <section class="projects" id="projects">
        <h2 class="heading">My <span>Projects</span></h2>

        <div class="project-container">

        <?php
          $sql = "SELECT * FROM `projects`";
          $result = mysqli_query($con, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $pname = $row['proj_name'];
              $pdesc = $row['proj_desc'];
              echo '
                
                <div class="project-box">
                    <div class="project-info">
                        <h4 class="title">'.$pname.'</h4>
                        <p class="description">'.$pdesc.'</p>
                    </div>
                <span class="circle-before"></span>
                </div>
                    
                ';
            }
          }
          ?>
        </div>
    </section>

    <!--CONTACT SECTION-->

    <section class="contact" id="contact">
        <h2 class="heading">Contact <span>Me</span></h2>
        <form action="" method= "post">
            <div class="input-group">
                <div class="input-box">
                    <input type="text" name = "name" placeholder="Full Name">
                    <input type="email" name = "email" placeholder="Email">

                </div>
                <div class="input-box">
                    <input type="number" name = "phone"  placeholder="Phone Number">
                    <input type="text" name = "subject"  placeholder="Subject">
                </div>
            </div>

            <div class="input-group-2">
                <textarea name="message" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
                <input type="submit" name = "submit" value="Send Message" class="btn">
            </div>

        </form>
    </section>

    <!--FOOTER SECTION-->

    <footer class="footer">
        <div class="social-icons">
            <a href="<?php echo $fb?>"><i class='bx bxl-facebook-circle'></i></a>
            <a href="<?php echo $ig?>"><i class='bx bxl-instagram' ></i></a>
            <a href="<?php echo $tiktok?>"><i class='bx bxl-tiktok'></i></a>
            <a href="<?php echo $git?>"><i class='bx bxl-github' ></i></a>
        </div>
        <ul class="list">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#eduaction">Education</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#projects">Projects</a></li>
        </ul>
        <p class="copyright">
            © Kyla Jamito | All Rights Reserved
        </p>
    </footer>

    <script src="script.js"></script>
</body>
</html>

<?php
    
    // Close the connection
    $con->close();
    
?>