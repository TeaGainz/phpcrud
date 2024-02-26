<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Check POST data is not empty
if (!empty($_POST)) {
    //variables that are going to be inserted
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');

    // Validate email
    function is_valid_email($email)
    {
        // Regex pattern for valid email address
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($pattern, $email);
    }

    // Check if email, name, and phone are not empty
    if (empty($email) || empty($name) || empty($phone)) {
        $msg = 'Email, name, and phone are required fields.';
    } elseif (!is_valid_email($email)) {
        // Check if email valid
        $msg = 'Invalid email address. Please provide a valid email.';
    } else {
        // Insert new record into the contacts table
        $stmt = $pdo->prepare('INSERT INTO contacts VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$id, $name, $email, $phone, $title, $created]);
        $msg = 'Created Successfully!';
        header('Location: read.php');
    }
}
?>

<?= template_header('Create') ?>

<!-- <div class="content update">
    <h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <input type="text" name="phone" placeholder="2025550143" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <input type="text" name="title" placeholder="Employee" id="title">
        <input type="datetime-local" name="created" value="<?= date('Y-m-d\TH:i') ?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div> -->

<div class="form-container">
    <form action="create.php" class="my-form" method="post">
        <div class="form-branding">
            <h2>Create Contact</h2>
        </div>
        <div class="form-input-content">
            <label for="id">ID</label>
            <input class="customInput" readonly type="text" name="id" placeholder="26" value="auto" id="id" required autofocus />
        </div>
        <div class="form-input-content">
            <label for="name">Name</label>
            <input class="customInput" type="text" name="name" placeholder="John Doe" id="name" required autofocus />
        </div>
        <div class="form-input-content">
            <label for="email">Email</label>
            <input class="customInput" type="text" name="email" placeholder="johndoe@example.com" id="email" required autofocus />
        </div>
        <div class="form-input-content">
            <label for="phone">Phone</label>
            <input class="customInput" type="text" name="phone" placeholder="2025550143" id="phone" required />
        </div>
        <div class="form-input-content">
            <label for="title">Title</label>
            <input class="customInput" type="text" name="title" placeholder="Employee" id="title" />
        </div>
        <div class="form-input-content">
            <label for="created">Created</label>
            <input class="customInput" readonly type="datetime-local" name="created" value="<?= date('Y-m-d\TH:i') ?>" id="created" required />
        </div>
        <div class="form-input-content">
            <input class="inputHoverinput customInput" type="submit" value="Create" />
        </div>
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>