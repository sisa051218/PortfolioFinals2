<?php
session_start();
include ('connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

// Sweet alert if login is success
if (isset($_SESSION['login_success'])) {
    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Login Successful",
                text: "Welcome to the settings page!",
                confirmButtonText: "OK",
                confirmButtonColor: "#DA70D5",
                background: "#0e0d0d",
                color: "#fff",
                iconColor: "#DA70D5"
            });
        });
    </script>';
    unset($_SESSION['login_success']);
}

// Handle Home Updates and Deletes
if (isset($_POST['update_home'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $pic = $_POST['pic'];
    $cv = $_POST['cv'];

    $stmt = $con->prepare("UPDATE home SET home_name=?, home_desc=?, home_pic=?, home_cv=? WHERE home_id=?");
    $stmt->bind_param("ssssi", $name, $desc, $pic, $cv, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if (isset($_POST['delete_home'])) {
    $id = $_POST['id'];

    $stmt = $con->prepare("DELETE FROM home WHERE home_id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

if (isset($_POST['add_home'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $pic = $_POST['pic'];
    $cv = $_POST['cv'];

    $stmt = $con->prepare("INSERT INTO home (user_id, home_name, home_desc, home_pic, home_cv) VALUES (?, ?, ?, ?, ?)");
    $userID = 1; // Assuming user ID is 1 or retrieved from session
    $stmt->bind_param("issss", $userID, $name, $desc, $pic, $cv);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

// Handle Education Updates and Deletes
if (isset($_POST['update_educ'])) {
    $id = $_POST['id'];
    $year = $_POST['year'];
    $level = $_POST['level'];
    $school = $_POST['school'];

    $stmt = $con->prepare("UPDATE education SET educ_year=?, educ_level=?, educ_school=? WHERE educ_id=?");
    $stmt->bind_param("sssi", $year, $level, $school, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if (isset($_POST['delete_educ'])) {
    $id = $_POST['id'];

    $stmt = $con->prepare("DELETE FROM education WHERE educ_id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

if (isset($_POST['add_educ'])) {
    $year = $_POST['year'];
    $level = $_POST['level'];
    $school = $_POST['school'];

    $stmt = $con->prepare("INSERT INTO education (user_id, educ_year, educ_level, educ_school) VALUES (?, ?, ?, ?)");
    $userID = 1; // Assuming user ID is 1 or retrieved from session
    $stmt->bind_param("isss", $userID, $year, $level, $school);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

// Handle Services Updates and Deletes
if (isset($_POST['update_serv'])) {
    $id = $_POST['id'];
    $icon = $_POST['icon'];
    $language = $_POST['language'];
    $desc = $_POST['desc'];

    $stmt = $con->prepare("UPDATE services SET serv_icon=?, serv_language=?, serv_desc=? WHERE serv_id=?");
    $stmt->bind_param("sssi", $icon, $language, $desc, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if (isset($_POST['delete_serv'])) {
    $id = $_POST['id'];

    $stmt = $con->prepare("DELETE FROM services WHERE serv_id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

if (isset($_POST['add_serv'])) {
    $icon = $_POST['icon'];
    $language = $_POST['language'];
    $desc = $_POST['desc'];

    $stmt = $con->prepare("INSERT INTO services (user_id, serv_icon, serv_language, serv_desc) VALUES (?, ?, ?, ?)");
    $userID = 1; // Assuming user ID is 1 or retrieved from session
    $stmt->bind_param("isss", $userID, $icon, $language, $desc);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if (isset($_POST['update_proj'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $desc = $_POST['desc'];

  $stmt = $con->prepare("UPDATE projects SET proj_name=?, proj_desc=? WHERE proj_id=?");
  $stmt->bind_param("ssi", $name, $desc, $id);

  if ($stmt->execute()) {
      echo "Record updated successfully.";
  } else {
      echo "Error updating record: " . $stmt->error;
  }
}

if (isset($_POST['delete_proj'])) {
  $id = $_POST['id'];

  $stmt = $con->prepare("DELETE FROM projects WHERE proj_id=?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
      echo "Record deleted successfully.";
  } else {
      echo "Error deleting record: " . $stmt->error;
  }
}

if (isset($_POST['add_proj'])) {
  $name = $_POST['name'];
  $desc = $_POST['desc'];

  $stmt = $con->prepare("INSERT INTO projects (user_id, proj_name, proj_desc) VALUES (?, ?, ?)");
  $userID = 1; // Assuming user ID is 1 or retrieved from session
  $stmt->bind_param("isss", $userID, $name, $desc);

  if ($stmt->execute()) {
      echo "Record added successfully.";
  } else {
      echo "Error adding record: " . $stmt->error;
  }
}

if (isset($_POST['delete_msg'])) {
  $id = $_POST['id'];

  $stmt = $con->prepare("DELETE FROM contact WHERE con_id=?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
      echo "Message deleted successfully.";
  } else {
      echo "Error deleting message: " . $stmt->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- STYLE.CSS LINK -->
    <link rel="stylesheet" href="style1.css">
    <title>Portfolio Website</title>
</head>

<body>

    <!--HEADER DESIGN-->
    <header class="header">
        <a href="#home" class="logo">Kyla <span>Jamito</span></a>

        <nav class="navbar">
            <a href="#home" class="active">Home</a>
            <a href="#education">Education</a>
            <a href="#services">Services</a>
            <a href="#projects">Projects</a>
            <a href="#messages">Messages</a>
            <a href="logout.php">Log Out</a>
        </nav>

    </header>

    <section class="home" id="home">
        <div class="home-content">
            <h2 class="heading">Home <span>Settings</span></h2>
            <h4>Manage Records</h4>
            <!-- Display records from the database -->
            <?php
            $sql = "SELECT * FROM `home`";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo '<table class="records-table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Picture</th>
                            <th>CV</th>
                            <th>Actions</th>
                        </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['home_id'];
                    $name = $row['home_name'];
                    $desc = $row['home_desc'];
                    $pic = $row['home_pic'];
                    $cv = $row['home_cv'];
                    echo '
                    <tr>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="'.$id.'">
                            <td>'.$id.'</td>
                            <td><input type="text" name="name" value="'.$name.'"></td>
                            <td><input type="text" name="desc" value="'.$desc.'"></td>
                            <td><input type="text" name="pic" value="'.$pic.'"></td>
                            <td><input type="text" name="cv" value="'.$cv.'"></td>
                            <td>
                                <button type="submit" name="update_home" class="btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="submit" name="delete_home" class="btn">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </form>
                    </tr>';
                }
                echo '</table>';
            }
            ?>
            <h4>Add New Record</h4>
            <table class="records-table">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Picture</th>
                    <th>CV</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <form action="" method="post">
                        <td><input type="text" name="name" placeholder="Name"></td>
                        <td><input type="text" name="desc" placeholder="Description"></td>
                        <td><input type="text" name="pic" placeholder="Picture URL"></td>
                        <td><input type="text" name="cv" placeholder="CV URL"></td>
                        <td>
                            <button type="submit" name="add_home" class="btn">
                                    <i class="fa fa-plus-square"></i>
                            </button>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </section>

    <section class="education" id="education">
        <div class="educ-content">
            <h2 class="heading">Education <span>Settings</span></h2>
            <h4>Manage Records</h4>
            <!-- Display records from the database -->
            <?php
            $sql = "SELECT * FROM `education`";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo '<table class="records-table">
                        <tr>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Level</th>
                            <th>School</th>
                            <th>Actions</th>
                        </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['educ_id'];
                    $year = $row['educ_year'];
                    $level = $row['educ_level'];
                    $school = $row['educ_school'];
                    echo '
                    <tr>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="' . $id . '">
                            <td>' . $id . '</td>
                            <td><input type="text" name="year" value="' . $year . '"></td>
                            <td><input type="text" name="level" value="' . $level . '"></td>
                            <td><input type="text" name="school" value="' . $school . '"></td>
                            <td>
                                <button type="submit" name="update_educ" class="btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="submit" name="delete_educ" class="btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </form>
                    </tr>';
                }
                echo '</table>';
            }
            ?>

            <!-- Add new record form -->
            <h4>Add New Record</h4>
            <table class="records-table">
                <tr>
                    <th>Year</th>
                    <th>Level</th>
                    <th>School</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <form action="" method="post">
                        <td><input type="text" name="year" placeholder="Year"></td>
                        <td><input type="text" name="level" placeholder="Level"></td>
                        <td><input type="text" name="school" placeholder="School"></td>
                        <td>
                        <button type="submit" name="add_educ" class="btn">
                                    <i class="fa fa-plus-square"></i>
                            </button>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </section>

    <section class="services" id="services">
        <div class="serv-content">
            <h2 class="heading">Services <span>Settings</span></h2>
            <h4>Manage Records</h4>
            <!-- Display records from the database -->
            <?php
            $sql = "SELECT * FROM `services`";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo '<table class="records-table">
                        <tr>
                            <th>ID</th>
                            <th>Icon</th>
                            <th>Language</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['serv_id'];
                    $icon = $row['serv_icon'];
                    $language = $row['serv_language'];
                    $desc = $row['serv_desc'];
                    echo '
                    <tr>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="' . $id . '">
                            <td>' . $id . '</td>
                            <td><input type="text" name="icon" value="' . $icon . '"></td>
                            <td><input type="text" name="language" value="' . $language . '"></td>
                            <td><input type="text" name="desc" value="' . $desc . '"></td>
                            <td>
                                <button type="submit" name="update_serv" class="btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="submit" name="delete_serv" class="btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </form>
                    </tr>';
                }
                echo '</table>';
            }
            ?>

            <!-- Add new record form -->
            <h4>Add New Record</h4>
            <table class="records-table">
                <tr>
                    <th>Icon</th>
                    <th>Language</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <form action="" method="post">
                        <td><input type="text" name="icon" placeholder="Icon"></td>
                        <td><input type="text" name="language" placeholder="Language"></td>
                        <td><input type="text" name="desc" placeholder="Description"></td>
                        <td>
                        <button type="submit" name="add_serv" class="btn">
                                    <i class="fa fa-plus-square"></i>
                            </button>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </section>

    <section class="projects" id="projects">
        <div class="proj-content">
            <h2 class="heading">Projects <span>Settings</span></h2>
            <h4>Manage Records</h4>
            <!-- Display records from the database -->
            <?php
            $sql = "SELECT * FROM `projects`";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo '<table class="records-table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['proj_id'];
                    $name = $row['proj_name'];
                    $desc = $row['proj_desc'];
                    echo '
                    <tr>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="' . $id . '">
                            <td>' . $id . '</td>
                            <td><input type="text" name="name" value="' . $name . '"></td>
                            <td><input type="text" name="desc" value="' . $desc . '"></td>
                            <td>
                                <button type="submit" name="update_proj" class="btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="submit" name="delete_proj" class="btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </form>
                    </tr>';
                }
                echo '</table>';
            }
            ?>

            <!-- Add new record form -->
            <h4>Add New Record</h4>
            <table class="records-table">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <form action="" method="post">
                        <td><input type="text" name="name" placeholder="Name"></td>
                        <td><input type="text" name="desc" placeholder="Description"></td>
                        <td>
                        <button type="submit" name="add_proj" class="btn">
                                    <i class="fa fa-plus-square"></i>
                            </button>
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </section>

    <section class="messages" id="messages">
        <div class="mess-content">
            <h2 class="heading">View <span>Messages</span></h2>

            <!-- Display messages from the database -->
            <?php
            $sql = "SELECT * FROM `contact`";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo '<table class="records-table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['con_id'];
                    $name = $row['con_fname'];
                    $email = $row['con_email'];
                    $phone = $row['con_phone'];
                    $subject = $row['con_sub'];
                    $message = $row['con_mess'];
                    echo '
                    <tr>
                        <td>' . $id . '</td>
                        <td>' . $name . '</td>
                        <td>' . $email . '</td>
                        <td>' . $phone . '</td>
                        <td>' . $subject . '</td>
                        <td>' . $message . '</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="' . $id . '">
                                <button type="submit" name="delete_msg" class="btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>';
                }
                echo '</table>';
            } else {
                echo "No messages found.";
            }
            ?>
        </div>
    </section>
    <!-- main.js -->
    <script src="./js/main.js"></script>
</body>

</html>
