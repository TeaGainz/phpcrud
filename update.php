<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $pdo->prepare('UPDATE contacts SET id = ?, name = ?, email = ?, phone = ?, title = ?, created = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone, $title, $created, $_GET['id']]);
        $msg = 'Updated Successfully!';
        header('Location: read.php');
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?= template_header('Read') ?>


<div class="form-container">
    <form action="update.php?id=<?= $contact['id'] ?>" class="my-form" method="post">
        <div class="form-branding">
            <h1>Update Contact #<?= $contact['id'] ?></h1>
        </div>
        <div class="form-input-content">
            <label for="id">ID</label>
            <input class="customInput" readonly type="text" name="id" placeholder="1" value="<?= $contact['id'] ?>" id="id" required autofocus />
        </div>
        <div class="form-input-content">
            <label for="name">Name</label>
            <input class="customInput" type="text" name="name" placeholder="John Doe" value="<?= $contact['name'] ?>" id="name" required autofocus />
        </div>
        <div class="form-input-content">
            <label for="email">Email</label>
            <input class="customInput" type="text" name="email" placeholder="johndoe@example.com" value="<?= $contact['email'] ?>" id="email" required autofocus />
        </div>
        <div class="form-input-content">
            <label for="phone">Phone</label>
            <input class="customInput" type="text" name="phone" placeholder="2025550143" value="<?= $contact['phone'] ?>" id="phone" required />
        </div>
        <div class="form-input-content">
            <label for="title">Title</label>
            <input class="customInput" type="text" name="title" placeholder="Employee" value="<?= $contact['title'] ?>" id="title" required />
        </div>
        <div class="form-input-content">
            <label for="created">Created</label>
            <input class="customInput" readonly type="datetime-local" name="created" value="<?= date('Y-m-d\TH:i', strtotime($contact['created'])) ?>" id="created" required />
        </div>
        <div class="form-input-content">
            <input class="inputHoverinput customInput" type="submit" value="Update" />
        </div>
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>