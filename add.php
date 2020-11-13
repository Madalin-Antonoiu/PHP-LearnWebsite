<?php 
    #$_POST is a pre-defined, global array / The properties nmes come from name=""

    #1. Vulnerable to XSS ( e.g. inserting a JS script tag in a field then submitting) ❌
    // if(isset($_POST['data'])){
    //     echo "Email adress: {$_POST['email']} <br/>";
    //     echo "Title: {$_POST['title']} <br/>";
    //     echo "Ingredients: {$_POST['ingredients']} <br/>";
    // }

    #2. No longer vulnerable to XSS ✔️ (Without Form Validation though)
    // if(isset($_POST['data'])){
    //     echo htmlspecialchars("Email adress: {$_POST['email']} <br/>");
    //     echo htmlspecialchars("Title: {$_POST['title']} <br/>");
    //     echo htmlspecialchars("Ingredients: {$_POST['ingredients']} <br/>");
    // }

    #3. XSS-secure & Basic Form VALIDATION
    // if(isset($_POST['data'])){

    //     #Check Email
    //     if(empty($_POST['email'])){
    //         echo "An email adress is required. <br/>";
    //     } else {
    //         echo htmlspecialchars("Email adress: {$_POST['email']}")."<br/>";
    //     }

    //     #Check Title
    //     if(empty($_POST['title'])){
    //         echo "A title is required <br/>";
    //     } else {
    //         echo htmlspecialchars("Title: {$_POST['title']}")."<br/>";
    //     }

    //     #Check Ingredients
    //     if(empty($_POST['ingredients'])){
    //         echo "Ingredients are required. <br/>";
    //     } else {
    //         echo htmlspecialchars("Ingredients: {$_POST['ingredients']}")."<br/>";
    //     }
    // }

    #4. With Filters and More Validation
    // if(isset($_POST['submit'])){

	// 	$email = $title = $ingredients = '';
		
	// 	// check email
	// 	if(empty($_POST['email'])){
	// 		echo 'An email is required <br />';
	// 	} else{
	// 		$email = $_POST['email'];
	// 		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	// 			echo 'Email must be a valid email address';
	// 		}
	// 	}

	// 	// check title
	// 	if(empty($_POST['title'])){
	// 		echo 'A title is required <br />';
	// 	} else{
	// 		$title = $_POST['title'];
	// 		if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
	// 			echo 'Title must be letters and spaces only';
	// 		}
	// 	}

	// 	// check ingredients
	// 	if(empty($_POST['ingredients'])){
	// 		echo 'At least one ingredient is required <br />';
	// 	} else{
	// 		$ingredients = $_POST['ingredients'];
	// 		if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
	// 			echo 'Ingredients must be a comma separated list';
	// 		}
	// 	}

	// } // end POST check

    
    #5. + Persist Data on fail and show errors nicely in a form + Redirect if no errors
    $email = $title = $ingredients = '';
    $errors = array('email' => '', 'title' => '', 'ingredients'=>'');

    if(isset($_POST['data'])){ // if 'data' is not the name="" of submit button, nothing will happen with no error ;)
		
		# Check email
		if(empty($_POST['email'])){
			$errors['email'] =  'An email is required <br />';
		} else {
            $email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = "Email must be a valid email address";
			}
		}

		# Check title
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required <br />';
		} else {
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

		# Check ingredients
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] =  'At least one ingredient is required <br />';
		} else{
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
        }
        
        #Redirect if no errors
        if(array_filter($errors)){ 
            //echo 'Errors in the form';
        } else {
            // means nothing found in errors
            header('Location: index.php');
        }


	} 
?>


<!DOCTYPE html>
<html lang="en">

    <?php include 'templates/header.php' ?>
   

    <section class="container grey-text">
        <h4 class="center">Add a pizza</h4>

        <form class="white" method="POST" action="add.php">
            <label for="">Your Email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" >
            <h6 class="red-text"><?php echo $errors['email']; ?></h6>

            <label for="">Pizza Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" >
            <h6 class="red-text"><?php echo $errors['title']; ?></h6>

            <label for="">Ingredients (comma sparated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>" >
            <h6 class="red-text"><?php echo $errors['ingredients']; ?></h6>

            <div class="center">
                <input type="submit" name="data" value="submit" class="brand btn z-depth-0">
            </div>
        </form>

    </section>


    <?php include 'templates/footer.php' ?>

</html>