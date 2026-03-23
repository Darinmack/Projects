<?php

namespace app\controllers;
use app\core\Controller;
use app\models\User;

class UserController extends Controller
{
    public function getUsers()
    {
        $userModel = new User();
        header("Content-Type: application/json");
        $users = $userModel->getAllUsers();
        echo json_encode($users);
        exit();
    }

    public function saveUser() {

    }

    public function viewUsers() {
        
    }
    public function validateContact($inputData) {
        $errors = [];
        $name = $inputData['name'];
        $email = $inputData['email'];
        $password = $inputData['password'];
    
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
        if ($password) {
            // You can add password validation logic here if needed
            // For example: check if it meets certain criteria like minimum length
        } else {
            $errors['passwordRequired'] = 'Password is required';
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
            'password' => $password,
        ];
    }

    public function saveContact() {
        // Retrieve form data
        $inputData = [
            'name' => $_POST['YourName'] ?? false,
            'email' => $_POST['exampleInputEmail1'] ?? false,
            'password' => $_POST['exampleInputPassword1'] ?? false,
        ];
    
        // Validate form data (you can implement the validation logic in validateContact function)
        $validatedData = $this->validateContact($inputData);
    
        // If data is validated, save it into the database
        if ($validatedData) {
            // Assuming you have a Contact model and method to save contact data
            $contact = new Contact();
            $contact->saveContact([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
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
    
}