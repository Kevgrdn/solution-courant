<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'solution.courant@gmail.com';
    $subject = 'Nouvelle demande - Solution Courant - ' . htmlspecialchars($_POST['name']);
    
    $message = "=== Nouvelle demande de contact ===\n\n";
    $message .= "Nom: " . htmlspecialchars($_POST['name']) . "\n";
    $message .= "Email: " . htmlspecialchars($_POST['email']) . "\n";
    $message .= "Téléphone: " . htmlspecialchars($_POST['phone']) . "\n";
    $message .= "Message: " . htmlspecialchars($_POST['message']);
    
    $headers = 'From: formulaire@solutioncourant.fr' . "\r\n" .
               'Reply-To: ' . $_POST['email'] . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Email envoyé']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur d\'envoi']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode invalide']);
}
?>