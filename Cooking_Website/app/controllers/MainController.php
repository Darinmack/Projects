<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Contact;
use app\core\Database;

class MainController extends Controller
{
    public function validateContact($inputData) {
        $errors = [];

        $name = $inputData['name'];
        $email = $inputData['email'];
        $Feedback = $inputData['Feedback'];
    
        // Validate name
        if ($name) {
            $name = htmlspecialchars($name, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($name) < 2) {
                $errors['nameShort'] = 'Name is too short';
            }
        } else {
            $errors['nameRequired'] = 'Name is required';
        }
    
        // Validate email
        if ($email) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email) {
                $errors['invalidEmail'] = 'Invalid email format';
            }
        } else {
            $errors['emailRequired'] = 'Email is required';
        }
    
        // Validate password
        if ($Feedback) {
                $Feedback = htmlspecialchars($Feedback, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
                if (strlen($Feedback) < 2) {
                    $errors['FeedbackShort'] = 'Feedback is too short';
                }
            // You can add password validation logic here if needed
            // For example: check if it meets certain criteria like minimum length
        } else {
            $errors['FeedbackRequired'] = 'Feedback is required';
        }
    
        // If there are errors, return them
        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }
    
        // If no errors, return validated data
        return [
            'name' => $name,
            'email' => $email,
            'Feedback' => $Feedback,
        ];
    }

    public function saveContact() {
        // Retrieve form data
        $inputData = [
            'name' => $_POST['name'] ? $_POST['name']: false,
            'email' => $_POST['email']? $_POST['email'] : false,
            'Feedback' => $_POST['Feedback'] ? $_POST['Feedback']: false,

            
        ];
    
        // Validate form data (you can implement the validation logic in validateContact function)
        $validatedData = $this->validateContact($inputData);
    
        // If data is validated, save it into the database
       // if ($validatedData) {
            // Assuming you have a Contact model and method to save contact data
            if ($validatedData) {
            $contact = new Contact();
            $contact->saveContact(
                [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'Feedback' => $validatedData['Feedback'],
                 ]
        );
    
        /*
            // Send a success response
            http_response_code(200);
            echo json_encode([
                'success' => true
            ]);
            exit();
*/
           include 'thankyou.php';
        exit();
        } 
        
        else {
            // Send a failure response if validation fails
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Validation failed'
            ]);
            exit();
        }
        
    }
    

    public function validateNewRecipes($inputData) {
        $errors = [];
        $name = $inputData['name'];
        $category = $inputData['category'];
        $time = $inputData['time'];
        $servingSize = $inputData['servingSize'];
        $ingredients = $inputData['ingredients'];
        $instructions = $inputData['instructions'];
    
        // Validate name
        if ($name) {
            $name = htmlspecialchars($name, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($name) < 2) {
                $errors['nameShort'] = 'Name is too short';
            }
        } else {
            $errors['nameRequired'] = 'Name is required';
        }
    
        // Validate food category
        if ($category) {
            $category = htmlspecialchars($category, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($category) < 2) {
                $errors['categoryShort'] = 'Category is too short';
            }
        } else {
            $errors['categoryRequired'] = 'A Category is required';
        }
        // Validate cooking time
        if ($time) {
                $time = htmlspecialchars($time, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
                if (strlen($time) < 2) {
                    $errors['timeShort'] = 'Cooking time is too short';
                }
            // You can add password validation logic here if needed
            // For example: check if it meets certain criteria like minimum length
        } else {
            $errors['timeRequired'] = 'Cooking Time is required';
        }
    
        if ($servingSize) {
            $servingSize = htmlspecialchars($servingSize, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
            if (strlen($servingSize) < 2) {
                $errors['sizeShort'] = 'Serving Size length is too short';
            }
        // You can add password validation logic here if needed
        // For example: check if it meets certain criteria like minimum length
    } else {
        $errors['servingSizeRequired'] = 'Serving SIze is required';
    }

    if ($ingredients) {
        $ingrdients = htmlspecialchars($ingredients, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
        if (strlen($ingredients) < 2) {
            $errors['ingredientsShort'] = 'Ingredients length is too short';
        }
    // You can add password validation logic here if needed
    // For example: check if it meets certain criteria like minimum length
} else {
    $errors['ingredientsRequired'] = 'Ingredients are required';
}

if ($instructions) {
    $instructions = htmlspecialchars($instructions, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
    if (strlen($instructions) < 2) {
        $errors['instructShort'] = 'Cooking Instructions are too short';
    }
// You can add password validation logic here if needed
// For example: check if it meets certain criteria like minimum length
} else {
$errors['instructRequired'] = 'Cooking Instructions are required';
}

        // If there are errors, return them
        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }
    
        // If no errors, return validated data
        return [
            'name' => $name,
            'category' => $category,
            'time' => $time,
            'servingSize' => $servingSize,
            'ingredients' => $ingredients,
            'instructions' => $instructions,
            
        ];
    }

    
    public function theNewRecipes() {
        // Retrieve form data
        $inputData = [
            'name' => $_POST['name'] ? $_POST['name']: false,
            'category' => $_POST['category']? $_POST['category']: false,
            'time' => $_POST['time'] ? $_POST['time']: false,
            'servingSize' => $_POST['servingSize'] ? $_POST['servingSize']: false,
            'ingredients' => $_POST['ingredients']? $_POST['ingredients'] : false,
            'instructions' => $_POST['instructions'] ? $_POST['instructions']: false,


            
        ];
    
        // Validate form data (you can implement the validation logic in validateContact function)
        $validatedData = $this->validateNewRecipes($inputData);
    
            if ($validatedData) {
            $contact = new Contact();
            $contact->theNewRecipes(
                [
                'name' => $validatedData['name'],
                'category' => $validatedData['category'],
                'time' => $validatedData['time'],
                'servingSize' => $validatedData['servingSize'],
                'ingredients' => $validatedData['ingredients'],
                'instructions' => $validatedData['instructions'],
                 ]
        );
            /*
            // Send a success response
            http_response_code(200);
            echo json_encode([
                'success' => true
            ]);
            exit();
            */
            include 'newRep.php';
            exit();

        } 
        
        else {
            // Send a failure response if validation fails
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Validation failed'
            ]);
            exit();
        }


        
    }

    /*
    public function validateRecipe($inputData) {
        $errors = [];
        $mealName = $inputData['mealName'];
        $category = $inputData['category'];
    
        // Validate meal name
        if (empty($mealName)) {
            $errors['mealNameRequired'] = 'Meal name is required';
        }
    
        // Validate category
        if (empty($category)) {
            $errors['categoryRequired'] = 'Category is required';
        }
    
        // If there are errors, return them
        if (count($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            exit();
        }
    
        // If no errors, return validated data
        return [
            'mealName' => $mealName,
            'category' => $category,
        ];
    }
    
    public function saveFavoriteRecipe() {
        // Retrieve form data
        $inputData = [
            'mealName' => $_POST['mealName'] ?? '',
            'category' => $_POST['category'] ?? '',
        ];
    
        // Validate form data
        $validatedData = $this->validateRecipe($inputData);
    
        // If data is validated, save it into the database
        if ($validatedData) {
            // Assuming you have a Recipe model and method to save recipe data
            $contact = new saveFavoriteRecipe(); // Assuming Recipe is your model class
            $contact->saveFavoriteRecipe([
                'mealName' => $validatedData['mealName'],
                'category' => $validatedData['category'],
            ]);
    
            // Send a success response
            http_response_code(200);
            echo json_encode([
                'success' => true
            ]);
            exit();
        } else {
            // Send a failure response if validation fails
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Validation failed'
            ]);
            exit();
        }
    }
    
 
*/
    public function homepage()
    {
               // include '../public/assets/views/main/homepage.php';
       $this->view('../public/assets/views/main/homepage.php', true);
    }


    public function browse ()
    {
                include  '../public/assets/views/browse/recipes.php';
                exit();
    }

    public function recipes ()
    {
                include  '../public/assets/views/browse/recipes.php';
                exit();
    }


    public function favorites()
    {
                include '../public/assets/views/browse/favorites.php';
                exit();
    }



    public function newRecipes()
    {
                include '../public/assets/views/browse/newRecipes.php';
                exit();

    }



    public function contacts()
    {
                include '../public/assets/views/contacts/contacts.php';
                exit();
    }


    public function sharing ()
    {
                include '../public/assets/views/share/sharing.php';
                exit();
    }

    public function ingredients()
    {
                include '../public/assets/views/ingredients/ingredients.php';
                exit();
    }

   
/*
    public function notFound()
    {
        include '../public/assets/views/notFound.php';
        exit();
    }
    */

}

?>